<?php

namespace App\Http\Controllers\Vendors;
use App\EquipmentInventory;
use App\EquipmentType;
use App\Helpers\UniqueRandomChar;
use App\Http\Controllers\Controller;
use App\MaterialInventory;
use App\MaterialType;
use App\User;
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
    public function index()
    {
        $materials = MaterialInventory::with(["business","materialClass","materialType"])->get();
        return view('vendor.v1.inventory.material.index',compact("materials"));
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
        return view('vendor.v1.inventory.material.create',compact("materials","material_types","businesses"));
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
     * Display the specified resource.
     *
     * @param  \App\MaterialInventory  $materials
     * @return \Illuminate\Http\Response
     */
    public function show(MaterialInventory $materials)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MaterialInventory  $materials
     * @return \Illuminate\Http\Response
     */
    public function edit(MaterialInventory $materials)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MaterialInventory  $materials
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MaterialInventory $materials)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MaterialInventory  $materials
     * @return \Illuminate\Http\Response
     */
    public function destroy(MaterialInventory $materials)
    {
        //
    }
}
