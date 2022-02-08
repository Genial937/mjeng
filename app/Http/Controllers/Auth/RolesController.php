<?php

namespace App\Http\Controllers\Auth;

use App\Permission;
use App\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zizaco\Entrust\EntrustRole;

class RolesController extends Controller
{



    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if(auth()->check()):
            $roles=Role::with(["users","permissions"])->get();

            $permissions=Permission::with("roles")->get();
            return view('auth.v1.roles_permissions.roles',compact("roles",'permissions'));
        else:
            return redirect(route('login'));
        endif;
    }

    public function createView(Request $request)
    {
        if(auth()->check()):
            $roles=Role::with(["users","permissions"])->get();
            $permissions=Permission::with("roles")->get();
            return view('auth.roles_permissions.create-roles',compact("roles",'permissions'));
        else:
            return redirect(route('login'));
        endif;
    }

    //create roles
    public function createRole(Request $request)
    {
        $this->validate($request, [
            "name" => "required|unique:roles|max:20|min:2|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
            "display_name" => "required|unique:roles|max:20|min:2|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
            "description"=>"required",
            "permissions"=>"required"
        ]);

        try {
            $role = new Role;
            $role->name = $request->request->get('name'); // name of the new role
            $role->display_name = $request->request->get('display_name');; // display name of the new role
            $role->description = $request->request->get('description');
            $role->save();
            //assign role permisssion
//                foreach ($request->permissions as $id):
//                     $permission=Permission::find($id);
//                    $role->attachPermission($permission);
//                endforeach;
            $role->permissions()->sync($request->request->get('permissions'));

            return response()->json([
                'success' => true, 'message' => 'Role created successfully',
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => ["roles"=>[$e->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function roleEditView(Request $request)
    {
        if(auth()->check()):
            $permissions=Permission::with("roles")->get();
            $role=Role::with(["users","permissions"])->find($request->route("id"));
            return view('auth.roles_permissions.edit-roles',compact('role',"permissions"));
        else:
            return redirect(route('login'));
        endif;
    }
    public function editRole(Request $request)
    {
        $this->validate($request, [
            "id" => "required|exists:roles",
        ]);

        try {
            Role::where('id',$request->id)->update($request->only([
                "name",
                "display_name",
                "description"
            ]));
            $role=Role::find($request->id);
            $role->permissions()->sync($request->request->get('permissions'));

            return response()->json([
                'success' => true, 'message' => 'Role updated successfully',
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => ["roles"=>[$e->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    public function  deleteRole(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        try {
            Role::find($request->id)->delete();
            return response()->json([
                'success' => true,
                'message' => 'Role delete successfully',
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
