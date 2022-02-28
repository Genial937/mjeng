<?php


namespace App\Helpers;
use App\Business;
use App\Mail\SendEmail;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;


class SendAuthEmail
{
    /**
     * Send Login email OTP
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function otp(Request $request): \Illuminate\Http\JsonResponse
    {

        $request->validate([
            "email"=>"required",
            "otp"=>"required"
        ]);

        try {
            //load them setting
            $data['from_name'] = env("APP_NAME");
            $data['subject'] = "One Time Password";
            $data['code'] =$request->otp;
            $data['email'] =$request->email;
            $data['template']="emails.auth.otp";
            Mail::to($request->email)->send(new SendEmail($data));
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
     * Send a verification code
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public static function verifyEmail(Request $request): \Illuminate\Http\JsonResponse
    {

        $request->validate([
            "email"=>"required",
            "code"=>"required"
        ]);

        try {
            //load them setting
            $data['from_name'] = env("APP_NAME");
            $data['subject'] = "Verify Your Email";
            $data['code'] =$request->code;
            $data['email'] =$request->email;
            $data['template']="emails.auth.verify";
            Mail::to($request->email)->send(new SendEmail($data));
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
