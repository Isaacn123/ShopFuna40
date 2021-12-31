<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Requests\StoreJopRequest;

class JobController extends Controller
{

    public function __construct(){
        $this->middleware('auth:sanctum')->except('index','show');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Job::orderBy('id', 'DESC')->paginate(15);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJopRequest $request)
    {
        //

        $jobinfo = new Job();
        $jobinfo ->title = $request->title;
        $jobinfo ->salary = $request->salary;
        $jobinfo ->user_id = Auth::user()->id;
        $jobinfo ->description = $request->description;
        $jobinfo ->company = $request->company;
        $jobinfo ->companyWebsite = $request-> companyWebsite;
        $jobinfo ->slug = $request-> slug;
        $jobinfo ->andress = $request-> andress;
        $jobinfo ->email = $request-> email;
        $jobinfo ->phone = $request->phone;
        $jobinfo ->zipcode = $request-> zipcode;
        $jobinfo ->country = $request->country;
        $jobinfo ->city = $request->city;
        $jobinfo ->jobPositions = $request->jobPositions;
        $jobinfo ->jobType = $request->jobType;
        $jobinfo ->companyAbbreviation = $request->companyAbbreviation;
        $jobinfo ->position_1 = $request->position_1;
        $jobinfo ->position_2 = $request->position_2;
        $jobinfo ->position_3 = $request->position_3;
        $nameF = "CompanyLogo_" . time();
        if(isset($request->companyLogo)){
            $result = $request->companyLogo->storeOnCloudinaryAs('company', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
    
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $jobinfo->companyLogo = $name;
            // $imageID = $result->getPublicId();


        }

        $jobinfo->save();
        $response = response([
            "data" => $jobinfo, 
            "status" => 'ok',
            "success" => true,
            "message" => "Job created successfully"
        ], 200);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy(Job $job)
    {
        //
    }
}
