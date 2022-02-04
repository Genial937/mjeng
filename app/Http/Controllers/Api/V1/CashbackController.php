<?php

    namespace App\Http\Controllers\Api\V1;

    use App\Airtime;
    use App\Payment;
    use App\Referral;
    use App\User;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Log;

    class CashbackController extends Controller
    {


        public function airtime(Request $request)
        {
            $this->Validate($request, [
                "airtime_id" => "required|exists:airtimes,id"
            ]);
            $micro = new MicroServiceController();
            $notify = new NotifyController();
            $airtime = Airtime::with("payment")->find($request->airtime_id);
            $customer_cashback = $airtime->amount * 0.02;

            $fep_income = $airtime->amount * 0.00;
            //$luxil_income = $airtime->amount * 0.02;
            //CHECK IF THE FEP IWS ACCOUNT IS FUNDED
            $result = $micro->get(new Request(), "outlet/" . env('IWS_FEP_AIRTIME_FLOAT'));
            if ($result->getData()->success):
                if ($result->getData()->data->success):
                    $outlet = $result->getData()->data->outlet;
                    if ($outlet->float->balance < $airtime->payment->amount):
                        return response()->json(['success' => false, "message" => "ReSeller Account has insufficient funds", $airtime]);
                    endif;
                endif;
            endif;
            if ($airtime->payment->method == "M-PESA"):
                //DEBIT FEP -CREDIT LUXIL AIRTIME
                $result = $micro->post(new Request([
                    'outlet_code_d' => env("IWS_FEP_AIRTIME_FLOAT"),
                    'outlet_code_c' => env("IWS_LUXIL_AIRTIME_SOLD"),
                    'reference' => $airtime->payment->receipt,
                    'description' => $airtime->payment->description,
                    'receipt_no' => $airtime->payment->receipt,
                    'amount' => $airtime->payment->amount
                ]), "transactions/o2o");
            endif;

            Log::info("DEBIT FEP AIRTIME FLOAT WALLET -" . json_encode($result));
            //fund the commission account with 6% commission
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_LUXIL_COMMISSION_ACC"),
                'reference' => $airtime->payment->receipt,
                'description' => "6% Commission airtime purchase-" . $airtime->payment->amount,
                'receipt_no' => $airtime->payment->receipt,
                'amount' => $airtime->payment->amount * 0.06
            ]), "transactions/f2o");
            Log::info("Commission Airtime purchase -" . json_encode($result));
            //reseller->2%
