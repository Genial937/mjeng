<?php

namespace App\Http\Controllers\Admin;

use App\Business;
use App\Http\Controllers\Controller;
use App\Project;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignUser(Request $request)
    {
        $this->validate($request, [
            "businesses"=>"",
        ]);
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
            $business_code=$this->generateCode();
            $request->request->add(["business_code"=>$business_code]);
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
                "description"
            ]));
            //attach business to merchant
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
    protected function generateCode()
    {
        try {
            for ($i = 100001; $i <= 999999; $i++):
                $code = "BC".sprintf("%06s", $i);
                $business = Business::where('business_code', $code)->first();
                if (empty($business)):
                    break 1;
                endif;
            endfor;
            return $code;
        } catch (QueryException $e) {
            return $e->getMessage();
        }

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business)
    {
        //
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
