<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusinessProductRequest;
use App\Http\Requests\UpdateBusinessProductRequest;
use App\Models\BusinessProduct;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Illuminate\Http\Response;

class BusinessProductController extends Controller
{


    public function __construct(){
          $this->middleware('auth:api')->except('index','show');
        }


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
     * @param  \App\Http\Requests\StoreBusinessProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBusinessProductRequest $request)
    {
        //

        $product = new BusinessProduct();
        $user_id = Auth::id();

        $product ->name = $request->name;
        $product ->user_id = $user_id;
        $product ->description = $request->description;
        $product ->price = $request->price;
        $product ->discount = $request->discount;
        $product ->category_id = $request->category_id;
        $product ->subCategory_id = $request->subCategory_id;
        $product ->stock = $request->stock;
        $product->save();
        $response = response([
            "data" => new ProductResource($product), 
            "status" => 'ok',
            "success" => true,
            "message" => "product created successfully"
        ], 200);

        return [
            "data" => $product
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BusinessProduct  $businessProduct
     * @return \Illuminate\Http\Response
     */
    public function show(BusinessProduct $businessProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BusinessProduct  $businessProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(BusinessProduct $businessProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBusinessProductRequest  $request
     * @param  \App\Models\BusinessProduct  $businessProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBusinessProductRequest $request, BusinessProduct $businessProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BusinessProduct  $businessProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(BusinessProduct $businessProduct)
    {
        //
    }
}
