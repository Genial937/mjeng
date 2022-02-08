<?php

    namespace App\Http\Controllers\Admin;
    use App\Permission;
    use App\Role;
    use App\User;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\View\View;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;
    use Illuminate\Foundation\Auth\AuthenticatesUsers;

    class UsersController extends Controller
    {

        public function __construct() {
            $this->middleware('auth');
        }

        //display
        public function usersView(Request $request)
        {
            if(auth()->check()):

                $users=User::with("roles")->where("user_type","SYSTEMS")->get();
                return view('auth.users.users',compact("users"));
            else:
                return redirect(route('login'));
            endif;
        }
        public function userCreateView(Request $request)
        {
            if(auth()->check()):
                $roles=Role::with(["users","permissions"])->get();

                return view('auth.users.create',compact("roles"));
            else:
                return redirect(route('login'));
            endif;
        }
        public function userEditView(Request $request)
        {
            if(auth()->check()):
                $user=User::with("roles")->where("user_type","SYSTEMS")->find($request->route("id"));
                $roles=Role::with(["users","permissions"])->get();
                return view('auth.users.edit',compact("user",'roles'));
            else:
                return redirect(route('login'));
            endif;
        }
        public function updateUser(Request $request)
        {
            $request->validate([
               'id' => 'required'
            ]);
            try {
                $request->request->remove('_token');
                $user = User::where('id', $request->request->get('id'))->where("user_type","SYSTEMS")->first();

                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'errors' => [
                            "user"=>[
                                "User not found"
                            ]
                        ]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;

                $user->roles()->sync($request->roles);
                $request->request->remove('roles');
                User::where('id', $request->id)->update($request->only([
                    'firstname',
                    'middlename',
                    'surname',
                    'phone',
                    "email",
                    'status'
                ]));

                return response()->json([
                    'success' => true,
                    'message' => 'User update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' => [
                        "users"=>[
                            $e->getMessage()
                        ]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

        }
        public function createUser(Request $request)
        {
            $this->validate($request, [
                "firstname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                // "middlename" => "required",
                "surname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                "phone" => "required|unique:users|numeric",
                "email" => "required|unique:users|email",
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
                'roles' => 'required'
            ]);
            try {
                $request->request->add(['status' => 1, 'otp' => 0,'user_type'=>"SYSTEMS",'referral_code'=>'_','doc_no'=>$request->phone,'sub_county_id'=>1,'village'=>"Kilimani"]);
                $user = User::create($request->all(['firstname', 'middlename', 'surname', 'phone', 'email', "user_type",'password','referral_code',"sub_county_id","village","doc_no", 'status', 'otp']));
                //create roles
//                foreach ($request->roles as $role):
//                   $user->roles()->attach($role);
//                endforeach;
                $user->roles()->sync($request->request->get('roles'));
                return response()->json([
                    'success' => true, 'message' => 'User created successfully'
                ], JsonResponse::HTTP_OK);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' => ["users"=>[$e->getMessage()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

        }
        public function changePassword (Request $request)
        {
            $this->validate($request, [
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
            ]);
            //get me

            $user = User::find($request->route("id"));
            $new = bcrypt($request->password);
            try {
                User::where('email',$user->email)->update(['password' => $new]);
                return response()->json([
                    'success' => true,
                    'message' => 'User update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' =>["exception"=>[ $e->getMessage()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        }
        public function  deleteUser(Request $request)
        {
            $this->validate($request, [
                'id' => 'required'
            ]);
            try {
                User::find($request->id)->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'User update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' =>["exception"=>[ $e->getMessage()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
        }



    }
