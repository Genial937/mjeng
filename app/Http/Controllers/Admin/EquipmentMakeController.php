<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
use App\EquipmentMake;
use App\EquipmentType;
use App\Http\Controllers\Controller;
use App\MaterialType;
use App\Project;
use App\SubCounty;
use App\Task;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EquipmentMakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $equipment_types = EquipmentType::with("task")->get();
        $equipment_makes = EquipmentMake::with("equipmentTypes")->get();;
        return view('admin.v1.config.equipment-make.index', compact("equipment_types", 'equipment_makes'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "name" => "required|unique:equipment_makes",
            "equipment_type_id" => "required|array|min:1",
            "equipment_type_id.*"  => "required|string|distinct|min:1",
            "description" => "nullable",
        ]);
        try {
            $equipment_make=EquipmentMake::create($request->only(
                "name",
                "description",
                "status"
            ));
            //attach a equipment type
            $equipment_make->equipmentTypes()->sync($request->equipment_type_id);

            return response()->json([
                'success' => true,
                "equipment_make"=>$equipment_make,
                'message' => 'Equipment make added successfully',
            ], JsonResponse::HTTP_OK);

        } catch (Exception $e) {
            // something went wrong
            Log::error(json_encode($e->getMessage()));
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
     * @param  \App\EquipmentMake  $equipmentMake
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentMake $equipmentMake)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentMake  $equipmentMake
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentMake $equipmentMake)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentMake  $equipmentMake
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentMake $equipmentMake)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentMake  $equipmentMake
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentMake $equipmentMake)
    {
        //
    }
}
