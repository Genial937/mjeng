<?php

namespace App\Http\Controllers\Vendors;
use App\County;
use App\EquipmentInventory;
use App\EquipmentModel;
use App\EquipmentType;
use App\Helpers\UniqueRandomChar;
use App\Http\Controllers\Controller;
use App\MaterialInventory;
use App\MaterialType;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
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
        //filter by business/status/
        $user = User::with(["businesses", 'staffs'])
            ->where("id", Auth::id())
            ->first();
        $businesses = isset($user->businesses) ? $user->businesses : [];
        $default_business=$businesses[0];
        $business_id=$default_business->id;
        $materials = MaterialInventory::with(["business","materialClass","materialType","subCounty"])
            ->where("business_id",$business_id);
        //check filters
        if($request->has("business_id")):
            $business_id=$request->business_id;
            $materials=$materials->where("business_id",$business_id);
        endif;
        if($request->has("status")):
            $status=$request->status;
            $materials=$materials ->where("status",$status);
        endif;
        $materials=$materials->get();

        return view('vendor.v1.inventory.material.index',compact("materials","businesses","default_business"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCreateView()
    {
        $user = User::with(["businesses", 'staffs'])
            ->where("id", Auth::id())
            ->first();
        $businesses = isset($user->businesses) ? $user->businesses : [];
        $materials = MaterialInventory::get();
        $material_types = MaterialType::get();
        $counties=County::get();
        return view('vendor.v1.inventory.material.create',compact("materials","material_types","businesses","counties"));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showEditView(Request $request)
    {
        $user = User::with(["businesses", 'staffs'])
            ->where("id", Auth::id())
            ->first();
        $businesses = isset($user->businesses) ? $user->businesses : [];
        $material = MaterialInventory::with(["business","materialClass","materialType","subCounty"])
            ->where("id",$request->id)
            ->first();
        $material_types = MaterialType::get();
        $counties=County::get();
        return view('vendor.v1.inventory.material.edit',compact("material","material_types","businesses","counties"));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "business_id"=>"required|exists:businesses,id",
            "material_type_id"=>"required|exists:material_types,id",
            "ownership"=>"required",
            "material_class_id"=>"required|exists:material_classes,id",
        ]);
        try{

            $request->request->add([
                "comment"=>"Material is pending approval from ".env("APP_NAME"),
                "reg_no"=>UniqueRandomChar::materialRegistrationID()
            ]);
            $material = MaterialInventory::create($request->only([
                "reg_no",
                "business_id",
                "material_type_id",
                "material_class_id",
                "sub_county_id",
                "ownership",
                "description",
                "comment",
                "status"
            ]));
            return response()->json([
                'success' => true,
                'message' => 'Material added successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'errors' => ["exception" => [$e->getMessage()]],
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
        $this->validate($request,[
            "id"=>"required|exists:material_inventories,id",
        ]);
        try{

           MaterialInventory::where("id",$request->id)->update($request->only([
                "business_id",
                "material_type_id",
                "material_class_id",
                "sub_county_id",
                "ownership",
                "description",
                "status"
            ]));
            return response()->json([
                'success' => true,
                'message' => 'Material updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'errors' => ["exception" => [$e->getMessage()]],
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }
    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request)
    {
        try{
            MaterialInventory::where('id',$request->route("id"))->update(["status"=>4,'comment'=>"Business deleted by ".Auth::user()->email]);
            return response()->json([
                'success' => true,
                'message' => 'Material successfully removed from inventory.',
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
