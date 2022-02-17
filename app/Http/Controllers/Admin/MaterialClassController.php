<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Configuration;
use App\County;
use App\Http\Controllers\Controller;
use App\MaterialClass;
use App\MaterialType;
use App\Project;
use App\SubCounty;
use App\Task;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $material_types = MaterialType::with("task")->get();
        $material_classes = MaterialClass::with("materialType")->get();
        return view('admin.v1.config.material-class.index', compact("material_types", 'material_classes'));
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
            "name" => "required|unique:material_classes",
            "parent_id" => "nullable",
            "description" => "nullable",
        ]);
        try {
            $material_class=MaterialClass::create($request->only(
                "material_type_id",
                "name",
                "description",
                "status"
            ));

            return response()->json([
                'success' => true,
                "material_class"=>$material_class,
                'message' => 'Material classification has been added successfully',
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
     * @param  \App\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialClass $materialClass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialClass $materialClass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialClass $materialClass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialClass  $materialClass
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialClass $materialClass)
    {
        //
    }
}
