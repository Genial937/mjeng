<?php

    namespace App\Http\Controllers\Admin;
    use App\Business;
    use App\Http\Controllers\Api\V1\Controller;
    use App\Outlet;
    use App\OutletAirtime;
    use App\OutletCardFloat;
    use App\OutletCardFloatHistory;
    use App\OutletFloat;
    use App\OutletFloatHistory;
    use App\OutletOrder;
    use App\Transaction;
    use App\User;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\View\View;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;

    class ProfileController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }
        /**
         * @return Factory|View
         */
        public function index(Request $request){
            if(auth()->check()):
                return view('auth.profile');
            endif;
        }
        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function updateUser(Request $request){
            $this->validate($request,[
                'id' => 'required'
            ]);
            $request->request->remove('_token');
            try {
                $user = User::where('id', $request->id)->first();
                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'errors' =>["validation"=>[ "Account not found"]]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                User::where('id', $request->id)->update($request->all());
                return response()->json([
                    'success' => true,
                    'message' => 'User update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' =>["exception"=>[$e->getMessage()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

        }
        /**
         * @param Request $request
         * @return JsonResponse
         */
        public function changePassword (Request $request)
        {
            $this->validate($request, [
                "old" => "required",
                "new" => "required"
            ]);
            //get me

            $user = auth()->user();
            $old = $request->request->get('old');
            $new = bcrypt($request->request->get('new'));
            try {
                $request->request->add(['email' => $user->email,'password' => $old]);
                $credentials = $request->only('email', 'password');
                try {
                    if (!$token = JWTAuth::attempt($credentials)) {
                        return response()->json([
                            'success' => false,
                            'errors' =>["validation"=>[ 'Invalid password']]
                        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                    }
                } catch (JWTException $e) {
                    // something went wrong
                    return response()->json([
                        'success' => false,
                        'errors' =>["exception"=>[ $e->getMessage()]]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                }
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

    }
