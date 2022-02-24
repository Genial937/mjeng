<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
use App\EquipmentRequired;
use App\Http\Controllers\Controller;
use App\Project;
use App\Site;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EquipmentRequiredController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        //sites
        $sites=Site::get();
        //measurement units
        $units=Configuration::where("column","units")->first();
        $measurement_units=empty($units) ?[]:json_decode($units->data);
        //currencies
        $currencies=Configuration::where("column","currency")->first();
        $currencies=empty($currencies) ?[]:json_decode($currencies->data);
        //equipment required
        $equipments_required=EquipmentRequired::with(["equipmentType","site"])->get();
        return view('admin.v1.project.create.equipments-required',compact("sites","measurement_units","currencies",'equipments_required'));
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
           "site_id"=>"required|exists:sites,id",
           "equipment_type_id"=>"required|exists:equipment_types,id",
           "no_equipment"=>"required|numeric|min:0",
           "payload_capacity"=>"required|numeric|min:0",
           "payload_unit"=>"required|string",
           "duration_unit"=>"required|string",
           "duration"=>"required|numeric|min:0",
           "currency"=>"required|string",
           "lease_rates"=>"required|numeric|min:0",
           "lease_modality"=>"required|string",
           "fuel_provision"=>"required|string",
           "cess_provision"=>"required|string",
       ]);
       //store to db
        try{
            $equipment_required=EquipmentRequired::create($request->only([
                "site_id",
                "equipment_type_id",
                "no_equipment",
                "payload_capacity",
                "payload_unit",
                "duration_unit",
                "duration",
                "currency",
                "lease_rates",
                "lease_modality",
                "fuel_provision",
                "cess_provision"
            ]));
            return response()->json([
                'success' => true,
                "equipment_required" =>$equipment_required,
                'message' => 'Equipment required successfully saved.',
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
     * Display the specified resource.
     *
     * @param  \App\EquipmentRequired  $taskEquipmentRequired
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentRequired $taskEquipmentRequired)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentRequired  $taskEquipmentRequired
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentRequired $taskEquipmentRequired)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentRequired  $taskEquipmentRequired
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentRequired $taskEquipmentRequired)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentRequired  $taskEquipmentRequired
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentRequired $taskEquipmentRequired)
    {
        //
    }
}
