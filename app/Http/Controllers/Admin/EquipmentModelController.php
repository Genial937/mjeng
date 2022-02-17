<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
use App\EquipmentMake;
use App\EquipmentModel;
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

class EquipmentModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $equipment_types = EquipmentType::with("task")->get();
        $equipment_makes = EquipmentMake::with("equipmentTypes")->get();
        $equipment_models = EquipmentModel::with("equipmentMake")->get();
        return view('admin.v1.config.equipment-model.index', compact("equipment_types", 'equipment_makes','equipment_models'));
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
            "name" => "required|unique:equipment_models",
            "equipment_make_id" => "required|exists:equipment_makes,id",
            "description" => "nullable",
        ]);
        try {
            $equipment_models=EquipmentModel::create($request->only(
                "equipment_make_id",
                "name",
                "description",
                "status"
            ));
            return response()->json([
                'success' => true,
                "equipment_models"=>$equipment_models,
                'message' => 'Equipment model added successfully',
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
     * @param  \App\EquipmentModel  $equipmentModel
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentModel $equipmentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentModel  $equipmentModel
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentModel $equipmentModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentModel  $equipmentModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentModel $equipmentModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentModel  $equipmentModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentModel $equipmentModel)
    {
        //
    }
}
