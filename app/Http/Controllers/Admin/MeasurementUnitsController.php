<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
use App\Http\Controllers\Controller;
use App\Project;
use App\SubCounty;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MeasurementUnitsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $units=Configuration::where("column","units")->first();
        $units=empty($units) ?[]:json_decode($units->data);
        return view('admin.v1.config.measurements.index',compact("units"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name"=>"required",
            "symbol"=>"required",
        ]);
        try {
            $currencies=Configuration::where("column",'units')->first();
            if(empty($currencies)):
                $currencies=  Configuration::create([
                    "column"=>"units",
                    "data"=>json_encode([])
                ]);
            endif;
            $json_decode_currency=json_decode($currencies->data);
            array_push($json_decode_currency,
               $request->only('name','symbol')
            );
            $json_decode_currency=json_encode($json_decode_currency);
            Configuration::where("column",'units')->update([
                "data"=>$json_decode_currency
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Measurement unit added successfully',
            ], JsonResponse::HTTP_OK);

        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => [
                    "exception" => [
                        $e->getMessage()
                    ]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            "name"=>"required",
            "id"=>"required|exists:counties"
        ]);
        try {
           County::where("id",$request->id)->update($request->only('name'));
            return response()->json([
                'success' => true,
                'message' => 'County updated successfully',
            ], JsonResponse::HTTP_OK);

        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => [
                    "users"=>[
                        $e->getMessage()
                    ]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }
}
