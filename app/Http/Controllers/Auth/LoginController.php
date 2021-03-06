<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\UniqueRandomChar;
use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Helpers\SendAuthEmail;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['logout']]);
    }

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {

        return view('auth.v1.login');

    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        try {
            //check email exist and user is active
            $user = User::whereEmail($request->email)->where("status", 1)->first();
            if (empty($user)):
                return response()->json([
                    'success' => false,
                    'errors' => ["errors" => ["Sorry, Your are not authorised to access. Please contact support for any assistance."]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            if (!isset($request->otp)):
                //check if password is correct before sending
                if (!Hash::check($request->password, $user->password)):
                    //invalid password
                    return response()->json([
                        'success' => false,
                        'errors' => ["errors" => ["Invalid email or password. Please try again."]]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                //generate 6 digit otp and update user
                $otp = UniqueRandomChar::otpCode();
                User::where("id", $user->id)->update(["otp" => $otp]);
                $request->request->add(["otp" => $otp]);
                //send email otp;
                //check if dev
                if (env("APP_ENV") == "production"):
                    $resp = SendAuthEmail::otp($request);
                    $result = $resp->getData();
                    if (!$result->success):
                        return response()->json(
                            [
                                'success' => false,
                                'errors' => $result->errors
                            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                    endif;
                endif;

                return response()->json(
                    [
                        'success' => true,
                        'otp' => true,
                        'message' => 'Please check your email inbox for verification code.'
                    ], JsonResponse::HTTP_CREATED);

            endif;
            //check if otp is correct
            $user = User::where('otp', $request->otp)->where("status", 1)->first();
            if (empty($user)):
                return response()->json([
                    'success' => false,
                    'errors' => ["errors" => ["Invalid OTP. Please type again or resend"]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
            //clear the otp used
            User::where('otp', $request->otp)->update(["otp" => ""]);
            //authenticate user
            $credentials = $request->only('email', 'password');
            if (auth('web')->attempt($credentials)):
                return response()->json([
                    'success' => true,
                    "message" => "Welcome back $user->firstname. Your access has been verified successfully.",
                ], JsonResponse::HTTP_OK);
            else:
                //invalid email/password-injected
                return response()->json([
                    'success' => false,
                    'errors' => ["errors" => ["Invalid email or password. Please try again"]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => ["errors" => [$e->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
