<?php

    namespace App\Http\Controllers\Api\V1;

    use App\User;
    use App\Withdraw;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Log;

    class WithdrawController extends Controller
    {

        public function withdraw(Request $request)
        {
            $this->validate($request, [
                'user_id' => "required",
                'amount' => "required",
                //'type'=>"required"
            ]);
            $micro = new MicroServiceController();
            $notify = new NotifyController();
            //calculate the fees
            $fees = $this->charges(new Request(["amount" => $request->amount]))->getData()->fees;
            $withdrawable = $fees + $request->amount;
            //create  withdrawal
            $user = User::find($request->user_id);
            if (empty($user)):
                return response()->json(['success' => false, "errors" => "User not found"]);
            endif;
            $withdraw = Withdraw::create([
                "user_id" => $user->id,
                "amount" => $request->amount,
                "status" => 0,//0-initiated 1-success 2-failed and refund,3-failed -pending refund
                "description" => "member Withdraw",
                "method" => "M-PESA",
                "type" => "WITHDRAW",
                "fees" => $fees
            ]);
            if (empty($withdraw)):
                return response()->json(['success' => false, "errors" => "Error creating payment"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            //debit customer account
            $result = $micro->post(new Request([
                'customer_code' => $user->customer_code,
                'reference' => $withdraw->id,
                "amount" => $withdrawable,
                'description' => "Withdraw",
                'receipt_no' => $withdraw->id
            ]), "transactions/c2f");

            Log::info("WITHDRAW-DEBIT CUSTOMER WALLER" . json_encode($result));
            if ($result->getData()->success):
                if ($result->getData()->data->success):
                    //hint pokeapay and wait for callback response
                    $result = $micro->pokeapay_post(new Request([
                        'business_code' => env("POKEAPAY_BUSINESS_CODE"),
                        'account_no' => $user->phone,
                        "amount" => $request->amount,
                        'withdraw_method' => "CUSTOMERS",
                    ]), "withdraw");
                    Log::info("WITHDRAW- INITIATE ON WIGOPAY" . json_encode($result));
                    return response()->json(['success' => true, "message" => "initiated successfully"]);
                endif;
            endif;
            return response()->json(['success' => false, "errors" => $result->getData()->data->errors]);
        }


        /**
         * Display a listing of the resource.
         *
         * @return JsonResponse
         */
        public function charges(Request $request)
        {
            $this->validate($request, [
                "amount" => "required"
            ]);

            if ($request->amount >= 200 && $request->amount <= 999):
                $fees = 30;
            elseif ($request->amount >= 1000):
                $fees = 50;
            else:
                $fees = 20;
            endif;

            return response()->json(['success' => true, "message" => "initiated successfully", 'fees' => $fees]);
        }


    }
