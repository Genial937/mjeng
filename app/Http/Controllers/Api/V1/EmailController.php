<?php

namespace App\Http\Controllers\Api\V1;

use App\Mail\SendEmail;

use App\Outlet;
use App\OutletBillAccount;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use PHPUnit\Exception;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class EmailController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => []]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function customer_receipt(Request $request){
        $this->validate($request,[
            "outlet_code"=>"required|exists:outlets",
            "reference_no"=>"required|exists:transactions,reference_no",
            "email"=>"required"
        ]);
        $outlet_code=$request->outlet_code;
        $reference_no=$request->reference_no;
        try {
            //load them setting
            $transaction = Transaction::where("reference_no",$reference_no)->first();
            $outlet = Outlet::where('outlet_code', $outlet_code)->first();
            $outlet_phone = $outlet->phone;
            $bill_reference = $transaction->bill_reference;

            $reference_no = $transaction->reference_no;
            $amount = $transaction->amount;
            $customer_phone = $transaction->initiator_account_id;
            $customer_name = $transaction->initiator_account_name;
            $outlet_name = $outlet->name;
            $data['from_name'] = $outlet_name;
            $data['subject'] = "Payment receipt";
            $data['outlet'] =$outlet;
            $data['transaction'] =$transaction;

            $data['template']="emails.receipt";
            $status=Mail::to($request->email)->send(new SendEmail($data));
            return response()->json([
                "success" => true,
                "message" => "Success",
            ], \Illuminate\Http\JsonResponse::HTTP_CREATED);

        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "error" => "something went wrong",
                "exception" => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


     }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function merchant_email_verification(Request $request){
        $this->validate($request,[
            "email"=>"required",
            "code"=>"required"
        ]);

        try {
            //load them setting
            $data['from_name'] = "PCoin";
            $data['subject'] = "Email Verification Code";
            $data['code'] =$request->code;


            $data['template']="emails.merchant_email_verification";
            $status=Mail::to($request->email)->send(new SendEmail($data));
            return response()->json([
                "success" => true,
                "message" => "Success",
            ], \Illuminate\Http\JsonResponse::HTTP_CREATED);

        } catch (Exception $e) {
            return response()->json([
                "success" => false,
                "error" => "something went wrong",
                "exception" => $e->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }
}
