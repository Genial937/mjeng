<?php

    namespace App\Http\Controllers;

    use Illuminate\Database\QueryException;
    use App\Permission;
    use App\Role;
    use App\User;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Log;
    use PHPUnit\Framework\Exception;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;


    class JwtAuthenticateController extends Controller
    {

        /**
         * Create a new AuthController instance.
         *
         * @return void
         */
        public function __construct()
        {

            $this->middleware('auth:api', ['except' => ['authenticate', 'createUser']]);
        }

        /**
         * @return JsonResponse
         */
        public function index()
        {
            try {
                return response()->json([
                    //  'auth'=>Auth::user(),
                    'success' => true,
                    'users' => User::with('roles')->get(),
                    'message' => "Success"
                ], JsonResponse::HTTP_OK);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        /**
         * @return JsonResponse
         */
        public function find(Request $request)
        {
            try {
                return response()->json([
                    //'auth'=>Auth::user(),
                    'success' => true,
                    'message' => "Success",
                    'user' => User::with('roles')->findOrFail($request->route('user_id'))
                ]);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }


        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function authenticate(Request $request)
        {
            try {
                $credentials = $request->only('phone', 'password');
                try {
                    // verify the credentials and create a token for the user
                    $user = User::where('phone', $request->request->get('phone'))->where('status', 1)->first();

                    if (empty($user)):
                        return response()->json([
                            'message' => 'Unauthenticated',
                            'success' => true,
                        ], JsonResponse::HTTP_UNAUTHORIZED);
                    endif;
                    if (!$token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'success' => false,
                            'error' => 'invalid credentials'
                        ], JsonResponse::HTTP_UNAUTHORIZED);
                    }

                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json([
                        'success' => false,
                        'error' => 'could not create token'
                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                }
                // if no errors are encountered we can return a JWT
                return $this->respondWithToken($token);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        /**
         * Get the token array structure.
         *
         * @param string $token
         *
         * @return JsonResponse
         */
        protected function respondWithToken($token)
        {
            try {
                return response()->json([
                    'success' => true,
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => auth('api')->factory()->getTTL() * 60
                ]);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function createUser(Request $request)
        {
            $this->validate($request, [
                "firstname" => "required|min:2|max:20|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                "middlename" => "nullable",
                "surname" => "nullable",
                "phone" => "required",
                "email" => "nullable",
                "password" => "required",
            ]);
            try {
                $request->request->add(['status' => 1]);
                $user = User::create($request->all(['firstname', 'middlename', 'surname', 'phone', 'email', 'password', 'status']));
                return response()->json([
                    'success' => true,
                    "user"=>$user,
                    'message' => 'Your account has been registered successfully'
                ], JsonResponse::HTTP_CREATED);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

        }


        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function updateUser(Request $request)
        {
            try {

                $request->request->remove('password');
                $user = User::where('id', $request->request->get('id'))->first();
                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'error' => 'user not found'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;
                $user->roles()->sync($request->request->get('roles'));

                $request->request->remove('roles');

                User::where('id', $request->request->get('id'))->update($request->all());

                return response()->json([
                    'success' => true,
                    'message' => 'User update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

        }

        /**
         * Refresh a token.
         *
         * @return JsonResponse
         */
        public function refresh()
        {
            return $this->respondWithToken(auth('api')->refresh());
        }

        /**
         * Get the authenticated User.
         *
         * @return JsonResponse
         */
        public function me()
        {
            return response()->json(
                [
                    'success' => true,
                    'message' => "Success",
                    'user' => auth('api')->user(),
                    'roles' => (Auth::check()) ? Auth::user()->roles()->get() : false
                ]
            );
        }

        /**
         * Log the user out (Invalidate the token).
         *
         * @return JsonResponse
         */
        public function logout()
        {
            auth('api')->logout();

            return response()->json(['message' => 'Successfully logged out']);
        }

        public function roles(Request $request)
        {
            try {
                return response()->json([
                    //  'auth'=>Auth::user(),
                    'success' => true,
                    'users' => Role::all(),
                    'message' => "Success"
                ]);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        public function permissions(Request $request)
        {
            try {
                return response()->json([
                    //  'auth'=>Auth::user(),
                    'success' => true,
                    'users' => Permission::all(),
                    'message' => "Success"
                ]);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        public function createRole(Request $request)
        {
            $this->validate($request, [
                "name" => "required|unique:roles|max:20|min:2|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                "display_name" => "required|unique:roles|max:20|min:2|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/"
                //"description"=>"required"
            ]);
            try {
                $role = new Role;
                $role->name = $request->request->get('name'); // name of the new role
                $role->display_name = $request->request->get('display_name');; // display name of the new role
                $role->description = $request->request->get('description');
                $role->save();
                return response()->json([
                    'success' => true, 'message' => 'Role created successfully', 'user' => $role
                ], JsonResponse::HTTP_OK);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function createPermission(Request $request)
        {
            //to create permission, NB: kindly do some protective checking before saving, visit the Entrust documentation
            //for more available options
            $this->validate($request, [
                "name" => "required|unique:permissions|max:20|min:2|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/",
                "display_name" => "required|unique:permissions|max:20|min:2|regex:/^([a-zA-Z]+)(\s[a-zA-Z]+)*$/"
                //"description"=>"required"
            ]);
            try {
                $viewUsers = new Permission;
                $viewUsers->name = $request->request->get('name'); // name of the new role
                $viewUsers->display_name = $request->request->get('display_name');; // display name of the new role
                $viewUsers->description = $request->request->get('description');
                $viewUsers->save();

                return response()->json([
                    'success' => true, 'message' => 'Role created successfully', 'permission' => $viewUsers
                ], JsonResponse::HTTP_OK);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }

        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function assignRole(Request $request)
        {
            // responsible for assigning a given role to a user.
            // It needs a role ID and a user object
            $this->validate($request, [
                "email" => "required|exists:users",
                "role" => "required"
            ]);
            try {

                $user = User::whereEmail($request->email)->first();
                $role = Role::where('name', $request->role)->first();

                if (empty($role)):
                    return response()->json([
                        'success' => false,
                        'error' => 'role not found'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;

                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'error' => 'user email not found'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;

                $user->roles()->attach($role->id);
                return response()->json([
                    'success' => true,
                    'message' => 'Role successfully assigned'
                ], JsonResponse::HTTP_CREATED);
            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function attachPermission(Request $request)
        {
            $this->validate($request, [
                "role" => "required",
                "name" => "required"
            ]);

            try {
                // adds permission to a role
                $role = Role::where('name', $request->request->get('role'))->first();
                $permission = Permission::where('name', $request->request->get('name'))->first();

                if (empty($role)):
                    return response()->json([
                        'success' => false,
                        'error' => 'role not found'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;

                if (empty($permission)):
                    return response()->json([
                        'success' => false,
                        'error' => 'permission not found'
                    ], JsonResponse::HTTP_NOT_FOUND);

                endif;

                $role->attachPermission($permission);
                return response()->json([
                    'success' => true,
                    'message' => 'Permission added to role'
                ], JsonResponse::HTTP_CREATED);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function assistedChangePassword(Request $request)
        {
            $this->validate($request, [
                "email" => "required",
                "password" => "required"
            ]);
            $password = bcrypt($request->password);
            try {
                $user = User::where('email', $request->email)->first();

                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'errors' => 'Account not found'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;

                User::where('email', $request->request->get('email'))->update(['password' => $password]);
                return response()->json([
                    'success' => true,
                    'message' => 'User updated',
                    'user' => $user
                ], JsonResponse::HTTP_CREATED);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function changePassword(Request $request)
        {
            $this->validate($request, [
                "old" => "required",
                "new" => "required"
            ]);
            //get me
            $user = auth('api')->user();
            $old = $request->request->get('old');
            $new = bcrypt($request->request->get('new'));
            try {
                $request->request->add(['email' => $user->email, 'password' => $old]);
                $credentials = $request->only('email', 'password');
                try {
                    if (!$token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'success' => false,
                            'error' => 'invalid credentials'
                        ], JsonResponse::HTTP_NOT_FOUND);
                    }
                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json([
                        'success' => false,
                        'error' => 'could not create token'
                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                }
                User::where('email', $user->email)->update(['password' => $new]);
                return $this->respondWithToken($token);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'error' => 'something went wrong',
                    'exception' => $e->getMessage()
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            }
        }


    }
