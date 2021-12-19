<?php

namespace App\Http\Controllers;

use App\Models\Pro;
use Illuminate\Http\Request;

class ProController extends Controller
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
        return "ALL DATA HERE";
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
    public function store(Request $request)
    {
        //
       return "My PRODUCT HERE";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function show(Pro $pro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function edit(Pro $pro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pro $pro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pro  $pro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pro $pro)
    {
        //
    }
}
