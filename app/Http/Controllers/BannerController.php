<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBannerRequest;
use App\Illuminate\Http\Response;

class BannerController extends Controller
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
        return Banner::all();
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
    public function store(StoreBannerRequest $request)
    {
        //
        $banner = new Banner();
        
        $banner->name = $request->name;
        $banner->category = $request->category;
        $banner->company = $request->company;
           $inter = intval($request->user_id);
        $banner->user_id = $inter;
        $nameF = "Banner_" . time();
        if(isset($request->banner)) {
            $result = $request->banner->storeOnCloudinaryAs('banner', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
            
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $banner->banner = $name;
        }
        
        $banner->save();

        $response =[
            "data" => $banner,
            "statusCode" => 200,
            "message" => "Banner created successfully"
        ];

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }




    public function delete($id)
    {
        //
        $banner = Banner::find($id);
        $banner->delete();
        $response = [
            'message' => 'banner successfully Deleted',
            'success' => true,

        ];

        return $response;
    }
}
