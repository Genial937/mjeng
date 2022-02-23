<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\County;
use App\EquipmentType;
use App\Http\Controllers\Controller;
use App\Project;
use App\SubCounty;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountyController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $counties=County::all();
        $subcounties=SubCounty::all();
        return view('admin.v1.config.counties.index',compact("counties"));
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
            "name"=>"required"
        ]);
        try {
           $county=County::create($request->only('name'));
            return response()->json([
                'success' => true,
                "county"=>$county,
                'message' => 'County added successfully',
            ], JsonResponse::HTTP_OK);

        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => [
                    "exception"=>[
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
    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return JsonResponse
     */
    public function find(Request $request)
    {
        try{
            return response()->json([
                'success' => true,
                "county"=>County::with("subcounties")->find($request->route("id")),
                'message' => 'Success',
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

}
