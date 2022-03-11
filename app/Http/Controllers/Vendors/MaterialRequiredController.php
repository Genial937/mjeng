<?php

namespace App\Http\Controllers\Vendors;

use App\Configuration;
use App\EquipmentRequired;
use App\Http\Controllers\Controller;
use App\MaterialsRequired;
use App\MaterialType;
use App\Project;
use App\Site;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        //get project details
        $project = Project::find($project_id);
        //sites
        $sites=Site::where("project_id",$project_id)->get();
        //material type
        $material_types=MaterialType::get();
        //build query
        $materials_required=MaterialsRequired::with(["materialType","site","task",'classification'])
            ->join('sites', 'sites.id', 'materials_requireds.site_id')
            ->where("sites.project_id",$project_id);
        //start filter
        if ($request->has("site_id")):
            $materials_required = $materials_required->where("sites.id", $request->site_id);
        endif;
        if ($request->has("material_type_id")):
            $materials_required = $materials_required->where("materials_requireds.id", $request->material_type_id);
        endif;
        $materials_required=$materials_required->get();
        //user businesses for fetching inventory during adding equipment
        $user = User::with(["businesses", 'staffs'])
            ->where("id", Auth::id())
            ->first();
        $businesses = isset($user->businesses) ? $user->businesses : [];
        $no=1;
        return view('vendor.v1.project.add.materials',compact("project","businesses","no","sites","material_types",'materials_required'));
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
        //udpate to db
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
