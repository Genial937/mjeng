<?php

namespace App\Http\Controllers\Api\V1;

use App\Merchant;
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
        $this->middleware('auth:api', ['except' => ['outlet_to_settlement']]);
    }

    public function outlet_to_settlement(Request $request){

        //get all the merchants
        $merchants=Merchant::with("business")->get();
        if (empty($merchants)):
            return response()->json([
                "success" => false,
                 //"merchants"=>$merchant,
                "error" => " merchants not found",
            ], JsonResponse::HTTP_FOUND);
        endif;
        foreach ($merchants as $merchant):
        if (count($merchant->business)):
            foreach ($merchant->business as $business):
            if (count($business->outlets)):
                foreach ($business->outlets as $outlet):
                    $tranfer_cont=new TransferController();
                    //$return=$outlet;

                    $return= $tranfer_cont->outlet_to_settlement(new Request([
                        "outlet_code"=>$outlet->outlet_code,
                        "merchant_code"=>$merchant->merchant_code
                    ]));
                endforeach;
            endif;
            endforeach;
        endif;
        endforeach;
        return $return;

    }
}
