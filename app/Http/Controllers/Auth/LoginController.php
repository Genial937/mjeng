<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Exception;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Illuminate\View\View
     */
    public function index(Request $request)
    {

            return view('auth.v1.login');

    }
    /**
     * @param Request $request
     * @return \Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
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
        $user = User::whereEmail($request->email)->where("status", 1)->first();
        if (empty($user)):
            return response()->json([
                'success' => false,
                'errors' => ["errors" => ["Sorry, Your are not authorised to access. Please contact support for any assistance."]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        endif;
        try {
            $credentials = $request->only('email', 'password');
            if (auth('web')->attempt($credentials)):
                return response()->json([
                    'success' => true,
                    "message" => "Success",
                ], JsonResponse::HTTP_OK);
            else:
                return response()->json([
                    'success' => false,
                    'errors' => ["errors" => ["Invalid email or password. Please try again"]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
