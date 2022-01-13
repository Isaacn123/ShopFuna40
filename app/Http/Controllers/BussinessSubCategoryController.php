<?php

namespace App\Http\Controllers;

use App\Models\BussinessSubCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\BusinessCategory;
use App\Http\Requests\StoreBussinessSubCategoryRequest;

class BussinessSubCategoryController extends Controller
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

        return view('business_subcategory.index')->with('business_subcategories', SubCategory::orderBy('id', 'desc')->paginate($limit));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('business_subcategory.create')->with('businesscategories', BusinessCategory::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBussinessSubCategoryRequest $request)
    {
        //

        $subcategory = new BusinessSubcategory(); 
        $subcategory->subcategoryname = $request->subcategoryname;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category_id;
        $subcategory->category_name = $request->category_name;
        $nameF = "BSubCategory_" . time();
        if(isset($request->image)){
            $result = $request->image->storeOnCloudinaryAs('subcategory', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
            
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $subcategory->featured_image = $name;
    }
         $subcategory->save();
        @session()->flash('success', 'SubCategory Successfully stored.');

        return redirect()->route('business_sub-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BussinessSubCategory  $bussinessSubCategory
     * @return \Illuminate\Http\Response
     */
    public function show(BussinessSubCategory $bussinessSubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BussinessSubCategory  $bussinessSubCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(BussinessSubCategory $bussinessSubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BussinessSubCategory  $bussinessSubCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BussinessSubCategory $bussinessSubCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BussinessSubCategory  $bussinessSubCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $category = BusinessSubcategory::find($id);
         
        $category->delete();

        @session()->flash('success', 'Successfully deleted the specified SubCategory.');
            
        return redirect()->route('business_sub-category.index');
    }
}
