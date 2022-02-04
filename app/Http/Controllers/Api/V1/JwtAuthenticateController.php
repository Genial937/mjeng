<?php

    namespace App\Http\Controllers\Api\V1;

    use App\Payment;
    use App\Referral;
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
        protected $notify_controller;

        /**
         * Create a new AuthController instance.
         *
         * @return void
         */
        public function __construct()
        {
            $this->notify_controller = new NotifyController();
            $this->middleware('auth:api', ['except' => ['authenticate', 'createUser', 'assignRole',"referralRanking"]]);
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
         * @return JsonResponse
         */
        public function findUser(Request $request)
        {

            try {
                //get the customer and wallets
                $user = User::where("phone", $request->route("phone"))->first();
                $micro = new MicroServiceController();
                if(!isset($user->customer_code)):
                    return response()->json([
                        'success' => false,
                        'errors' => 'Account not registered'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;
                 $result = $micro->get(new Request(), "customer/by/".$user->customer_code);
                return response()->json([
                    //'auth'=>Auth::user(),
                    'success' => true,
                    'message' => "Success",
                    'user_id' => $user->id,
                    'rank' => $user->notes,
                    'membership_no' => $user->referral_code,
                    'user' => $result->getData()->data
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
                "invite_code" => "required",
                "doc_type" => "required",
                "doc_no" => "required",
                "village" => "required",
                "sub_county_id" => "required"
            ]);
            try {
                $user = User::where("referral_code", $request->invite_code)->first();
                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'error' => "Invite code is invalid, Please try again."
                    ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
                endif;
                //generate referral code
                $referral_code = $this->generateReferralCode();
                $user_ = User::where("phone", $request->phone)->first();
                if (empty($user_)):
                    $request->request->add(["referral_code" => $referral_code, 'status' => 1]);
                    $new_user = User::create($request->all(['firstname', 'middlename', 'surname', 'phone', 'email', 'password', 'status', "referral_code", "doc_type", "doc_no", 'village', "sub_county_id"]));
                    //attach
                    Referral::create(["user_id" => $new_user->id, 'referee_id' => $user->id]);
                    $pay = new PaymentController();
                    $pay->index(new Request([
                        "amount" => 1000,
                        "type" => "REG",
                        "user_id" => $new_user->id
                    ]));
                else:
               $payment=Payment::where("user_id",$user_->id)
                        ->where("type","REG")
                        ->where("amount",1000)
                        ->where("status",1)
                        ->first();
                if(empty($payment)):
                    $pay = new PaymentController();
                    $pay->index(new Request([
                        "amount" => 1000,
                        "type" => "REG",
                        "user_id" => $user_->id
                    ]));
                else:
                      return response()->json([
                          'success' => false, 'error' => 'User is registered.'
                      ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                endif;
                return response()->json([
                    'success' => true, 'message' => 'Your account has been registered successfully'
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

        protected function generateReferralCode()
        {
            try {
                for ($i = 1; $i <= 999999; $i++):
                   // $count = str_split($i);
//                    if (count($count) == 2):
//                        $code = "FEP".$i;
//                    elseif (count($count) == 1):
//                        $code = "FEP0" . $i;
//                    else:
                        $code = "FEP00" . $i;
                    //endif;

                    $user = User::where('referral_code', $code)->first();
                    if (empty($user)):
                        break 1;
                    endif;
                endfor;
                return $code;
            } catch (QueryException $e) {
                return $e->getMessage();
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
                //  $request->request->remove('otp_expiry');

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

        public function sendOtp(Request $request)
        {
            try {
                $user = auth('api')->user();
                $email = $user->email;
                $otp = rand(100000, 999999);
                $expiry = date('Y-m-d H:i:s');
                User::where('email', $email)->update(['otp' => $otp]);
                $request->request->add(['otp' => $otp, '']);
                $notification = $this->notify_controller->AuthOtpNotification($request);
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent'
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

        public function verifyOtp(Request $request)
        {
            $this->validate($request, [
                "otp" => "required|numeric",
            ]);
            try {
                $user = auth('api')->user();
                //$email = $user->email;
                $otp = $request->request->get('otp');
                $expiry = date('Y-m-d H:i:s');
                $acc = User::where('id', $user->id)->where('otp', $otp)->first();
                if (empty($acc)):
                    return response()->json([

                        'success' => false,
                        'error' => 'Invalid OTP'
                    ], JsonResponse::HTTP_NOT_FOUND);
                endif;
                //clear otp
                User::where('id', $user->id)->update(['otp' => 0, 'otp_expiry' => null]);
                return response()->json([
                    'success' => true,
                    'message' => 'OTP success'
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
        public function referralLevels(Request $request){
            $this->validate($request,[
                "user_id"=>"required"
            ]);
            $user=User::find($request->user_id);
            if(empty($user)):
                return response()->json([
                    'success' => false,
                    'errors' => 'Account not found',
                ], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            endif;
            //get all referrals level 1
            $referrals=Referral::where("referee_id",$user->id)->get();
            $level1=0;
            $level2=0;
            $level3=0;
            $level4=0;
            $level5=0;
            $level6=0;
            $level7=0;
            $level8=0;
            foreach ($referrals as $referral):
                $level1+=1;
                 //level 2
                $referrals_level_2=Referral::where("referee_id",$referral->id)->get();
                foreach ($referrals_level_2 as $referral_2):
                    $level2+=1;
                    //level 3
                    $referrals_level_3=Referral::where("referee_id",$referral_2->id)->get();
                    foreach ($referrals_level_3 as $referral_3):
                        $level3+=1;
                        //level 4
                        $referrals_level_4=Referral::where("referee_id",$referral_3->id)->get();
                        foreach ($referrals_level_4 as $referral_4):
                            $level4+=1;
                            //level 5
                            $referrals_level_5=Referral::where("referee_id",$referral_4->id)->get();
                            foreach ($referrals_level_5 as $referral_5):
                                $level5+=1;
                                //level 6
                                $referrals_level_6=Referral::where("referee_id",$referral_5->id)->get();
                                foreach ($referrals_level_6 as $referral_6):
                                    $level6+=1;
                                    //level 7
                                    $referrals_level_7=Referral::where("referee_id",$referral_6->id)->get();
                                    foreach ($referrals_level_7 as $referral_7):
                                        $level7+=1;
                                        //level 8
                                        $referrals_level_8=Referral::where("referee_id",$referral_7->id)->get();
                                        foreach ($referrals_level_8 as $referral_8):
                                            $level8+=1;
                                        endforeach;
                                    endforeach;
                                endforeach;
                            endforeach;
                        endforeach;
                    endforeach;
                endforeach;
            endforeach;
            //update the rank for each person


            return response()->json([
                'success' => true,
                'data' => [
                    "level1"=>$level1,
                    "level2"=>$level2,
                    "level3"=>$level3,
                    "level4"=>$level4,
                    "level5"=>$level5,
                    "level6"=>$level6,
                    "level7"=>$level7,
                    "level8"=>$level8
                ]
            ], JsonResponse::HTTP_OK);
        }


        public function referralRanking(Request $request){

            $users=User::get();
            if(!empty($users)):

                foreach ($users as $user):
                 $referrals=Referral::where("referee_id",$user->id)->get();
                    User::where("id",$user->id)->update([
                        "notes"=>"MEMBER"
                    ]);
                 if(count($referrals) >=12):
                    User::where("id",$user->id)->update([
                        "notes"=>"LEADER"
                   ]);
                  endif;
                    $levels=$this->referralLevels(new Request(["user_id"=>$user->id]))->getData()->data;
                    $level1=$levels->level1;
                    $level2=$levels->level2;
                    $level3=$levels->level3;
                    $level4=$levels->level4;
                    $level5=$levels->level5;
                    $level6=$levels->level6;
                    $level7=$levels->level7;
                    $level8=$levels->level8;
                    $members=$level1+$level2+$level3+$level4+$level5+$level6+$level7;
                    $leaders=0;
                    $cordinators=0;
                    $directors=0;
                    $generals=0;

                  foreach($referrals as $referral):
                   $user_id=$referral->user_id;
                   $user=User::where("id",$user_id)->first();
                   if(!empty($user)):
                       if($user->notes=="LEADER"):
                           $leaders++;
                       elseif($user->notes=="COORDINATOR"):
                           $cordinators++;
                       elseif($user->notes=="DIRECTOR"):
                           $directors++;
                       elseif($user->notes=="GENERAL"):
                           $generals++;
                        endif;
                    endif;
                  endforeach;
                    Log::info("USERID ====>".$user->id);
                    Log::info("REFERRALS ".count($referrals));
                    Log::info("LEADER ".$leaders);
                    Log::info("COORDINATOR ".$cordinators);
                    Log::info("DIRECTOR ".$directors);
                    Log::info("GENERAL ".$generals);
                    Log::info("MEMBERS ".$members);
                   if($leaders >=3 || $members >= 50):
                        User::where("id",$user->id)->update([
                            "notes"=>"COORDINATOR"
                        ]);
                   endif;

                    if($cordinators >=3 || $members >= 200):
                        User::where("id",$user->id)->update([
                            "notes"=>"DIRECTOR"
                        ]);
                    endif;
                    if($directors>=3 || $members >= 500):
                        User::where("id",$user->id)->update([
                            "notes"=>"GENERAL"
                        ]);
                    endif;

                    if($generals >=3 || $members >= 3000):
                        User::where("id",$user->id)->update([
                            "notes"=>"EXECUTIVE GENERAL"
                        ]);
                    endif;
                endforeach;
            endif;
        }
    }
