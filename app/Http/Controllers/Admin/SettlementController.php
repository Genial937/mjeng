<?php

    namespace App\Http\Controllers\Admin;
    use App\Business;
    use App\BusinessSettlement;
    use App\BusinessSettlementHistory;
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
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Illuminate\View\View;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;

    class SettlementController extends Controller
    {
        public function __construct() {
            $this->middleware('auth');
        }

        /**
         * @return Factory|View
         */
        public function index(Request $request){
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            if ($request->has('filter_by_date')):
                $filter_by_date = $request->filter_by_date;
                $split_date = explode('-', $filter_by_date);
                $start_date = date('Y-m-d', strtotime($split_date[0]));
                $end_date = date('Y-m-d', strtotime($split_date[1]));
            endif;
            //get all orders tie to transaction-wallet balance -order by data
//            $transactions=BusinessSettlementHistory::with(["transaction"])
//                ->orderBy('created_at', 'DESC')
//                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
//                ->get();
            $transactions =Transaction::with(["outletcardfloathistory","outletfloathistory"])
                ->orderBy('created_at', 'DESC')
                ->where(
                    function ($query) {
                        $query->where('type', 1);
                           // ->orWhere('type', 4);
                    })->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->get();
            //pending settlement
            $business=Business::where("business_code",env("BUSINESS_CODE"))->with("settlement")->first();
            //sent to bank
            $total_settled_bank=Transaction::where("type",5)->sum("amount");
            //settlement charges
            $total_settled_bank_charges=Transaction::where("type",19)->sum("amount");
            return view('settlements.settlements',compact("transactions","business","total_settled_bank","total_settled_bank_charges"));

        }

    }
