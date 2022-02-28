<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return JsonResponse
     */
    protected function store(Request $request)
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
        //storre


            return response()->json([
                'success' => true,
                "message" => "Account created successfully,Please veifry your ",
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
