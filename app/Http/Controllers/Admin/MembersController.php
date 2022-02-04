<?php

    namespace App\Http\Controllers\Admin;

    use App\County;
    use App\Http\Controllers\Api\V1\Controller;
    use App\Http\Controllers\Api\V1\JwtAuthenticateController;
    use App\Http\Controllers\Api\V1\MicroServiceController;
    use App\SubCounty;
    use App\User;
    use App\Withdraw;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\View\View;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;

    class MembersController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * @return Factory|View
         */
        public function index(Request $request)
        {
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            if ($request->has('filter_by_date')):
                $filter_by_date = $request->filter_by_date;
                $split_date = explode('-', $filter_by_date);
                $start_date = date('Y-m-d', strtotime($split_date[0]));
                $end_date = date('Y-m-d', strtotime($split_date[1]));
            endif;

            $members = User::with("subcounty")
                ->whereNotNull('customer_code')
                ->where("user_type", "MEMBER")
                ->latest('updated_at')
                ->whereBetween('updated_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])

                ->get();

            return view('members.all', compact("members"));

        }
        public function editView(Request $request)
        {
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            if ($request->has('filter_by_date')):
                $filter_by_date = $request->filter_by_date;
                $split_date = explode('-', $filter_by_date);
                $start_date = date('Y-m-d', strtotime($split_date[0]));
                $end_date = date('Y-m-d', strtotime($split_date[1]));
            endif;
            $member = User::with("subcounty")
                ->whereNotNull('customer_code')
                ->where("user_type", "MEMBER")
                ->where("id", $request->route("member_id"))
                ->first();
            $counties=County::get();
            if ($request->has('county_id')):
                $subcounties=SubCounty::where("county_id",$request->county_id)->get();
            else:
                $subcounties=SubCounty::where("county_id",$member->subcounty->county->id)->get();
            endif;
            $micro = new MicroServiceController();
            $result = $micro->get(new Request(), "customer/float/history/$member->customer_code/$start_date/$end_date");
            $wallet=json_decode(json_encode([]));
            if($result->getData()->success):
                if($result->getData()->data->success):
                    $balance=$result->getData()->data->float;
                    $history=$result->getData()->data->history;
                endif;
            endif;
            $total_withdrawals=Withdraw::where("status",1)
                ->where("user_id",$member->id)
                ->whereBetween('updated_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->sum('amount');
             //levels
            $jwt=new JwtAuthenticateController();
            $result=$jwt->referralLevels(new Request(["user_id"=>$member->id]));
            if($result->getData()->success):
                $levels=$result->getData()->data;
            endif;

            return view('members.edit-view', compact("member","counties","subcounties","balance","total_withdrawals","history","levels"));
        }
        public function updateMember(Request $request)
        {
            $request->validate([
                'id' => 'required',
            ]);
            try {

                $request->request->remove('_token');
                $user = User::where('id', $request->id)->where("user_type","MEMBER")->first();
                if (empty($user)):
                    return response()->json([
                        'success' => false,
                        'errors' => ["user"=>["Member not found"]]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                User::where('id', $request->id)->update($request->only([
                    'firstname',
                    'middlename',
                    'surname',
                    'phone',
                    "email",
                    'status',
                    "doc_type",
                    "doc_no",
                    "sub_county_id",
                    "village",
                ]));

                return response()->json([
                    'success' => true,
                    'message' => 'Member update successfully',
                ], JsonResponse::HTTP_OK);

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' => ["users"=>[$e->getMessage()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

        }


    }
