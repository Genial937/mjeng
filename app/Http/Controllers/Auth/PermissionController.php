<?php

namespace App\Http\Controllers\Auth;

use App\Permission;
use App\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zizaco\Entrust\EntrustPermission;

class PermissionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function createView(Request $request)
    {
        if(auth()->check()):
            $roles=Role::with(["users","permissions"])->get();
            $permissions=Permission::with("roles")->get();
            return view('auth.roles_permissions.create-permission',compact("roles",'permissions'));
        else:
            return redirect(route('login'));
        endif;
    }
    public function create(Request $request)
    {
        //to create permission, NB: kindly do some protective checking before saving, visit the Entrust documentation
        //for more available options
        $this->validate($request, [
            "name" => "required|unique:permissions|max:20|min:2",
            "display_name" => "required|unique:permissions|max:20|min:2",
            "description"=>"required"
        ]);
        try {
            $viewUsers = new Permission;
            $viewUsers->name = $request->request->get('name'); // name of the new role
            $viewUsers->display_name = $request->request->get('display_name');; // display name of the new role
            $viewUsers->description = $request->request->get('description');
            $viewUsers->save();

            return response()->json([
                'success' => true, 'message' => 'Role created successfully'
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => ["permission"=>[$e->getMessage()]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
}
