<?php

    namespace App\Http\Controllers\Admin;
    ;
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
            $this->middleware();
        }

        /**
         * @return Factory|View
         */
        public function index(Request $request)
        {
            return view('dashboard');
        }

    }
