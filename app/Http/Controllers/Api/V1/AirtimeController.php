<?php

    namespace App\Http\Controllers\Api\V1;

    use App\Airtime;
    use App\Payment;
    use http\Client\Curl\User;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class AirtimeController extends Controller
    {

        public function buy(Request $request)
        {
            $this->validate($request, [
                "recipient" => "required",
                "amount" => "required",
                "type" => "required",//AIRTIME KPLC
                "payment_method" => "required",//MPESA ,WALLET
                "user_id" => "required"
            ]);
            $micro = new MicroServiceController();
            $notify = new NotifyController();
            $user = \App\User::find($request->user_id);

            //VALIDATE THE AMOUNT PURCHASED
            if ($request->amount < 10):
                Log::info("Minimum artime purchase error");
                return response()->json(['success' => false, "errors" => "Minimum airtime purchases is ksh 10"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

            endif;
            $result = $micro->get(new Request(), "outlet/".env("IWS_FEP_AIRTIME_FLOAT"));
            if($result->getData()->success):
                if($result->getData()->data->success):
                  $outlet=$result->getData()->data->outlet;
                   if($outlet->float->balance < $request->amount):
                       Log::info("PLEASE FUND THE FLOAT ACCOUNT");
                       return response()->json(['success' => false, "errors" => "The service is currently unavailable"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                   endif;
                endif;
                endif;

            $payment = Payment::create([
                "user_id" => $user->id,
                "amount" => $request->amount,
                "status" => 0,
                "description" => "Airtime purchase ",
                "method" => $request->payment_method,
                "type" => $request->type
            ]);
            if (empty($payment)):
                Log::info("Creating payment error");
                return response()->json(['success' => false, "errors" => "Something went wrong"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            $airtime = Airtime::create([
                "payment_id" => $payment->id,
                "request_id" => '_',
                "amount" => $payment->amount,
                "phone" => $user->phone,
                "recipient" => $request->recipient,
                "discount" => 0,
                "status" => "PENDING"
            ]);
            if (empty($airtime)):
                Log::info("Creating airtime error");
                return response()->json(['success' => false, "errors" => "Something went wrong"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            //type of payment
            if ($request->payment_method == "WALLET"):
                //wallet
                //debit user wallet and credit business
                $result = $micro->post(new Request([
                    'outlet_code' => env("IWS_LUXIL_AIRTIME_SOLD"),
                    'customer_code' => $user->customer_code,
                    'reference' => $payment->id,
                    "amount" => $payment->amount,
                    'description' => "Airtime purchase via wallet",
                    'receipt_no' => $payment->receipt
                ]), "transactions/c2o");

                Log::info("IWS debit user wallet- " . json_encode($result));
                //update the payment to be success
                if ($result->getData()->success):
                    if ($result->getData()->data->success):
                        $transaction = $result->getData()->data->transaction;
                        Payment::where("id", $payment->id)->update([
                            "receipt" => $transaction->reference_no,
                            "status" => 1,
                        ]);
                        //buy airtime
                        $airtime = Airtime::where("payment_id", $payment->id)->first();
                        //Initiate airtime purchase
                        $result = $micro->wigopay_post(new Request([
                            'merchantCode' => env("WIGOPAY_AIRTIME_MERCHANTCODE"),
                            'amount' => $airtime->amount,
                            'recipient' => $airtime->recipient,
                            'phone' => $airtime->phone,
                            'callbackurl' => url("api/airtime/status"),
                        ]), 'wallet/airtime');
                        Log::info("Wigopay buy airtime - " . json_encode($result));
                        if ($result->getData()->success):
                            if ($result->getData()->data->success):
                                //update airtime
                                $data = $result->getData()->data->data;
                                Airtime::where("payment_id", $payment->id)->update([
                                    "status" => "PENDING",
                                    "request_id" => $data->requestId,
                                    "discount" => str_replace([' ', 'KES'], ['', ''], $data->discount),
                                    "status_description" => json_encode($result->getData()->data)
                                ]);
                                return response()->json(['success' => true, "message" => "Your purchase has been successfully initiated."], JsonResponse::HTTP_OK);
                            else:
                                //airtime purchase failed -external
                                Airtime::where("payment_id", $payment->id)->update([
                                    "status" => "FAILED",
                                    "status_description" => json_encode($result->getData()->data)
                                ]);

                               //REFUND back to wallet
                                $result = $micro->post(new Request([
                                    'outlet_code' => env("IWS_LUXIL_AIRTIME_SOLD"),
                                    'customer_code' => $user->customer_code,
                                    'reference' => $payment->receipt,
                                    "amount" =>$payment->amount ,
                                    'description' => "Refund Airtime purchase via wallet",
                                    'receipt_no' => $payment->receipt,
                                ]), "transactions/o2c");


                                Log::info("customer refund on airtime purchase" . json_encode($result));
                                return response()->json(['success' => false, "errors" => $result->getData()->data], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                            endif;
                        else:
                            //airtime purchase failed -internal
                            Airtime::where("payment_id", $payment->id)->update([
                                "status" => "FAILED",
                                "status_description" => json_encode($result->getData())
                            ]);
                            Log::info("Airtime wallet purchase failed" . json_encode($result->getData()));
                            return response()->json(['success' => false, "errors" => $result->getData()->errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                        endif;
                    else:
                        //wallet errors
                        Airtime::where("payment_id", $payment->id)->update([
                            "status" => "FAILED",
                            "status_description" => json_encode($result->getData()->data)
                        ]);
                        return response()->json(['success' => false, "errors" => $result->getData()->data->errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                    endif;
                else:
                    //internal post error
                    Airtime::where("payment_id", $payment->id)->update([
                        "status" => "FAILED",
                        "status_description" => json_encode($result->getData())
                    ]);
                    return response()->json(['success' => false, "errors" => $result->getData()->errors], JsonResponse::HTTP_OK);
                endif;
            elseif ($request->payment_method == "M-PESA"):
                $result = $micro->mpesa_stkpush(new Request(
                    [
                        'amount' => $request->amount,
                        'phone' => $user->phone,
                        'callBackUrl' => "http://fep-api.intrepid.co.ke/payment/status/mpesa",
                        'outletCode' => 'OTC46',
                        'orderRef' => 'FEP_' . $payment->id,
                        'variable1' => 'v1',
                        'variable2' => 'v2',
                        'customerName' => $user->firstname . ' ' . $user->surname,
                        'customerEmail' => $user->email,
                    ]
                ));
                Log::info("Airtime purchase via M-pesa" . json_encode($result));
                return response()->json(['success' => true, "message" => "Please check you Phone for M-PESA Prompt."], JsonResponse::HTTP_OK);
            endif;

        }

        public  function reinitiate(Request $request){
            $airtimes = Airtime::get();
            //Initiate airtime purchase
            $micro = new MicroServiceController();
            $notify = new NotifyController();
            foreach($airtimes as $airtime):
            $result = $micro->wigopay_post(new Request([
                'merchantCode' => env("WIGOPAY_AIRTIME_MERCHANTCODE"),
                'amount' => $airtime->amount,
                'recipient' => $airtime->recipient,
                'phone' => $airtime->phone,
                'callbackurl' => url("api/airtime/status"),
            ]), 'wallet/airtime');
            Log::info("Wigopay buy airtime - " . json_encode($result));
            endforeach;
            return response()->json(['success' => true, "message" => "Successfully reiniated."], JsonResponse::HTTP_OK);
        }


    }
