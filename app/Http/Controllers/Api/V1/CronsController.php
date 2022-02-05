<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CronsController extends Controller
{
    /**
     * TransferController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['']]);
    }


}