//            $result = $micro->post(new Request([
//                'outlet_code_d' => env("IWS_LUXIL_COMMISSION_ACC"),
//                'outlet_code_c' => env("IWS_FEP_AIRTIME_INCOME"), //commission wallet
//                'reference' => $airtime->request_id,
//                'description' => "Airtime income(FEP)-4%",
//                'receipt_no' => $airtime->payment->receipt,
//                'amount' => $fep_income
//            ]), "transactions/o2o");

            Log::info("reseller->4%" . json_encode($result));
            //customer cashback->2%
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_AIRTIME_INCOME"),
                'customer_code' => $airtime->payment->user->customer_code,
                'reference' => $airtime->request_id,
                "amount" => $customer_cashback,
                'description' => "Airtime cashback(CUSTOMER)",
                'receipt_no' => $airtime->payment->receipt,
            ]), "transactions/o2c");
            Log::info("customer cashback->2%" . json_encode($result));
            $referee=Referral::where("user_id",$airtime->payment->user->id)->first();
            $user=User::where("id",$referee->referee_id)->first();
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_AIRTIME_INCOME"),
                'customer_code' => $user->customer_code,
                'reference' => $airtime->request_id,
                "amount" => $airtime->amount * 0.005,
                'description' => "Airtime cashback(CUSTOMER)",
                'receipt_no' => $airtime->payment->receipt,
            ]), "transactions/o2c");
            Log::info("customer cashback->5%" . json_encode($result));
            $referee=Referral::where("user_id",$user->id)->first();
            $user=User::where("id",$referee->referee_id)->first();
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_AIRTIME_INCOME"),
                'customer_code' => $user->customer_code,
                'reference' => $airtime->request_id,
                "amount" => $airtime->amount * 0.005,
                'description' => "Airtime cashback(CUSTOMER)",
                'receipt_no' => $airtime->payment->receipt,
            ]), "transactions/o2c");
            Log::info("customer cashback->.5%" . json_encode($result));
            $referee=Referral::where("user_id",$user->id)->first();
            $user=User::where("id",$referee->referee_id)->first();
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_AIRTIME_INCOME"),
                'customer_code' => $user->customer_code,
                'reference' => $airtime->request_id,
                "amount" => $airtime->amount * 0.005,
                'description' => "Airtime cashback(CUSTOMER)",
                'receipt_no' => $airtime->payment->receipt,
            ]), "transactions/o2c");
            Log::info("customer cashback->.5%" . json_encode($result));
            $referee=Referral::where("user_id",$user->id)->first();
            $user=User::where("id",$referee->referee_id)->first();
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_AIRTIME_INCOME"),
                'customer_code' => $user->customer_code,
                'reference' => $airtime->request_id,
                "amount" => $airtime->amount * 0.005,
                'description' => "Airtime cashback(CUSTOMER)",
                'receipt_no' => $airtime->payment->receipt,
            ]), "transactions/o2c");
            Log::info("customer cashback->.5%" . json_encode($result));
            return response()->json(['success' => true, "message" => "AIRTIME CASHBACK AWARDED SUCCESSFULLY"], JsonResponse::HTTP_OK);
        }


        public function award(Request $request)
        {
            $this->Validate($request, [
                "payment_id" => "required|exists:payments,id"
            ]);
            $micro = new MicroServiceController();
            $notify = new NotifyController();
            $payment = Payment::find($request->payment_id);
            if ($payment->amount != 1000):
                Log::info("FAILED CASHBACK AMOUNT IS LESS THANK REWARD");
                return response()->json(['success' => false, "message" => "Amount is Invalid -Cannot award"]);
            endif;
            //businesses cashback
            //split the expense 1-50
            //-o2c
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                'customer_code' => env("IWS_CUSTOMER_EXP1"),
                'reference' => $payment->id,
                "amount" => '50',
                'description' => "Expense 1- Membership Registration Commission",
                'receipt_no' => $payment->receipt
            ]), "transactions/o2c");
            Log::info("Expense 1" . json_encode($result));
            //expense 2-50
            //-o2c
            $result = $micro->post(new Request([
                'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                'customer_code' => env("IWS_CUSTOMER_EXP2"),
                'reference' => $payment->id,
                "amount" => '50',
                'description' => "Expense 2- Membership Registration Commission",
                'receipt_no' => $payment->receipt
            ]), "transactions/o2c");
            Log::info("Expense 2" . json_encode($result));

            //luxil-150
            //o2o
            $result = $micro->post(new Request([
                'outlet_code_d' => env("IWS_FEP_HOLDING_ACC"),
                'outlet_code_c' => env("IWS_LUXIL_REG_ACC"),
                'reference' => $payment->id,
                "amount" => '150',
                'description' => "Luxil Membership Commission",
                'receipt_no' => $payment->receipt
            ]), "transactions/o2o");
            //leave 150 in the wallet
            Log::info("Luxil Commission" . json_encode($result));

            //fep-settlement commission
            //o2o
            $result = $micro->post(new Request([
                'outlet_code_d' => env("IWS_FEP_HOLDING_ACC"),
                'outlet_code_c' => env("IWS_FEP_REG_INCOME_ACC"),
                'reference' => $payment->id,
                "amount" => '150',
                'description' => "Fep Membership Commission",
                'receipt_no' => $payment->receipt
            ]), "transactions/o2o");
            //leave 150 in the wallet
            Log::info("Fep Membership Commission" . json_encode($result));

            //reward commission level one -200 - Reward immediate referee of the payer
            //500
            $amount = 500;
            $referee = Referral::where("user_id", $payment->user_id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '200',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level one" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 200;
                        $referred_user = User::find($payment->user_id);
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 200 from $referred_user->phone . Dial *483*30# to access your FEP Digital account."]));
                    endif;
                endif;
            endif;
            //reward commission level two -100
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '100',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level two" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 100;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 100. Dial *483*30# to access your FEP Digital account. "]));
                    endif;
                endif;
            endif;
            //reward commission level three -75
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '75',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level three" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 75;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 75. Dial *483*30# to access your FEP Digital account."]));
                    endif;
                endif;
            endif;
            //reward commission level four -50
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '50',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level four" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 50;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 50. Dial *483*30# to access your FEP Digital account. "]));
                    endif;
                endif;
            endif;
            //reward commission level five -30
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '30',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level five" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 30;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 30. Dial *483*30# to access your FEP Digital account."]));
                    endif;
                endif;
            endif;
            //reward commission level six -20
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '20',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level six" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 20;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 20. Dial *483*30# to access your FEP Digital account."]));
                    endif;
                endif;
            endif;
            //reward commission level seven -15
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '15',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level seven" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 15;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 15. Dial *483*30# to access your FEP Digital account."]));
                    endif;
                endif;
            endif;
            //reward commission level eight -10
            $referee = Referral::where("user_id", $user->id)->first();
            if (!empty($referee)):
                $user = User::find($referee->referee_id);
                if (!empty($user)):
                    $result = $micro->post(new Request([
                        'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                        'customer_code' => $user->customer_code,
                        'reference' => $payment->id,
                        "amount" => '10',
                        'description' => "Membership commission",
                        'receipt_no' => $payment->receipt
                    ]), "transactions/o2c");
                    Log::info("Level eight" . json_encode($result));
                    if ($result->getData()->data->success):
                        $amount = $amount - 10;
                        $result = $notify->sendSms(new Request(['phone' => $user->phone, 'message' => "Congratulations. Your have earned a referral commission ksh 10. Dial *483*30# to access your FEP Digital account."]));
                    endif;
                endif;
            endif;
            //-b2o
            //surplus
            $result = $micro->post(new Request([
                'outlet_code_d' => env("IWS_FEP_HOLDING_ACC"),
                'outlet_code_c' => env("IWS_INTREPID_SUPLUS"),
                'reference' => $payment->id,
                "amount" => $amount + 100,
                'description' => "Surplus Commission",
                'receipt_no' => $payment->receipt
            ]), "transactions/o2o");
            Log::info("Surplus" . json_encode($result));
            return response()->json(['success' => true, "message" => "REGISTRATION COMMISSION AWARDED SUCCESSFULLY"], JsonResponse::HTTP_OK);
        }

        public function undoAward(Request $request)
        {
            $this->validate($request, [
                "payment_id" => "required"
            ]);
            $micro = new MicroServiceController();
            $notify = new NotifyController();
            $result = $micro->post(new Request([
                'receipt_no' => $request->payment_id
            ]), "transactions/by/receipt");
            if ($result->getData()->success):
                if (!$result->getData()->data->success):
                    return response()->json(['success' => false, "errors" => $result->getData()->data->errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                $transactions = $result->getData()->data->transaction;
                //loop all transactions
                foreach ($transactions as $transaction):
                    //check if the transaction was reversed
                    if (strpos($transaction->description, "reversal") == false):
                        $amount = $transaction->amount;//amount credit
                        $type = $transaction->type;//transaction type
                        switch ($type):
                            case "o2c":
                                //get the customer account to debit
                                $customer = $transaction->customer_history->float->customer;
                                $customer_code = $customer->customer_code;
                                //c2o
                                $result = $micro->post(new Request([
                                    'outlet_code' => env("IWS_FEP_HOLDING_ACC"),
                                    'customer_code' => $customer_code,
                                    'reference' => $transaction->reference_no,
                                    "amount" => $amount,
                                    'description' => "Membership commission reversal",
                                    'receipt_no' => $transaction->reference_no
                                ]), "transactions/c2o");
                                Log::info("########## $transaction->description reversal" . json_encode($result));
                                break;
                            case "o2o":
                                //get the outlet account to debit
                                if ($transaction->description == "Luxil Membership Commission"):
                                    $outlet_code = env("IWS_LUXIL_REG_ACC");
                                elseif ($transaction->description == "Fep Membership Commission"):
                                    $outlet_code = env("IWS_FEP_REG_INCOME_ACC");
                                elseif ($transaction->description == "Surplus Commission"):
                                    $outlet_code = env("IWS_INTREPID_SUPLUS");
                                endif;
                                //o2o
                                $result = $micro->post(new Request([
                                    'outlet_code_d' => $outlet_code,
                                    'outlet_code_c' => env("IWS_FEP_HOLDING_ACC"),
                                    'reference' => $transaction->reference_no,
                                    "amount" => $amount,
                                    'description' => "Membership commission reversal",
                                    'receipt_no' => $transaction->reference_no
                                ]), "transactions/o2o");
                                Log::info("########## $transaction->description - reversal" . json_encode($result));
                                break;
                        endswitch;
                    endif;
                    // o2c -reverse -debit -credit holding account
                endforeach;
                return response()->json(['success' => true, "message" => "Reversed"], JsonResponse::HTTP_OK);
            endif;
        }
        public function checkUnAwarded(Request $request)
        {

            $micro = new MicroServiceController();
            $count=0;
            $to_pay=array();
            $payments=Payment::where("status",1)
                ->where("type",'REG')
                ->whereBetween('created_at', ["2021-06-01 12:40:29 00:00:00",'2021-07-15 12:40:29 23:59:59'])
                ->get();
            foreach ($payments as $payment):
            $result = $micro->post(new Request([
                'receipt_no' => $payment->receipt
            ]), "transactions/by/receipt");
            if ($result->getData()->success):
                if (!$result->getData()->data->success):
                    return response()->json(['success' => false, "errors" => $result->getData()->data->errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                $transactions = $result->getData()->data->transaction;
                if(count($transactions)==0):
                     $count++;
                    if($count <= 1):
                        //award
//                        $this->award(new Request([
//                          "payment_id"=>  $payment->id
//                        ]));
                      array_push($to_pay,$payment);
                    endif;
                endif;
            endif;
            endforeach;
            return response()->json(['success' => true, "message" => "count $count -".count($payments),$to_pay], JsonResponse::HTTP_OK);
        }

        public function unward_payment(Request $request)
        {

            $micro = new MicroServiceController();

                $payments = Payment::where("status",1)
                   // ->whereBetween('created_at', ["2021-05-01 00:00:00",'2021-05-20 23:59:59'])
                    ->where("type","REG")
                    ->get();
            $sum = 0;
                $incomplete = array();
                $receipt = null;
                foreach ($payments as $payment):
                        $result = $micro->post(new Request([
                            'receipt_no' => $payment->id
                        ]), "transactions/sum");
                        if ($result->getData()->success):
                            $total = $result->getData()->data->total;
//                                    if ($total < 1000):
                                      $sum=$payment->amount+$sum;
                                        //get the transaction
                                        $payment = Payment::with('user')->where("receipt", $payment->receipt)->first();
                            if (!isset($payment->user->customer_code)):
                                        array_push($incomplete, array('receipt' => $payment->receipt, 'payment' => $payment,"sum"=>"$sum", "amount" => $total));
                                    //endif;
                            endif;
                        endif;
               endforeach;
                return response()->json(['success' => true, "message" => $incomplete], JsonResponse::HTTP_OK);

        }

    }
