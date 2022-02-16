<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use PHPUnit\Exception;
use Psy\Util\Json;
use Symfony\Component\HttpFoundation\JsonResponse;

class SendEmailController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth:web', ['except' => []]);
    }

    public function otp(Request $request){
        $this->validate($request,[
            "email"=>"required",
            "otp"=>"required"
        ]);

        try {
            Log::error(json_encode($request->all()));
            //load them setting
            $data['from_name'] = env("APP_NAME");
            $data['subject'] = "One Time Password";
            $data['code'] =$request->otp;
            $data['email'] =$request->email;
            $data['template']="emails.one_time_password";
            $status=Mail::to($request->email)->send(new SendEmail($data));
            if (Mail::failures()) {
                Log::error(json_encode(Mail::failures()));
                return response()->json([
                    "success" => false,
                    "errors" =>["err_sending_email"=>[Mail::failures()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            return response()->json([
                "success" => true,
                "message" => "Success",
            ], JsonResponse::HTTP_CREATED);

        }catch(\Swift_TransportException $transportExp){
            return response()->json([
                "success" => false,
                "errors" => ["err_sending_email"=>[$transportExp->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwodReset(Request $request){
        $this->validate($request,[
            "email"=>"required",
            "link"=>"required"
        ]);
        try {
            //load them setting
            $data['from_name'] = "PokeaPay";
            $data['subject'] = "Password Reset";
            $data['link'] =$request->link;
            $data['template']="emails.merchant_password_reset";
            Mail::to($request->email)->send(new SendEmail($data));
            if (Mail::failures()) {
                Log::error(json_encode(Mail::failures()));
                return response()->json([
                    "success" => false,
                    "error" => "something went wrong",
                    "exception" => Mail::failures()
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            return response()->json([
                "success" => true,
                "message" => "Success",
            ], JsonResponse::HTTP_CREATED);

        }catch(\Swift_TransportException $transportExp){
            return response()->json([
                "success" => false,
                "error" => "something went wrong",
                "exception" => $transportExp->getMessage()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }


}
