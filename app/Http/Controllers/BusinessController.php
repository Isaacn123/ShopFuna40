<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //->with('businesses', Business::all())->get()
    //     return Business::all();
    // }




       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //->with('businesses', Business::all())->get()
        $featuredvalue = 1;
        $business = Business::orderBy('id', 'DESC')->paginate(15);

        // $user = User::with('User')->find(Auth::user()->id);
        
        return $business->filter(function ($value, $key){
            return data_get($value, 'featured_business') === 1;
        });
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function business($category)
    {
        //
        return Business::where('categoryName', $category)->get();
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
      
        $request->validate([
                "name" => 'required|max:255|unique:business',
                "description"  => 'bail|required',
                "andress" => 'bail|required',
        ]);

        //
        // if(isset($request->image)){
        
        // $img = $request->image;
        // $name = "Business_" . time() . '.' .$img->extension();
        // $file = public_path('/images/business/');
        // $success = $img->move($file, $name);
        
        // $request->image = $name;
        // }

          $businessInfo = new Business();

          $businessInfo ->name = $request->name;
          $businessInfo ->user_id = Auth::user()->id;
          $businessInfo ->description = $request->description;
          $businessInfo ->website = $request-> website;
          $businessInfo ->slug = $request-> slug;
          $businessInfo ->andress = $request-> andress;
          $businessInfo ->email = $request-> email;
          $businessInfo ->contact = $request->contact;
          $businessInfo ->code = $request->code;
          $businessInfo ->zipcode = $request-> zipcode;
          $businessInfo ->categoryName = $request->categoryName;
          $businessInfo ->subcategoryName = $request->subcategoryName;
          $businessInfo ->country = $request->country;
          $businessInfo ->city = $request->city;
          $businessInfo ->fax = $request->fax;
          $businessInfo->image = $request->image;
          

        $nameF = "BusinessLogo_" . time();
        if($request->hasFile('image'))
        {
             $image = $request->file('image');

        $result = $request->image->storeOnCloudinaryAs('business', $nameF);
        $imagename = $result->getFileName();
        $extension = $result->getExtension();

        $name = $imagename . "." . $extension;
        $path = $result->getSecurePath();
        $imageID = $result->getPublicId(); 
        $businessInfo->image = $name;
        }

        $nameF = "Featured_" . time();
        if($request->hasFile('featured_image'))
        {

          // dd("found");
         
          //   $image = $request->file('featured_image');
          //   $name = 'Business_'.time().'.'. $image->getClientOriginalExtension();
          //   $destinationPath = public_path('/images/business/featuredImage ');
          //   $image->move($destinationPath, $name);
          //   $businessInfo->featured_image = $name;

          $result    = $request->featured_image->storeOnCloudinaryAs('featured', $nameF);
          $imagename = $result->getFileName();
          $extension = $result->getExtension();
  
          $name = $imagename . "." . $extension;
          $path = $result->getSecurePath();
          $imageID = $result->getPublicId(); 
          $businessInfo->featured_image = $name;
        }


        // $businessInfo ->featured_business = $request-> featured_business;

      
        $businessInfo->save();


    //    $business =  Business::create($request->all()); //

       $response = Response(
        [
         'message' => 'Business has been successfully added',
         'data' => $businessInfo,
        ], 200
    );
    return $response;
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

        // $user_id = $request->input('user_id');
        // $user = User::find($user_id);
        // $company ->user_id = Auth::user()->id;

         $company = Business::find($id);


       $company ->name = $request->name;
       $company ->description = $request->description;
       $company ->website = $request-> website;
       $company ->andress = $request-> andress;
       $company ->email = $request-> email;
       $company ->contact = $request->contact;
       $company ->code = $request->code;
       $company ->zipcode = $request-> zipcode;
       $company ->categoryName = $request->categoryName;
       $company ->subcategoryName = $request->subcategoryName;
       $company ->country = $request->country;
       $company ->city = $request->city;
       $company->image = $request->image; 
       $company->featured_image = $request->featured_image; 

       if(isset($request->image))
        {
            if($request->publicIdLogo != null){
                if($request->publicIdLogo != "business/noLogo.png")
                {
                 cloudinary()->destroy($request->publicIdLogo);
                }
            }
          
        };


       if(isset($request->featured_image))
       {
           if($request->publicIdbanner != null){
               if($request->publicIdbanner != "featured/no_featuredImage.jpg")
               {
                cloudinary()->destroy($request->publicIdbanner);
               }
           }
         
       };

     // $product->name = $request->name;
     // $product->price = $request->price;
     // $product->service_id = json_encode($request->service_id);
     // $product->status = $request->status;
     
    //  if($request->hasFile('image'))
    //  {
    //     //  $image = $request->file('image');
    //     //  $name = 'Business_'.time().'.'. $image->getClientOriginalExtension();
    //     //  $destinationPath = public_path('/images/business/logo');
    //     //  $image->move($destinationPath, $name);

    //     $nameF = "BusinessLogo_" . time();
    //     if($request->hasFile('image'))
    //     {
    //     $image = $request->file('image');

    //     $result = $request->image->storeOnCloudinaryAs('business', $nameF);
    //     $imagename = $result->getFileName();
    //     $extension = $result->getExtension();

    //     $name = $imagename . "." . $extension;
     
    //     }
    //      $company->image = $name;
    //  }else{
    //     $company->image = $request->image; 
    //  }


    //  // $businessInfo ->featured_business = $request-> featured_business;

    //     $nameF = "Featured_" . time();
    //    if($request->hasFile('featured_image'))
    //    {
    //         $image = $request->file('featured_image');
    //     //    $name = 'Business_'.time().'.'. $image->getClientOriginalExtension();
    //     //    $destinationPath = public_path('/images/business/featuredImage ');
    //     //    $image->move($destinationPath, $name);
    //     $result    = $request->featured_image->storeOnCloudinaryAs('featured', $nameF);
    //     $imagename = $result->getFileName();
    //     $extension = $result->getExtension();
    //     $name = $imagename . "." . $extension;
    //     $company->featured_image = $name;
    //    }else{
    //     $company->featured_image = $request->featured_image; 
    //    }
    //    $company->save();
       
       $company->update();

        //  $company->update([
        //     "name" => $request -> name
        //  ]);

        return [
            'message' => 'Successfully updated',
            "data" => $company,
            "success" => true
        ];
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
        $company = Business::find($id);
        $company->delete();

        return  [
            'message' => 'Business has been deleted successfully',
        ];
    }


    /**
     * Search the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($name){
        return Business::where('name','like','%'.$name.'%')->get();
    }



    // public function getImagePathAttribute()
    // {
    //     return url('images/business') . '/';
    // }
}
