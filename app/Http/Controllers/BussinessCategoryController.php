<?php

namespace App\Http\Controllers;

use App\Models\BussinessCategory;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateBussinessCategoryRequest;
use App\Http\Requests\StoreBussinessCategoryRequest;

class BussinessCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $limit = 25;

        return view('businesscategories.index')->with('businesscategory', BussinessCategory::orderBy('id', 'desc')->paginate($limit));
  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('businesscategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBussinessCategoryRequest $request)
    {
        //
        @session()->flash('success', 'Success! You have successfully created your Category.');

        $category = new BussinessCategory(); 
        $category->name = $request->name;
        $category->slug = $request->slug;
        $nameF = "BCategory_" . time();

    if(isset($request->image)){
            $result = $request->image->storeOnCloudinaryAs('category', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
            
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $category->featured_image = $name;
    }
       
        $category->save();
  return  redirect()->route('businesscategory.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BussinessCategory  $bussinessCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BussinessCategory $bussinessCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BussinessCategory  $bussinessCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BussinessCategory $bussinessCategory)
    {
        //

        return view('businesscategories.create')->with('businesscategory', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BussinessCategory  $bussinessCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBussinessCategoryRequest  $request, BussinessCategory $bussinessCategory)
    {
        //

        session()->flash('success', 'Category has been Updated successfully!');

        $category->update($request->all());

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BussinessCategory  $bussinessCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(BussinessCategory $bussinessCategory)
    {
        //
    }
}