<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\County;
use App\Http\Controllers\Controller;
use App\Project;
use App\Site;
use App\Task;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SiteController extends Controller
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
        $tasks=Task::all();
        $sites=Site::with("tasks")->where("project_id",$project_id)->get();
        return view('admin.v1.project.create.sites',compact("tasks","sites","project_id"));
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\EquipmentType  $equipmentType
     * @return JsonResponse
     */
    public function find(Request $request)
    {
        try{
            return response()->json([
                'success' => true,
                "site"=>Site::with("tasks")->find($request->route("id")),
                'message' => 'Success',
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
    public function store(Request $request)
    {
        $this->validate($request, [
            "project_id"=>"required",
            "name"=>"required",
            "description"=>"required",
            "tasks" => "required|array|min:1",
            "tasks.*"  => "required|string|distinct|min:1",
        ]);

        try{
            $site=Site::create($request->only(
                "project_id",
                "name",
                "description",
                "status"
            ));
            //attach tasks
            $site->tasks()->sync($request->tasks);
            return response()->json([
                'success' => true,
                "site" =>$site,
                'message' => 'Project site successfully saved.',
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
            "site_id"=>"required|exists:sites,id",
        ]);

        try{
            Site::where("id",$request->site_id)->update($request->only(
                "name",
                "description",
                "status"
            ));
            //attach tasks
            $site=Site::find($request->site_id);
            $site->tasks()->sync($request->tasks);
            return response()->json([
                'success' => true,
                'message' => 'Project site successfully updated.',
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
         $site=Site::find($request->route("id"));
         $site->delete();
            return response()->json([
                'success' => true,
                'message' => 'Project site successfully deleted.',
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
