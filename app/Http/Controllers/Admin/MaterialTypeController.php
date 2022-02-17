<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
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

class MaterialTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $material_types = MaterialType::with("task")->get();
        $tasks = Task::all();
        return view('admin.v1.config.material-type.index', compact("material_types", 'tasks'));
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
            "name" => "required|unique:material_types",
            "task_id" => "required",
            "parent_id" => "nullable",
            "description" => "nullable",
        ]);
        try {
            $material_type=MaterialType::create($request->only(
                "name",
                "task_id",
                "parent_id",
                "description",
                "status"
            ));

            return response()->json([
                'success' => true,
                 "material_type"=>$material_type,
                'message' => 'Material type added successfully',
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
     * @param \App\MaterialType $materialType
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialType $materialType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\MaterialType $materialType
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialType $materialType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\MaterialType $materialType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialType $materialType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\MaterialType $materialType
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialType $materialType)
    {
        //
    }
}
