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

    class BusinessesController extends Controller
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
            //get all outlets and their balance
            $micro = new MicroServiceController();
            $result = $micro->get(new Request(), "outlet/search/FEP");
            if($result->getData()->success):
                if($result->getData()->data->success):
                    $outlets=$result->getData()->data->outlets;
                endif;
            endif;
            return view('businesses.all', compact("outlets"));

        }
    }
