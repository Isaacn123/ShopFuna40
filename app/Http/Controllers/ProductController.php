<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Illuminate\Http\Response;
use App\Exceptions\ProductNotBelongsToUser;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   
    public function __construct(){
       $this->middleware('auth:sanctum')->except('index','show');
     // $this->middleware('auth:api')->except('index','show');
//     // $this->middleware('auth', ['except' => ['index', 'show']]);

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         // return Product::with('reviews')->get();

        //  return ProductResource::collection(Product::all());

        //  return ProductCollection::collection(Product::all());
         $user = User::with('products')->find(Auth::user()->id);
         return $user;
        // return ProductCollection::collection(Product::orderBy('id', 'DESC')->paginate(15));
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
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        // 
        $product = new Product();
        $user_id = Auth::id();
      
      // $product = Product::create($request->all());
        $product ->name = $request->name;
        $product ->user_id = $user_id;
        $product ->description = $request->description;
        $product ->price = $request->price;
        $product ->discount = $request->discount;
        $product ->companyName = $request->companyName;
        $product ->category_id = $request->category_id;
        $product ->subCategory_id = $request->subCategory_id;
        $product ->stock = $request->stock;
        $product ->slug = $request-> slug;
        $nameF = "Product_" . time();
        if(isset($request->featured_image)){
            $result = $request->featured_image->storeOnCloudinaryAs('products', $nameF);
            $imagename = $result->getFileName();
            $extension = $result->getExtension();
    
            $name = $imagename . "." . $extension;
            $path = $result->getSecurePath();
            $product->featured_image = $name;
            // $imageID = $result->getPublicId();


        }

        $product->save();
        $response = response([
            "data" => new ProductResource($product), 
            "status" => 'ok',
            "success" => true,
            "message" => "product created successfully"
        ], 200);
        
        // return [
        //     "data" => $product
        // ];
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
        // $request['detail'] = $request->description;
        // unset($request['description']);


        $this->productCheckUser($product);
         $products = $product->update($request->all());
         $response = response([
             'message' => 'product successfully updated',
             'data' => $products,
             'success' => true,

         ], 200);

         return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //

      $this->productCheckUser($product);

       $products = $product->delete();
         $response = response([
             'message' => 'product successfully Deleted',
             'success' => true,

         ], response::HTTP_CREATED);

         return $response;
    }

    public function productCheckUser($product)
    {
        if(Auth::id() !==  $product->user_id){
    //    throw new Exception("Error Processing Request", 1);
         throw new ProductNotBelongsToUser;
        }

    }
}
