<?php

namespace App\Http\Controllers\Vendors;

use App\Business;
use App\Helpers\UniqueRandomChar;
use App\Helpers\UploadFiles;
use App\Http\Controllers\Controller;
use App\Project;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BusinessController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function index()
    {
        //user businesses
        $user=User::with(["businesses",'staffs'])
            ->where("id",Auth::id())
            ->first();
        $businesses =isset($user->businesses) ?$user->businesses:[];
        $staffs=isset($user->staffs) ?$user->staffs:[];
        return view('vendor.v1.businesses.index',compact("businesses","staffs"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCreateView()
    {
        $businesses=Business::with("users")->get();
        return view('vendor.v1.businesses.create',compact("businesses"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showEditView(Request $request)
    {
        $businesses=Business::with("users")->get();
        $business=Business::find($request->route('id'));
        $documents=json_decode($business->documents);

        return view('vendor.v1.businesses.edit',compact("business",'businesses','documents'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function addUsers(Request $request)
    {
        $this->validate($request, [
            "users"=>"required|array",
            "users.*"=>"required|min:1",
            "business_id"=>"required",
        ]);
        try{
            //get user
            $business=Business::find($request->business_id);
            //attach businesses id
            $business->users()->attach($request->users);
            return response()->json([
            'success' => true,
            'message' => 'User(s) added successfully.'
        ], JsonResponse::HTTP_OK);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'errors' => ["exception" => [$e->getMessage()]],
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return JsonResponse
     */
    public function detachUser(Request $request)
    {
        $this->validate($request, [
            "user_id"=>"required|exists:users,id",
            "business_id"=>"required|exists:businesses,id",
        ]);
        try{
            //get user
            $business=Business::find($request->business_id);
            //attach businesses id
            $business->users()->detach($request->user_id);
            return response()->json([
                'success' => true,
                'message' => 'User(s) removed successfully.'
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
    public function store(Request $request)
    {
        $rules = [
            "user_id" => "required|exists:users,id",
            "name" => "required|unique:businesses",
            "phone" => "nullable",
            "country" => "nullable",
            "city" => "nullable",
            "address" => "nullable",
            "email" => "nullable",
            "doc_type" => "required|array|min:2",
            "doc_type.*"  => "required|string|min:1",
            "doc_no" => "required|array|min:2",
            "doc_no.*"  => "required|distinct|min:1",
            "doc_file" => "required|array|min:2",
            "doc_file.*"  => "required|file|distinct|min:1",
        ];
        $custom_msg= ['name.required' => 'Please enter business name','doc_file.*.distinct'=>"Attached file have same name or are the same."];
        $this->validate($request, $rules,$custom_msg);

        try {
            $business_code=UniqueRandomChar::businessCode();
            //upload files
            $documents=[];
            $i=0;
            foreach($request->file("doc_file") as $file):
                $result=UploadFiles::vendorBusinessFile($file,$request->doc_no[$i]);
                if($result->getStatusCode()!=200)
                    return response()->json([
                        'success' => false,
                        'errors' => $result->getData()->errors,
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

                array_push($documents,['doc_no'=>$request->doc_no[$i],'doc_type'=>$request->doc_type[$i],'doc_url'=>$result->getData()->path]);
                $i++;
            endforeach;
            $request->request->add(["business_code"=>$business_code,'documents'=>json_encode($documents)]);
            $business = Business::create($request->only([
                "business_code",
                "name",
                "email",
                "phone",
                "country",
                "city",
                "address",
                "status",
                "type",
                "documents",
                "description"
            ]));
            //attach business to user
            $business->users()->sync($request->user_id);
            return response()->json([
                'success' => true,
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            "id"=>"required|exists:businesses",
            "name" => "required|unique:businesses",
        ]);
        try {
             //check if doc update
            //upload files
            $documents=[];
            $i=0;
            foreach($request->file("doc_file") as $file):
                $result=UploadFiles::vendorBusinessFile($file,$request->doc_no[$i]);
                if($result->getStatusCode()!=200)
                    return response()->json([
                        'success' => false,
                        'errors' => $result->getData()->errors,
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

                array_push($documents,['doc_no'=>$request->doc_no[$i],'doc_type'=>$request->doc_type[$i],'doc_url'=>$result->getData()->path]);
                $i++;
            endforeach;
            $request->request->add(['documents'=>json_encode($documents)]);

        Business::where("id",$request->id)->update($request->only(
            "name",
            "email",
            "phone",
            "country",
            "city",
            "address",
            "documents",
            "status",
            "type",
            "description"
           ));
            return response()->json([
                'success' => true,
                'message' => 'Business updated successfully.'
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
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business)
    {
        //
    }
}
