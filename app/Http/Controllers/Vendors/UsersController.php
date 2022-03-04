<?php

namespace App\Http\Controllers\Vendors;

use App\Business;
use App\Http\Controllers\Controller;
use App\Project;
use App\Role;
use App\Site;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
    {

        public function __construct() {
            $this->middleware('auth');
        }


        public function index(Request $request)
        {

            $user = User::with(["businesses", 'staffs'])
                ->where("id", Auth::id())
                ->first();
            $users = isset($user->staffs) ? $user->staffs : [];;
          return view('vendor.v1.users.index',compact("users"));
        }

        public function showCreateView(Request $request)
        {
                $roles=Role::with(["users","permissions"])->get();
                return view('vendor.v1.users.create',compact("roles"));
        }
        public function showEditView(Request $request)
        {
                $user=User::with(["roles","businesses"])->where("user_type","BUSINESS")->find($request->route("id"));
                $roles=Role::with(["users","permissions"])->get();
                return view('vendor.v1.users.edit',compact("user",'roles'));

        }
        public function update(Request $request)
        {
            $request->validate([
                'id' => 'required|exists:users'
            ]);
            try {
                $user = User::where('id', $request->id)->first();
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
            ]);
            try {
                $request->request->add(['status' => 0, 'otp' => 0,"user_type"=>"BUSINESS"]);
                $staff = User::create($request->only([
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
                //attach roles
                $staff->roles()->sync($request->request->get('role_id'));
                //attach staff
                $staff->users()->attach([Auth::id()]);
                return response()->json([
                    'success' => true,
                    'message' => 'User created successfully'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $projectSite
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        try{
            User::where('id',$request->route("id"))->update(["status"=>3]);
            return response()->json([
                'success' => true,
                'message' => 'User successfully deleted.',
            ], JsonResponse::HTTP_OK);
        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => [
                    "exception" => [
                        $e->getMessage()
                    ]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }

    }
