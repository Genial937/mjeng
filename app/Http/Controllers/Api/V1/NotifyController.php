<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Exception;
use Tymon\JWTAuth\Claims\Custom;

class NotifyController extends Controller
{

     private $sms_controller;
     private $email_controller;
    /**
     * NotifyController constructor.
     */
    public function __construct()
    {
        $this->sms_controller=new SmsController();
        $this->email_controller=new EmailController();
        $this->middleware('auth:api', ['except' => ['']]);
    }
    public function sendSms(Request $request){
        $this->validate($request,[
            "phone"=>"required",
            "message"=>"required",
        ]);

        return $this->sms_controller->send($request->phone,$request->message);

    }

}
