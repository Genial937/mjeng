<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\SendAuthEmail;
use App\Helpers\UniqueRandomChar;
use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {

        return view('auth.v1.register');

    }
    /**
     * @param Request $request
     * @return Factory|View
     */
    public function verify(Request $request)
    {

        return view('auth.v1.verify');

    }

    public function verifyEmail(Request $request){
        $this->validate($request, [
            "code" => "required|exists:users,otp"]
        );
        try {
            //check code exist and user is active
            $user = User::where("otp",$request->code)->where("status", 2)->first();
            if (empty($user)):
                return response()->json([
                    'success' => false,
                    'errors' => ["errors" => ["Sorry, Your account is already verified."]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            //clear the otp used
            User::where('otp', $request->code)->update(["otp" => "","status"=>1]);
            Auth::login($user);
            return response()->json([
                'success' => true,
                "intended"=>route("vendor.profile.account"),
                "message" => "Account verified successfully,Please proceed in settings up your business account",
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => ["errors" => [$e->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

    }
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @return JsonResponse
     */
    protected function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            "firstname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
            "surname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
//            "phone" => "required|unique:users",
            "email" => "required|unique:users",
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6',
        ]);
        try{
        $request->request->add(["user_type"=>"BUSINESS","status"=>2]);
        $user= User::create($request->only(
            'firstname',
            'middlename',
            'surname',
            'phone',
            'email',
            'password',
            'status',
            "notes",
            "otp",
            "user_type"
          ));
         //attach new/update role
          $user->roles()->attach(1);
          //send email verification code
            //generate 6 digit code and update user
            $code=UniqueRandomChar::otpCode();
            User::where("id",$user->id)->update(["otp" => $code]);
            $request->request->add(["code" => $code]);
            //send email otp;
            //check if dev
            if(env("APP_ENV")=="production") :
                $resp = SendAuthEmail::verifyEmail($request);
                $result = $resp->getData();
                if (!$result->success):
                    return response()->json(
                        [
                            'success' => false,
                            'errors' => $result->errors
                        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
            endif;

            return response()->json([
                'success' => true,
                "intended"=>route("email.verify",$user->id),
                "message" => "Account created successfully, Please check your email for verification code",
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => ["errors" => [$e->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
}
