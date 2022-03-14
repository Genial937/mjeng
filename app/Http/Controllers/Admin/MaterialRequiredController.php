<?php

namespace App\Http\Controllers\Admin;

use App\Configuration;
use App\EquipmentRequired;
use App\Http\Controllers\Controller;
use App\MaterialsRequired;
use App\Site;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MaterialRequiredController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $project_id=$request->route("project_id");
        //sites
        $sites=Site::where("project_id",$project_id)->get();
        //measurement units
        $units=Configuration::where("column","units")->first();
        $measurement_units=empty($units) ?[]:json_decode($units->data);
        //currencies
        $currencies=Configuration::where("column","currency")->first();
        $currencies=empty($currencies) ?[]:json_decode($currencies->data);
        //material required
        $materials_required=MaterialsRequired::with(["materialType","site","task",'classification'])
            ->join('sites', 'sites.id', 'materials_requireds.site_id')
            ->where("sites.project_id",$project_id)
            ->get();
        return view('admin.v1.project.create.materials-required',compact("sites","measurement_units","currencies",'materials_required'));
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
            "task_id"=>"required|exists:tasks,id",
            "material_type_id"=>"required|exists:material_types,id",
            "material_class_id"=>"required|exists:material_classes,id",
            "quantity_required"=>"required|numeric|min:0",
            "quantity_required_unit"=>"required|string",
            "quantity_required_per_day"=>"required|numeric|min:0",
            "quantity_required_per_day_unit"=>"required|string",
            "currency"=>"required|string",
            "lease_rates"=>"required|numeric|min:0",
            "lease_modality"=>"required|string",
            "payment_term_desc"=>"required|string",
            "cess"=>"required|string",
        ]);
        //store to db
        try{
            $material_required=MaterialsRequired::create($request->only([
                "site_id",
                "task_id",
                "material_type_id",
                "material_class_id",
                "quantity_required",
                "quantity_required_unit",
                "quantity_required_per_day",
                "quantity_required_per_day_unit",
                "currency",
                "lease_rates",
                "lease_modality",
                "payment_term_desc",
                "cess"
            ]));
            return response()->json([
                'success' => true,
                "material_required" =>$material_required,
                'message' => 'Material required successfully saved.',
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
            "id"=>"required|exists:materials_requireds,id",
            "site_id"=>"required|exists:sites,id",
            "task_id"=>"required|exists:tasks,id",
            "material_type_id"=>"required|exists:material_types,id",
            "material_class_id"=>"required|exists:material_classes,id",
            "quantity_required"=>"required|numeric|min:0",
            "quantity_required_unit"=>"required|string",
            "quantity_required_per_day"=>"required|numeric|min:0",
            "quantity_required_per_day_unit"=>"required|string",
            "currency"=>"required|string",
            "lease_rates"=>"required|numeric|min:0",
            "lease_modality"=>"required|string",
            "payment_term_desc"=>"required|string",
            "cess"=>"required|string",
        ]);
        //update to db
        try{
            MaterialsRequired::where("id",$request->id)->update($request->only([
                "site_id",
                "task_id",
                "material_type_id",
                "material_class_id",
                "quantity_required",
                "quantity_required_unit",
                "quantity_required_per_day",
                "quantity_required_per_day_unit",
                "currency",
                "lease_rates",
                "lease_modality",
                "payment_term_desc",
                "cess"
            ]));
            return response()->json([
                'success' => true,
                'message' => 'Material required successfully update.',
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Site  $projectSite
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        try{
            $material_required=MaterialsRequired::find($request->route("id"));
            $material_required->delete();
            return response()->json([
                'success' => true,
                'message' => 'Material Required successfully deleted.',
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
