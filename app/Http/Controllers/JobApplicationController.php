<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreJobApplication;
use App\Models\JobApplication;

class JobApplicationController extends Controller
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
    public function store(StoreJobApplication $request)
    {
        //

        $jobapplication = new JobApplication();

        $jobapplication ->firstName = $request->firstName;
        $jobapplication ->lastName = $request->lastName;
        $jobapplication ->email = $request->email;
        $jobapplication ->phoneNumber = $request->phoneNumber;
        $jobapplication ->address = $request->address;
        $jobapplication ->city = $request->city;
        $jobapplication ->country = $request->country;
        $jobapplication ->zipCode = $request->zipCode;
        $jobapplication ->reference = $request->reference;
        $jobapplication ->description = $request->description;
        $jobapplication ->dateOfBirth = $request->dateOfBirth;
        $jobapplication ->jobPositon = $request->jobPositon;
        $jobapplication ->jobTitle = $request->jobTitle;
        $jobapplication ->company_name = $request->company_name; 
        $jobapplication ->job_id = $request->job_id;

         
        $nameF = "ApplicationResum_" . $request->firstName . "_" . $request->lastName .time();
        if(isset($request->resume)){
            $result = $request->resume->storeOnCloudinaryAs('jobApplications', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
    
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $jobapplication->resume = $name;
            // $imageID = $result->getPublicId();


        }

        $jobapplication->save();
        $response = response([
            "data" => $jobapplication, 
            "status" => 'ok',
            "success" => true,
            "message" => "Job created successfully"
        ], 200);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreJobApplication $request, $id)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
