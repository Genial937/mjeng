<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Http\Controllers\Controller;
use App\Project;
use App\Role;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

 class UsersController extends Controller
    {

        public function __construct() {
            $this->middleware('auth');
        }


        public function index(Request $request)
        {

          $users=User::with("roles")->where("user_type","ADMIN")->get();

          return view('admin.v1.users.index',compact("users"));
        }

        public function showCreateView(Request $request)
        {
                $roles=Role::with(["users","permissions"])->get();
                return view('admin.v1.users.create',compact("roles"));
        }
        public function showEditView(Request $request)
        {
                $user=User::with(["roles","businesses"])->where("user_type","ADMIN")->find($request->route("id"));
                $roles=Role::with(["users","permissions"])->get();
                $businesses=Business::with("users")->where("status",1)->get();
                return view('admin.v1.users.edit',compact("user",'roles','businesses'));

        }
        public function update(Request $request)
        {
            $request->validate([
               'id' => 'required'
            ]);
            try {
                $user = User::where('id', $request->id)->first();
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

                //update user
                User::where('id', $request->id)->update([
                    'firstname'=>$request->firstname,
                    'middlename'=>$request->middlename,
                    'surname'=>$request->surname,
                    'phone'=>$request->phone,
                    "email"=>$request->email,
                    'status'=>$request->status,
                ]);
                //attach new/update role
                $user->roles()->sync($request->role_id);
                return response()->json([
                    'success' => true,
                    'message' => 'User update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (Exception $e) {
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
        public function store(Request $request)
        {
            $this->validate($request, [
                "firstname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                "surname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                "phone" => "required|unique:users",
                "email" => "required|unique:users",
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
                'password_confirmation' => 'min:6',
                'role_id' => 'required',
                "user_type"=>"required",
                "business_id"=>"nullable"
            ]);
            try {
                $request->request->add(['status' => 1, 'otp' => 0]);
                $user = User::updateOrCreate(["email"=>$request->email],$request->all([
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
                ]));

                if($request->user_type=="CONTRACTOR"):
                //$request->business_id
                //attach user to the business
                $user->businesses()->sync($request->business_id);
                 endif;
                //attach roles
                $user->roles()->sync($request->request->get('role_id'));
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
                'id' => 'required|exists:users',
            ]);
            //get me
            $new = bcrypt($request->password);
            try {
                User::where('id',$request->id)->update(['password' => $new]);
                return response()->json([
                    'success' => true,
                    'message' => 'Password updated successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' =>["exception"=>[$e->getMessage()]]
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
