<?php

    namespace App\Http\Controllers\Admin;

    use App\Airtime;
    use App\County;
    use App\Http\Controllers\Api\V1\Controller;
    use App\Http\Controllers\Api\V1\MicroServiceController;
    use App\SubCounty;
    use App\User;
    use App\Withdraw;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Database\QueryException;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use Illuminate\View\View;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;

    class AirtimeController extends Controller
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
            $status="SUCCESS";

            if ($request->has('filter_by_date')):
                $filter_by_date = $request->filter_by_date;
                $split_date = explode('-', $filter_by_date);
                $start_date = date('Y-m-d', strtotime($split_date[0]));
                $end_date = date('Y-m-d', strtotime($split_date[1]));
            endif;
            if ($request->has('status')):
                $status = $request->status;
            endif;
            //total airtime sold-success
            $total_airtime_payments=Airtime::where("status","SUCCESS")
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->sum('amount');
            //total airtime sold-pending
            $total_airtime_payments_pending=Airtime::where("status","PENDING")
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->sum('amount');
            //total airtime sold-pending
            $total_airtime_payments_failed=Airtime::where("status","FAILED")
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->sum('amount');
            $airtimes = Airtime::with("payment")
                ->where('status',$status)
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->orderByDesc('created_at')
                ->get();
            return view('airtime.all', compact("airtimes","total_airtime_payments","total_airtime_payments_pending","total_airtime_payments_failed"));

        }

        public function resendAirtime(Request $request)
        {
            $request->validate([
                'id' => 'required',
            ]);
            try {
                $micro = new MicroServiceController();
                $request->request->remove('_token');
                $airtime = Airtime::where('id', $request->id)->where("status","!=","SUCCESS")->first();
                if (empty($airtime)):
                    return response()->json([
                        'success' => false,
                        'errors' => ["airtime"=>["Airtime transaction not found"]]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;
                //re -initiate airtime transaction
                $result = $micro->wigopay_post(new Request([
                    'merchantCode' => env("WIGOPAY_AIRTIME_MERCHANTCODE"),
                    'amount' => $airtime->amount,
                    'recipient' => $airtime->recipient,
                    'phone' => $airtime->phone,
                    'callbackurl' => url("api/airtime/status"),
                ]), 'wallet/airtime');

                Log::info("Wigopay buy airtime resend airtime - " . json_encode($result));
                if ($result->getData()->success):
                    if ($result->getData()->data->success):
                        //update airtime
                        $data = $result->getData()->data->data;
                        Airtime::where("id", $airtime->id)->update([
                            "status" => "SUCCESS",
                            "request_id" => $data->requestId,
                            "discount" => str_replace([' ', 'KES'], ['', ''], $data->discount),
                            "status_description" => json_encode($result->getData()->data)
                        ]);
                        return response()->json(['success' => true, "message" => "Airtime resent successfully."], JsonResponse::HTTP_OK);

                    else:
                        return response()->json(['success' => false,  'errors' => ["airtime"=>[ $result->getData()->data]]], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                    endif;
                else:
                    return response()->json(['success' => false,  'errors' => ["airtime"=>[ $result->getData()->errors]]], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                endif;

            } catch (QueryException $e) {
                // something went wrong
                return response()->json([
                    'success' => false,
                    'errors' => ["airtime"=>[$e->getMessage()]]
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }

        }
    }
