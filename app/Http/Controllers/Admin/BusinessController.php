<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\County;
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
        $businesses=Business::with("users")->orWhereNull("documents")->get();
        $users=User::where("user_type","CONTRACTOR")->get();
        $contractors_businesses=$businesses;
        $vendors_businesses=Business::with("users")->whereNotNull("documents")->get();
        return view('admin.v1.businesses.contractor.index',compact("businesses",'users','contractors_businesses','vendors_businesses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showVendorsBusinesses()
    {
        $businesses=Business::with("users")->whereNotNull("documents")->get();
        $users=User::where("user_type","BUSINESS")->get();
        $contractors_businesses=Business::with("users")->get();
        $vendors_businesses=$businesses;
        return view('admin.v1.businesses.vendor.index',compact("businesses",'users','contractors_businesses','vendors_businesses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showEditVendorsBusinessView(Request $request)
    {
        //user businesses
        $business = Business::find($request->route('id'));
        $documents = json_decode($business->documents);
        $contractors_businesses=Business::with("users")->get();
        $vendors_businesses=Business::with("users")->whereNotNull("documents")->get();
        return view('admin.v1.businesses.vendor.edit', compact("business", 'documents','contractors_businesses','vendors_businesses'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showCreateContractorView()
    {
        $businesses=Business::with("users")->get();
        return view('admin.v1.businesses.contractor.create',compact("businesses"));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function showEditContractorBusinessView(Request $request)
    {
        $contractors_businesses=Business::with("users")->get();
        $vendors_businesses=Business::with("users")->whereNotNull("documents")->get();
        $business=Business::find($request->route('id'));
        return view('admin.v1.businesses.contractor.edit',compact("business",'contractors_businesses','vendors_businesses'));
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
//            "user_id" => "required|exists:users,id",
            "name" => "required",
            "phone" => "nullable",
            "country" => "nullable",
            "city" => "nullable",
            "address" => "nullable",
            "email" => "nullable",
        ];
        $custom_msg= ['name.required' => 'Please enter business/organisation name'];
        $this->validate($request, $rules,$custom_msg);

        try {
            $business_code=UniqueRandomChar::businessCode();
            $request->request->add(["business_code"=>$business_code,"comments"=>"Approved successfully by ".Auth::user()->email]);
            $business = Business::updateOrCreate(["name"=>$request->name,"phone"=>$request->phone],$request->only([
                "business_code",
                "name",
                "email",
                "phone",
                "country",
                "city",
                "address",
                "status",
                "type",
                "description",
                "comments"
            ]));
            //attach business to merchant
            //$business->users()->sync($request->user_id);
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
            "name"=>"required"
        ]);
        try {
        Business::where("id",$request->id)->update($request->only(
            "name",
            "email",
            "phone",
            "country",
            "city",
            "address",
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Business $business
     * @return JsonResponse
     */
    public function updateVendorBusiness(Request $request)
    {
        $this->validate($request, [
            "id" => "required|exists:businesses",
            "name" => "required",
        ]);
        try {

            //upload files
            $business = Business::find($request->id);
            $documents = json_decode($business->documents);
            $i = 0;
            //check if doc file is available
            if ($request->hasFile("doc_file")):
                foreach ($request->file("doc_file") as $file):
                    if (isset($file)):
                        $result = UploadFiles::vendorBusinessFile($file, $request->doc_no[$i]);
                        if ($result->getStatusCode() != 200)
                            return response()->json([
                                'success' => false,
                                'errors' => $result->getData()->errors,
                            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
                        if(isset($documents[$i])):
                            $documents[$i]->doc_url = $result->getData()->path;
                            $documents[$i]->doc_no = $request->doc_no[$i];
                            $documents[$i]->doc_type = $request->doc_type[$i];
                        else:
                            array_push($documents, ['doc_no' => $request->doc_no[$i], 'doc_type' => $request->doc_type[$i], 'doc_url' => $result->getData()->path]);
                        endif;
                    endif;
                    $i++;
                endforeach;
            endif;
            //update doc no and type
            if (isset($request->doc_type)):
                foreach ($request->doc_type as $type):
                    if(isset($documents[$i])):
                        $documents[$i]->doc_no = $request->doc_no[$i];
                        $documents[$i]->doc_type = $request->doc_type[$i];
                    endif;
                    $i++;
                endforeach;
            endif;
            $request->request->add(['documents' => json_encode($documents)]);

            Business::where("id", $request->id)->update($request->only(
                "name",
                "email",
                "phone",
                "country",
                "city",
                "address",
                "documents",
                "status",
                "comments",
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
                "business"=>Business::with(["equipments","materials"])->find($request->route("id")),
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
