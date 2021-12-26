<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Http\Requests\CreateSubCategoryRequest;


class subCategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $limit = 25;

        // $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // $start = ($page - 1) * $limit;

        return view('subcategory.index')->with('subcategories', SubCategory::orderBy('id', 'desc')->paginate($limit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('subcategory.create')->with('categories', Category::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubCategoryRequest $request)
    {
        //
        // $request->validate(
        //     [
        //         'subcategoryname'=> 'required',
        //         'slug'=> 'required',
        //     ]
        // );
        //   $category->category_name = $request->category_name;
       // Subcategory::create($request->all());

        $subcategory = new Subcategory(); 
        $subcategory->name = $request->subcategoryname;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category_id;
        $subcategory->category_name = $request->category_name;
        $nameF = "SubCategory_" . time();
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

        return redirect()->route('sub-category.index');
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
    public function update(Request $request, $id)
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
       //  $subcategory->delete($subcategory->all());
         $category = Subcategory::find($id);
         
         $category->delete();

         @session()->flash('success', 'Successfully deleted the specified SubCategory.');
             
         return redirect()->route('sub-category.index');
    }
}
