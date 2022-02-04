<?php

    namespace App\Http\Controllers\Admin;

    use App\Airtime;
    use App\County;
    use App\Http\Controllers\Api\V1\Controller;
    use App\Http\Controllers\Api\V1\MicroServiceController;
    use App\Payment;
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

    class WithdrawalsController extends Controller
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
            $status=1;
            $method="M-PESA";
            if ($request->has('filter_by_date')):
                $filter_by_date = $request->filter_by_date;
                $split_date = explode('-', $filter_by_date);
                $start_date = date('Y-m-d', strtotime($split_date[0]));
                $end_date = date('Y-m-d', strtotime($split_date[1]));
            endif;
            if ($request->has('status')):
                $status = $request->status;
            endif;
            if ($request->has('m')):
                $method = $request->m;
            endif;

            $withdrawals = Withdraw::with("user")
                ->where('status',$status)
                ->where('method',$method)
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->orderByDesc('created_at')
                ->get();
            return view('withdrawals.all', compact("withdrawals"));

        }
    }
