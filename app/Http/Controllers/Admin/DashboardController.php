<?php

    namespace App\Http\Controllers\Admin;

    use App\Airtime;

    use App\Http\Controllers\Api\V1\Controller;
    use App\Http\Controllers\Api\V1\MicroServiceController;
    use App\Http\Controllers\Api\V1\NotifyController;

    use App\Payment;
    use App\User;

    use App\Withdraw;
    use Illuminate\Contracts\View\Factory;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\DB;
    use Illuminate\View\View;
    use Tymon\JWTAuth\Exceptions\JWTException;
    use Tymon\JWTAuth\Facades\JWTAuth;

    class DashboardController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * @return Factory|View
         */
        public function index(Request $request)
        {   $micro = new MicroServiceController();
            $notify = new NotifyController();
            $start_date = date("Y-m-d");
            $end_date = date("Y-m-d");
            if ($request->has('filter_by_date')):
                $filter_by_date = $request->filter_by_date;
                $split_date = explode('-', $filter_by_date);
                $start_date = date('Y-m-d', strtotime($split_date[0]));
                $end_date = date('Y-m-d', strtotime($split_date[1]));
            endif;
            //total members
            $users=User::whereNotNull('customer_code')
                ->where("user_type","MEMBER")
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->count();
            //total member registration  Collections
            $total_reg_payments=Payment::where("status",1)
                ->where("type","REG")
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->sum('amount');
            //total members funds
            $result = $micro->get(new Request(), "customer/search/FEP");
            $total_customer_float=0;
            if($result->getData()->success):
                if($result->getData()->data->success):
                    $customers=$result->getData()->data->customers;
                   // $total_customer_float=0;
                     foreach ($customers as $customer):
                         $total_customer_float=$total_customer_float+$customer->float->balance;
                     endforeach;
                endif;
            endif;

            //total members withdrawals
            $total_withdrawals=Withdraw::where("status",1)
                ->whereBetween('created_at', [$start_date . " 00:00:00", $end_date . ' 23:59:59'])
                ->sum('amount');
            //airtime float
            $result = $micro->get(new Request(), "outlet/".env("IWS_FEP_AIRTIME_FLOAT"));
            $fep_airtime_float=0;
            if($result->getData()->success):
                if($result->getData()->data->success):
                    $outlet=$result->getData()->data->outlet;
                    $fep_airtime_float=$outlet->float->balance;
                endif;
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
            //line chart
            $withdrawals=[];
            $registrations=[];
            $month=[];
            for($i=6;$i > -1;$i--):
                $monthDate = Carbon::now()->subMonths($i);
                $start = $monthDate->copy()->startOfMonth()->toDateTimeString();
                $end = $monthDate->copy()->endOfMonth()->toDateTimeString();
                $year = $monthDate->year;
                $month_ = $monthDate->format('F')."-$year";
//                $withdrawals_ = Withdraw::where("status", 1)
//                    ->whereBetween('created_at', array($start, $end))
//                    ->sum("amount");
                $registrations_ = User::whereNotNull('customer_code')
                    ->where("user_type","MEMBER")
                    ->whereBetween('created_at', array($start, $end))
                    ->count();


               // array_push($withdrawals,$withdrawals_);
                array_push($registrations,$registrations_);
                array_push($month,$month_);
                endfor;
                $line_chart_data=["label"=>$month,"data"=>[$registrations]];
            return view('dashboard', compact("users",'total_customer_float','total_withdrawals',"total_reg_payments","fep_airtime_float","total_airtime_payments","total_airtime_payments_pending","total_airtime_payments_failed","line_chart_data"));
        }

    }
