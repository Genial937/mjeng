<?php

namespace App\Http\Controllers\Vendors;

use App\Business;
use App\Configuration;
use App\County;
use App\EquipmentRequired;
use App\EquipmentType;
use App\Http\Controllers\Controller;
use App\Project;
use App\Site;
use App\User;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index(Request $request)
    {
        $project_id = $request->route("project_id");
        //get project details
        $project = Project::find($project_id);
        //get all equipment required
        $equipments_required = EquipmentRequired::with([
            "equipmentType",
            "site",
            "task",
            "equipmentInventory"])
            ->join('sites', 'sites.id', 'equipment_requireds.site_id')
            ->select(
                'equipment_requireds.*'
            )
            ->where("sites.project_id", $project_id);
        //start filter
        if ($request->has("site_id")):
            $equipments_required = $equipments_required->where("sites.id", $request->site_id);
        endif;
        if ($request->has("equipments_type_id")):
            $equipments_required = $equipments_required->where("equipment_requireds.id", $request->equipments_type_id);
        endif;
        //end filter
        $equipments_required = $equipments_required->get();
        //get  sites for filtering
        $sites = Site::where("project_id", $project_id)->get();
        //equipment type  for filtering
        $equipments_types = EquipmentType::get();
        //user businesses for fetching inventory during adding equipment
        $user = User::with(["businesses", 'staffs'])
            ->where("id", Auth::id())
            ->first();
        $businesses = isset($user->businesses) ? $user->businesses : [];
        $no=1;
        return view('vendor.v1.project.add.equipments', compact("no","sites", "businesses", "equipments_types", "project", 'equipments_required', "project_id"));
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
            "site_id" => "required|exists:sites,id",
            "task_id" => "required|exists:tasks,id",
            "equipment_type_id" => "required|exists:equipment_types,id",
            "no_equipment" => "required|numeric|min:0",
            "payload_capacity" => "required|numeric|min:0",
            "payload_unit" => "required|string",
            "duration_unit" => "required|string",
            "duration" => "required|numeric|min:0",
            "currency" => "required|string",
            "lease_rates" => "required|numeric|min:0",
            "lease_modality" => "required|string",
            "fuel_provision" => "required|string",
            "cess_provision" => "required|string",
        ]);
        //store to db
        try {
            $equipment_required = EquipmentRequired::create($request->only([
                "site_id",
                "task_id",
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
                "equipment_required" => $equipment_required,
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            "id" => "required|exists:equipment_requireds,id",
            "site_id" => "required|exists:sites,id",
            "task_id" => "required|exists:tasks,id",
            "equipment_type_id" => "required|exists:equipment_types,id",
            "no_equipment" => "required|numeric|min:0",
            "payload_capacity" => "required|numeric|min:0",
            "payload_unit" => "required|string",
            "duration_unit" => "required|string",
            "duration" => "required|numeric|min:0",
            "currency" => "required|string",
            "lease_rates" => "required|numeric|min:0",
            "lease_modality" => "required|string",
            "fuel_provision" => "required|string",
            "cess_provision" => "required|string",
        ]);
        //store to db
        try {
            EquipmentRequired::where("id", $request->id)->update($request->only([
                "site_id",
                "task_id",
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
                'message' => 'Equipment required successfully updated.',
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

    public function assignEquipmentFromInventory(Request $request)
    {
        $this->validate($request, [
            "equipments.*" => "required|min:1",
            "equipment_required_id" => "required|exists:equipment_requireds,id"
        ]);
        try {
            $equipment_required = EquipmentRequired::find($request->equipment_required_id);
            $equipment_required->equipmentInventory()->attach($request->equipments);
            return response()->json([
                'success' => true,
                'message' => 'Equipment required successfully deleted.',
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
    public function removeEquipmentFromInventory(Request $request)
    {
        $this->validate($request, [
            "equipment_id" => "required|exists:equipment_inventories,id",
            "equipment_required_id" => "required|exists:equipment_requireds,id"
        ]);
        try {
            $equipment_required = EquipmentRequired::find($request->equipment_required_id);
            $equipment_required->equipmentInventory()->detach($request->equipment_id);
            return response()->json([
                'success' => true,
                'message' => 'Equipment required successfully removed.',
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
     * @param \App\Site $projectSite
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        try {
            $equipment_required = EquipmentRequired::find($request->route("id"));
            $equipment_required->delete();
            return response()->json([
                'success' => true,
                'message' => 'Equipment required successfully deleted.',
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
