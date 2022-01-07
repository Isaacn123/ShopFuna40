<?php

namespace App\Http\Controllers;


use App\Models\Cv;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCvRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateCvRequest;

class CvController extends Controller
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

        return Cv::orderBy('id', 'DESC')->paginate(15);
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
    public function store(StoreCvRequest $request)
    {
        //

        $cvapplication =new Cv();
        $cvapplication ->firstName = $request->firstName;
        $cvapplication ->lastName = $request->lastName;
        $cvapplication ->phone = $request->phone;
        $cvapplication ->email = $request->email;
        // $cvapplication ->address = $request->address;
        $cvapplication ->user_id = Auth::user()->id;
        $cvapplication ->profession = $request->profession;
        $cvapplication ->about = $request->about;
        $cvapplication ->slug = $request-> slug;
        $cvapplication ->location = $request->location;
        $cvapplication ->zipcode = $request-> zipcode;

        $nameF = "Cv_" . $request->firstName . time();
        if(isset($request->pdf_file)){
            $result = $request->pdf_file->storeOnCloudinaryAs('cv_application', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
    
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $cvapplication->pdf_file = $name;
            // $imageID = $result->getPublicId();


        }

        $cvapplication->save();
        $response = response([
            "data" => $cvapplication, 
            "status" => 'ok',
            "success" => true,
            "message" => "Cv Application created successfully"
        ], 200);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function show(Cv $cv)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function edit(Cv $cv)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCvRequest $request, $id)
    {
        //

        // $cvs = Cv::find($id);

        // if($cvs){

            // $page->image = 'imagepath';

        // $nameF = "Cv_" . $cvs->firstName . time();
        // if(isset($cvs->pdf_file)){
        //     $result = $request->pdf_file->storeOnCloudinaryAs('cv_application', $nameF);
        //     $imagename = $result->getFileName();
        //     $extension = $result->getExtension();
        //     $name = $imagename . "." . $extension;
        //     $path = $result->getSecurePath();
        //     $cvs->pdf_file = $name;
            // $imageID = $result->getPublicId();


        // }
           
        // }

        return $id;
       
        // $cvs = $request->all();
        // $cvs->save();

        // return [
        //     "data" => $cvs,
        //     "success" => 'cvs successfully Updated',
        //     "status" => 200
        // ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cv $cv)
    {
        //

        $cvs = $cv->delete();
        $response = response([
            'message' => 'product successfully Deleted',
            'success' => true,

        ], response::HTTP_CREATED);
    }


    public function delete($id)
    {
        //
        $cvs = Cv::find($id);
        $cvs->delete();
        $response = [
            'message' => 'product successfully Deleted',
            'success' => true,

        ];

        return $response;
    }
}
