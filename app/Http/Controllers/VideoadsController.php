<?php

namespace App\Http\Controllers;

use App\Models\Videoads;
use Illuminate\Http\Request;
use App\Http\Requests\StoreVideoadsRequest;
use Illuminate\Support\Facades\Auth;

class VideoadsController extends Controller
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
        return Videoads:: orderBy('id', 'desc')->paginate(20);
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
    public function store(StoreVideoadsRequest $request)
    {
        //
        $videoads = new Videoads();
        $videoads ->name = $request->name;
        $videoads ->username = $request->username;
        $videoads ->user_id = Auth::id();
        $videoads ->videoadd = $request->videoadd;
        $videoads ->supply = $request->supply;
        // echo ini_get("memory_limit")."\n";
        // // ini_set("memory_limit","30M");
        // echo ini_get("memory_limit")."\n";
        
        // echo ini_get("post_max_size")."\n";
        // ini_set("post_max_size","20M");
        // echo ini_get("post_max_size")."\n";
        
        // echo ini_get("upload_max_filesize")."\n";
        // ini_set("upload_max_filesize","19M");
        // echo ini_get("upload_max_filesize")."\n";


        $videoads->save();

        return [
            "data" => $videoads,
            "success" => true,
            "message" => "Video Successfully created"
        ];



    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Videoads  $videoads
     * @return \Illuminate\Http\Response
     */
    public function show(Videoads $videoads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Videoads  $videoads
     * @return \Illuminate\Http\Response
     */
    public function edit(Videoads $videoads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Videoads  $videoads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $video = Videoads::find($id);
        $video ->name = $request->name;
        $video ->username = $request->username;
        $video ->user_id = intval($request->user_id);
        $video ->videoadd = $request->videoadd;
        $video ->supply = $request->supply;

        $video->save();

        return [
            "data" => $video,
            "success" => true,
            "message" => "Video Successfully Updated"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Videoads  $videoads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Videoads $videoads)
    {
        //
    }



    public function delete($id)
    {
        //
        $cvs = Videoads::find($id);
        $cvs->delete();
        $response = [
            'message' => 'Video successfully Deleted',
            'success' => true,

        ];

        return $response;
    }
}
