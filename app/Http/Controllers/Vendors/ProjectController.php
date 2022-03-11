<?php

namespace App\Http\Controllers\Vendors;

use App\Business;
use App\County;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProjectController extends Controller
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

        $businesses=Business::get();
        $counties=County::all();
        //view open projects
        $projects = Project::with(["business","subCounty"])->where('status',1);
        //filters
        $projects=$projects->get();
        return view('vendor.v1.project.index',compact("projects","businesses","counties"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function createDetailView()
    {
        $businesses=Business::get();
        $counties=County::all();
        return view('admin.v1.project.create.details',compact("businesses","counties"));
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
            "name"=>"required|unique:projects",
            "description"=>"required",
            "business_id"=>"required|exists:businesses,id",
            "start_date"=>"required",
            "end_date"=>"required",
            "sub_county_id"=>"required",
        ]);

        try{

            $project=Project::create($request->only(
                "name",
                "description",
                "business_id",
                "start_date",
                "end_date",
                "sub_county_id",
                "status"
            ));
            return response()->json([
                'success' => true,
                "project" =>$project,
                "next_step"=>route("admin.form.create.project.sites",$project->id),
                'message' => 'Project successfully saved.',
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
            "id"=>"required",
            "name"=>"required",
            "description"=>"required",
            "business_id"=>"required|exists:businesses,id",
            "start_date"=>"required",
            "end_date"=>"required",
            "sub_county_id"=>"required",
        ]);

        try{

               Project::where("id",$request->id)->update($request->only(
                "name",
                "description",
                "business_id",
                "start_date",
                "end_date",
                "sub_county_id",
                "status"
            ));
            return response()->json([
                'success' => true,
                'message' => 'Project successfully updated.',
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
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
}
