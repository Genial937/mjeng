<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
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

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $equipment_types = EquipmentType::with("task")->get();
        $tasks = Task::all();
        return view('admin.v1.config.equipment-type.index', compact("equipment_types", 'tasks'));
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
            "name" => "required|unique:equipment_type",
            "task_id" => "required",
            "parent_id" => "nullable",
            "description" => "nullable",
        ]);
        try {
            $equipment_type=EquipmentType::create($request->only(
                "name",
                "parent_id",
                "task_id",
                "description",
                "status"
            ));

            return response()->json([
                'success' => true,
                "equipment_type"=>$equipment_type,
                'message' => 'Equipment type added successfully',
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
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function show(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function edit(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EquipmentType $equipmentType)
    {
        //
    }
}
