<?php

    namespace App\Http\Controllers\Api\V1;


    use App\Airtime;
    use App\Payment;
    use App\User;
    use App\Withdraw;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class MicroServiceController extends Controller
    {

        /**
         * TransferController constructor.
         */
        public function __construct()
        {
            $this->middleware('auth:api', ['except' => ['pokeapay_callback_reg', 'pokeapay_callback_airtime', 'pokeapay_callback_mpesa', "wigopay_callback_airtime", "pokeapay_callback_withdraw"]]);

        }

        public function mpesa_token(Request $request)
        {
            $ch = curl_init();
            $credentials = array(
                "email" => env('MPESA_MICROSERVICE_USERNAME'),
                "password" => env('MPESA_MICROSERVICE_PASSWORD'),
            );
            curl_setopt($ch, CURLOPT_URL, str_replace(' ', '', env("MPESA_MICROSERVICE_URL") . "/login"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
            $headers = array();
            $headers[] = "Accept: application/json";
            $headers[] = "Content-Type: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);
            return response()->json(['success' => true, "token" => json_decode($result)->data->token]);

        }

        public function mpesa_stkpush(Request $request)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, env("MPESA_MICROSERVICE_URL") . "/stkPush/transaction");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request->all()));
            $headers = array();
            $headers[] = "Authorization:" . $this->mpesa_token($request)->getData()->token;
            $headers[] = "Content-Type: application/json";
            $headers[] = "Accept: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);
            return response()->json(['success' => true, "data" => json_decode($result)], JsonResponse::HTTP_CREATED);

        }


        public function iws_token(Request $request)
        {
            $ch = curl_init();
            $credentials = array(
                "email" => env('IWS_MICROSERVICE_USERNAME'),
                "password" => env('IWS_MICROSERVICE_PASSWORD'),
            );
            curl_setopt($ch, CURLOPT_URL, "https://api-iws.intrepid.co.ke/api/auth/login");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
            $headers = array();
            $headers[] = "Accept: application/json";
            $headers[] = "Content-Type: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);

            return response()->json(['success' => true, "token" => json_decode($result)->token]);
        }

        public function post(Request $request, $extension_url = "customer")
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api-iws.intrepid.co.ke/api/$extension_url");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request->all()));
            $headers = array();
            $headers[] = "Authorization: Bearer " . $this->iws_token($request)->getData()->token;
            $headers[] = "Content-Type: application/json";
            $headers[] = "Accept: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);
            return response()->json(['success' => true, "data" => json_decode($result)], JsonResponse::HTTP_CREATED);
        }

        public function get(Request $request, $extension_url)
        {
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api-iws.intrepid.co.ke/api/$extension_url",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    "Authorization: Bearer " . $this->iws_token($request)->getData()->token
                ),
            ));
            if (curl_errno($curl)) {
                //dd('Curl token Error:' . curl_error($curl),'curl');
                return response()->json(['success' => false, "errors" => curl_error($curl)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $response = curl_exec($curl);
            curl_close($curl);
            return response()->json(['success' => true, "data" => json_decode($response)], JsonResponse::HTTP_OK);
        }

        public function wigopay_token(Request $request)
        {
            $ch = curl_init();
            $credentials = array(
                "email" => env('WIGOPAY_MICROSERVICE_USERNAME'),
                "password" => env('WIGOPAY_MICROSERVICE_PASSWORD'),
            );
            curl_setopt($ch, CURLOPT_URL, "https://end.wigopay.com/api/auth/login");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
            $headers = array();
            $headers[] = "Accept: application/json";
            $headers[] = "Content-Type: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);

            return response()->json(['success' => true, "token" => json_decode($result)->access_token]);
        }

        public function wigopay_post(Request $request, $extension_url = "customer")
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://end.wigopay.com/api/$extension_url");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request->all()));
            $headers = array();
            $headers[] = "Authorization: Bearer " . $this->wigopay_token($request)->getData()->token;
            $headers[] = "Content-Type: application/json";
            $headers[] = "Accept: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);
            return response()->json(['success' => true, "data" => json_decode($result)], JsonResponse::HTTP_CREATED);
        }

        public function pokeapay_token(Request $request)
        {
            $ch = curl_init();
            $credentials = array(
                "email" => env('POKEAPAY_MICROSERVICE_USERNAME'),
                "password" => env('POKEAPY_MICROSERVICE_PASSWORD'),
            );
            curl_setopt($ch, CURLOPT_URL, "https://core.pokeapay.com/api/auth/login");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($credentials));
            $headers = array();
            $headers[] = "Accept: application/json";
            $headers[] = "Content-Type: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);

            return response()->json(['success' => true, "token" => json_decode($result)->token]);
        }

        public function pokeapay_post(Request $request, $extension_url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://core.pokeapay.com/api/$extension_url");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request->all()));
            $headers = array();
            $headers[] = "Authorization: Bearer " . $this->pokeapay_token($request)->getData()->token;
            $headers[] = "Content-Type: application/json";
            $headers[] = "Accept: application/json";
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                return response()->json(['success' => false, "errors" => curl_error($ch)], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            curl_close($ch);
            return response()->json(['success' => true, "data" => json_decode($result)], JsonResponse::HTTP_CREATED);
        }

        public function pokeapay_callback_reg(Request $request)
        {
            $fp = fopen('php://input', 'r');
            $postdata = json_decode(stream_get_contents($fp));
            Log::info(json_encode($postdata));

            $billreference = $postdata->billreference;
            $amount = $postdata->amount;
            $accountname = $postdata->accountname;
            $accountno = $postdata->accountno;
            $fees = $postdata->fees;
            $referenceno = $postdata->referenceno;
            $method = $postdata->method;
            //verify on DB
            $payment = Payment::where("receipt", $referenceno)->first();
            if (!empty($payment)):
                return response()->json(['success' => false, "errors" => "Already transaction received"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            $reference = explode('_', $billreference);
            $payment = Payment::where("id", $reference[1])->first();
            if (!empty($payment)):
                Payment::where("id", $payment->id)->update([
                    "receipt" => $referenceno,
                    "status" => 1,
                    "description" => "Registration - $accountname ($accountno)"
                ]);

                $user = User::find($payment->user_id);
                //create customer wallet
                $result = $this->post(new Request([
                    'firstname' => $user->firstname,
                    'middlename' => $user->middlename,
                    'surname' => $user->surname,
                    'phone' => $user->phone,
                    'email' => $user->email,
                    'doc_type' => $user->doc_type,
                    'doc_no' => $user->doc_no,
                ]), "customer");
                Log::info("customer-" . json_encode($result));
                //update user
                $customer = $result->getData()->data->customer;
                if ($result->getData()->data->success):
                    $customer_code = $customer->customer_code;
                    User::where("id", $user->id)->update([
                        "customer_code" => $customer_code
                    ]);

                    //fund fep account
                    $result = $this->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'reference' => $payment->id,
                        'description' => $payment->description,
                        'receipt_no' => $payment->id,
                        'amount' => $amount
                    ]), "transactions/f2o");
                    Log::info("transactions/f2o -" . json_encode($result));
                    $notify = new NotifyController();
                    $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Confirmed. KES 1000 received by FEP Digital. Customer Care call/sms: 0769 558 814"]));
                    $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Dear $user->firstname, you have successfully registered. Your Membership Number is $user->referral_code. Dial *483*30# to access your FEP Digital account."]));
                    //initiate cashback
                    $cashback = new CashbackController();
                    $cashback->award(new Request([
                        "payment_id" => $payment->id
                    ]));
                endif;
            endif;
        }

        public function pokeapay_callback_airtime(Request $request)
        {
            $fp = fopen('php://input', 'r');
            $postdata = json_decode(stream_get_contents($fp));
            Log::info(json_encode($postdata));

            $billreference = $postdata->billreference;
            $amount = $postdata->amount;
            $accountname = $postdata->accountname;
            $accountno = $postdata->accountno;
            $fees = $postdata->fees;
            $referenceno = $postdata->referenceno;
            $method = $postdata->method;

            //verify on DB
            $reference = explode('_', $billreference);
            $payment = Payment::where("id", $reference[1])->first();
            if (!empty($payment)):
                Payment::where("id", $payment->id)->update([
                    "receipt" => $referenceno,
                    "description" => "Airtime purchase - $accountname ($accountno)",
                    "status" => 1,
                ]);
                //airtime
                $airtime = Airtime::where("payment_id", $payment->id)->first();
                //Initiate airtime purchase
                $result = $this->wigopay_post(new Request([
                    'merchantCode' => env("WIGOPAY_AIRTIME_MERCHANTCODE"),
                    'amount' => $airtime->amount,
                    'recipient' => $airtime->recipient,
                    'phone' => $airtime->phone,
                    'callbackurl' => url("api/airtime/status"),
                ]), 'wallet/airtime');
                Log::info("INITIATE AIRTIME PURCHASE WIGOPAY -" . json_encode($result));
                if ($result->getData()->success):
                    if ($result->getData()->data->success):
                        $data = $result->getData()->data->data;
                        //update airtime
                        Airtime::where("payment_id", $payment->id)->update([
                            "status" => "PENDING",
                            "request_id" => $data->requestId,
                            "discount" => str_replace([' ', 'KES'], ['', ''], $data->discount),
                            "status_description" => json_encode($result->getData()->data)
                        ]);

                    else:
                        //airtime purchase failed -external
                        Airtime::where("payment_id", $payment->id)->update([
                            "status" => "FAILED",
                            "status_description" => json_encode($result->getData()->data)
                        ]);
                        Log::info("Airtime m-pesa purchase failed" . json_encode($result->getData()));
                    endif;

                else:
                    //airtime purchase failed -internal
                    Airtime::where("payment_id", $payment->id)->update([
                        "status" => "FAILED",
                        "status_description" => json_encode($result->getData())
                    ]);
                    Log::info("Airtime m-pesa purchase failed" . json_encode($result->getData()));
                endif;
            endif;
        }

        public function wigopay_callback_airtime(Request $request)
        {
            $fp = fopen('php://input', 'r');
            $postdata = json_decode(stream_get_contents($fp));
            //update airtime'
            Log::info("Wigopay airtime callback success" . json_encode($postdata));
            $airtime = Airtime::where("request_id", $postdata->requestId)->first();
            Airtime::where("request_id", $postdata->requestId)->update([
                "status" => "SUCCESS",
                "request_id" => $postdata->requestId,
                "discount" => str_replace([' ', 'KES'], ['', ''], $postdata->discount),
                "status_description" => json_encode($postdata)
            ]);

            $cbk = new CashbackController();
            $result = $cbk->airtime(new Request([
                "airtime_id" => $airtime->id
            ]));
            Log::info("Cashback-" . json_encode($result));
        }

        public function pokeapay_callback_withdraw(Request $request)
        {
            $fp = fopen('php://input', 'r');
            $postdata = json_decode(stream_get_contents($fp));
            Log::info("WITHDRAW- POKEAPAY CALLBACK " . json_encode($postdata));
            $amount = $postdata->amount;
            $name = $postdata->accountname;
            $phone = $postdata->accountno;
            $fees = $postdata->fees;
            $referenceno = $postdata->referenceno;
            $method = $postdata->method;
            //update the withdrawal method
            $user = User::where("phone", $phone)->first();

            if (!empty($user)):
                //update withdrawal
                $withdraw = Withdraw::where("user_id", $user->id)->where("amount", $amount)->orderBy('id', 'desc')->where("status", 0)->first();
                Withdraw::where("id", $withdraw->id)
                    ->update([
                        "receipt" => $referenceno,
                        "status" => 1,
                        "method" => $method,
                        "description" => "Withdrawal $name-($phone)",
                    ]);
                //income for fep digital
                if ($withdraw->fees > 0):
                    //fund fep account
                    $result = $this->post(new Request([
                        'outlet_code' => env("IWS_FEP_WITHDRAW_INCOME"),
                        'reference' => $referenceno,
                        'description' => "Withdrawal income ksh$amount by $name-($phone)",
                        'receipt_no' => $referenceno,
                        'amount' => $withdraw->fees
                    ]), "transactions/f2o");
                    Log::info("WITHDRAW-FEP INCOME" . json_encode($result));
                endif;
            endif;
        }
    }
