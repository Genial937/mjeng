<?php


namespace App\Http\Controllers\Vendors;
use App\Business;
use App\County;
use App\EquipmentInventory;
use App\EquipmentModel;
use App\EquipmentType;
use App\Helpers\UniqueRandomChar;
use App\Helpers\UploadFiles;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
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
    public function index(Request  $request)
    {

        //filter by business/status/
        $user = User::with(["businesses", 'staffs'])
            ->where("id", Auth::id())
            ->first();
        $businesses = isset($user->businesses) ? $user->businesses : [];
        $default_business=$businesses[0];
        $business_id=$default_business->id;
        $equipments = EquipmentInventory::with(["business","equipmentType","equipmentModel"])
                ->where("business_id",$business_id);
        //check filters
        if($request->has("business_id")):
            $business_id=$request->business_id;
            $equipments =$equipments->where("business_id",$business_id);
        endif;
        if($request->has("status")):
            $status=$request->status;
            $equipments =$equipments->where("status",$status);
        endif;
        $equipments =$equipments->get();

        return view('vendor.v1.inventory.equipment.index',compact("equipments","businesses","default_business"));
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
        $equipments = EquipmentInventory::get();
        $equipment_types = EquipmentType::with("task")->get();
        return view('vendor.v1.inventory.equipment.create',compact("equipments","equipment_types","businesses"));
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
        $equipment = EquipmentInventory::with(["business","equipmentType","equipmentModel"])->where("id",$request->id)->first();
        $equipment_types = EquipmentType::with("task")->get();
        $equipment_models = EquipmentModel::get();
        return view('vendor.v1.inventory.equipment.edit',compact("equipment","equipment_types","businesses",'equipment_models'));
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
             "equipment_type_id"=>"required|exists:equipment_types,id",
             "ownership"=>"required",
             "equipment_model_id"=>"required|exists:equipment_models,id",
             "plate_no"=>"required|unique:equipment_inventories,plate_no",
             "engine_capacity"=>"required",
             "fuel_type"=>"required",
             "axel"=>"required",
//             "tw"=>"required",
//             "gw"=>"required",
//             "yom"=>"required",
             "equipment_front_image"=>"required",
             "equipment_back_image"=>"required",
             "equipment_right_image"=>"required",
             "equipment_left_image"=>"required",
         ]);
         try{
         //images
        $images=$request->only([
            "equipment_front_image",
            "equipment_back_image",
            "equipment_right_image",
            "equipment_left_image"
        ]);
        $request->request->add([
            "images"=>json_encode($images),
            "comment"=>"Equipment is pending approval from ".env("APP_NAME"),
            "reg_no"=>UniqueRandomChar::equipmentRegistrationID()
        ]);
        $equipment = EquipmentInventory::create($request->only([
            "reg_no",
            "business_id",
            "equipment_type_id",
            "equipment_model_id",
            "plate_no",
            "yom",
            "axel",
            "tw",
            "gw",
            "description",
            "ownership",
            "fuel_type",
            "engine_capacity",
            "images",
            "status",
            "comment",
        ]));
             return response()->json([
                 'success' => true,
                 'message' => 'Equipment added successfully.'
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
            "id"=>"required|exists:equipment_inventories,id",
        ]);
        try{
            //images
            $images=$request->only([
                "equipment_front_image",
                "equipment_back_image",
                "equipment_right_image",
                "equipment_left_image"
            ]);
            $request->request->add(["images"=>json_encode($images)]);
            EquipmentInventory::where("id",$request->id)->update($request->only([
                "business_id",
                "equipment_type_id",
                "equipment_model_id",
                "plate_no",
                "yom",
                "axel",
                "tw",
                "gw",
                "description",
                "ownership",
                "fuel_type",
                "engine_capacity",
                "images",
                "status",
                "comment",
            ]));
            return response()->json([
                'success' => true,
                'message' => 'Equipment updated successfully.'
            ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'errors' => ["exception" => [$e->getMessage()]],
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }
    public function storeImages(Request $request){
        $uploaded = $request->file('file'); //get file
        try {
            $result=UploadFiles::businessEquipmentImage($uploaded,$request->side);
            if ($result->getStatusCode() != 200)
                return response()->json([
                    'success' => false,
                    'errors' => $result->getData()->errors,
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

            return response()->json([
                'success' => true,
                'data'=>["path"=>$result->getData()->path,'side'=>$request->side],
                'message' => 'Business added successfully.'
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
            EquipmentInventory::where('id',$request->route("id"))->update(["status"=>4,'comment'=>"Business deleted by ".Auth::user()->email]);
            return response()->json([
                'success' => true,
                'message' => 'Equipment Inventory successfully deleted.',
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
