<?php

namespace App\Http\Controllers\Api\V1;

use App\Airtime;
use App\Payment;
use App\User;
use App\Withdraw;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $this->validate($request,[
            'user_id' => "required",
            'amount' => "required",
            'type'=>"required"
            ]);
        //create  payment
        $user=User::find($request->user_id);
        $payment=Payment::create([
            "user_id"=>$user->id,
            "amount"=>$request->amount,
            "status"=>0,
            "description"=>"Registration",
            "method"=>"M-PESA",
            "type"=>$request->type
        ]);
        if(empty($payment)):
            return response()->json(['success' => false, "errors" => "Error creating payment"], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        endif;
        //initite mpesa payment
        $micro=new MicroServiceController();
        $result=$micro->mpesa_stkpush(new Request(
            [
                'amount' => $request->amount,
                'phone' => $user->phone,
                'callBackUrl' => "http://fep-api.intrepid.co.ke/payment/status/mpesa",
                'outletCode' => 'OTC33',
                'orderRef' => 'REG_'.$payment->id,
                'variable1' => 'v1',
                'variable2' => 'v2',
                'customerName' => $user->firstname.' '.$user->surname,
                'customerEmail' => $user->email,
            ]
        ));

        Log::info("#### MPESA PUSH ###".json_encode($result->getData()));
        return response()->json(['success' => true, "message" => "initiated successfully"]);
    }


}
