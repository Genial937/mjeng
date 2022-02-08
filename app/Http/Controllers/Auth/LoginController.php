<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        if (auth()->check()):
            return redirect(route('dashboard'));
        else:
            return view('auth.v1.login');
        endif;
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
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = User::whereEmail($request->email)->where("status", 1)->where("user_type", "SYSTEMS")->first();
        if (empty($user)):
            return response()->json([
                'success' => false,
                'errors' => ["errors" => ["Sorry, Your are not authorised to access. Please contact support for any assistance."]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        endif;
        try {
            $credentials = $request->only('email', 'password');
            // if ($token = JWTAuth::attempt($credentials)) :
            if (auth('web')->attempt($credentials)):
                return response()->json([
                    'success' => true,
                    "message" => "Success",
                    "intended" => "dashboard",
                ], JsonResponse::HTTP_OK);
            else:
                return response()->json([
                    'success' => false,
                    'errors' => ["errors" => ["Invalid email or password."]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            endif;
        } catch (JWTException $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'error' => 'could not create token'
            ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
