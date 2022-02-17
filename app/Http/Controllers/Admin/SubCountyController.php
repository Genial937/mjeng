<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\County;
use App\Http\Controllers\Controller;
use App\Project;
use App\SubCounty;
use App\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubCountyController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $counties=County::all();
        $subcounties=SubCounty::all();
        return view('admin.v1.config.subcounties.index',compact("counties",'subcounties'));
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
            "county_id" => "required|exists:counties,id",
            "subcounties" => "required|array|min:1",
            "subcounties.*"  => "required|string|distinct|min:1",
        ]);
        try {
           foreach($request->subcounties as $subcounty):
               SubCounty::create([
                   "name"=>$subcounty,
                   "county_id"=>$request->county_id,
               ]);
           endforeach;
            return response()->json([
                'success' => true,
                'message' => 'SubCounties create successfully',
            ], JsonResponse::HTTP_OK);

        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => [
                    "users"=>[
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
            "name"=>"required",
            "id"=>"required|exists:counties"
        ]);
        try {
           County::where("id",$request->id)->update($request->only('name'));
            return response()->json([
                'success' => true,
                'message' => 'County updated successfully',
            ], JsonResponse::HTTP_OK);

        } catch (Exception $e) {
            // something went wrong
            return response()->json([
                'success' => false,
                'errors' => [
                    "users"=>[
                        $e->getMessage()
                    ]]
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }


    }
}
