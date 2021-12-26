<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CreateCategoryFRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }



    // public function indexcategory()
    // {
    //     //
    //     $limit = 25;
    //     return Category::all();
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // if(request()->json()){
           
        // }

        //
        $limit = 25;

        return view('categories.index')->with('categories', Category::orderBy('id', 'desc')->paginate($limit));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('categories.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryFRequest $request)
    {
        //
        // $request->validate([
        //     'name' => 'required|unique:categories',
        //     // 'slug' => 'required',
        // ]);

        @session()->flash('success', 'Success! You have successfully created your Category.');

        // Category::create(
        //     [
        //         'name' => $request->name,
        //         'slug' => $request->slug,
        // ], 201);

        $category = new Category(); 
        $category->name = $request->name;
        $category->slug = $request->slug;
        $nameF = "Category_" . time();

        // $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
        // dd($response);

    //     if($request->hasFile('file')){

    // // $response = cloudinary()->upload($request->file('image')->getRealPath())->getSecurePath();
    // // dd($response);

    //         $result = $request->file('image')->storeOnCloudinaryAs('category', $nameF);
    //         $imagename = $result->getFileName();
    //         $extension = $result->getExtension();
            
    //         $name = $imagename . "." . $extension;
    //         $path = $result->getSecurePath();
    //         dd($path);
    //         $imageID = $result->getPublicId(); 
    //         $category->featured_image = $name;
    //     }

    if(isset($request->image)){
            $result = $request->image->storeOnCloudinaryAs('category', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
            
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $category->featured_image = $name;
    }
       
        $category->save();

   //  return view('categories.index');
  return  redirect()->route('category.index');
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
    public function edit(Category $category)
    {
        //
       return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
        // $request->validate([
        //     'name' => 'required|unique:categories',
        //     // 'slug' => 'required',
        // ]);

        session()->flash('success', 'Category has been Updated successfully!');

        $category->update($request->all());

        return redirect()->route('category.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
      $category->delete($category->all());

      @session()->flash('success', 'Category has been Deleted successfully!');

      return redirect()->route('category.index');
    }
}
