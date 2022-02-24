<?php

namespace App\Http\Controllers\Admin;

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
    public function index()
    {
        return view('admin.v1.project.index');
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createViewMaterialRequired()
    {
        return view('admin.v1.project.create.materials-required');
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
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
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
