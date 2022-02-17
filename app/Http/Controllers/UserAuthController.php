<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
// use App\SendMessage\SendMessage;
class UserAuthController extends Controller
{
    //


    // public function __construct(SendMessage $sendmessage)
    // {
    //     $this->sendmessage = $sendMessage;
    // }
    

    /* User Registration Methods */

      public function Register(Request $request){
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'code' => 'bail|required',
            'phone' => 'bail|required|numeric',
            
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'code' => $fields['code'],
            'phone' => $fields['phone'],
        ]);

        Mail::to($user->email)->send(new WelcomeMail($user));

        $token = $user->createToken('myuserToken')->plainTextToken;
        $response = Response([
            'user' => $user,
            'token' => $token,
        ]);

        $this->sendNotification();
        return $response;
      }



      // Logout the User here 

      public function logout(Request $request){
       
        auth()->user()->tokens()->delete();

        return [
            'message'=> 'user successfully LoggedOut'
        ];

        
      }



      // User Login section here 

      public function Login(Request $request){
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        
        // check User
           $user = User::where('email', $fields['email'])->first();

       // check Password
       if(!$user || !Hash::check($fields['password'], $user->password)){
         return response([
             'message'=> 'User email/Password Invalid',
         ]);
       }   
        $token = $user->createToken('myuserToken')->plainTextToken;
        
          // $token = $user->createToken('myuserToken')->accessToken;
        $response = Response([
            'user' => $user,
            'token' => $token,
        ]);

        // $this->sendNotification();
        return $response;
       
      }




      // Edit user Profile Profile

      public function profile_edit(Request $request){

        $request->validate([
          // 'name' => 'bail|required',
          // 'code' => 'bail|required',
          // 'phone' => 'bail|required|numeric',
        ]);

       
        $user = User::find(Auth::user()->id);

         $user->name = $request-> name;
         $user->email = $request-> email;
         $user->phone = $request-> phone;
         $user->code = $request-> code;
         $user->zipcode = $request-> zipcode;
         $user->save();
         $response = Response([
           "message" => "Your profile has been updated successfully",
           "user" => $user,
           "success"
         ], 200);


         return $response;

      }


      // Edit Profile image Here function
      public function profile_edit_image(Request $request){
      
        $request->validate([
          // mimes:jpg,png,jpeg|max:5048
          'image' => 'bail|required',
        ]);

      $user = User::find(Auth::user()->id);


      $user->image = $request->image;
        
        // $nameF = "User_" . time();

        // if(isset($request->image)){
        // if($user->image != "noimage.jpg")
        // {
        //     if(file_exists($user->image)){
        //       // unlink('https://res.cloudinary.com/ivhfizons/image/upload/v1639060843/user/'. $user->image);
        //       // dd("filed availability tru");
        //       // cloudinary.uploader.destroy('sample', function(result) { console.log(result) }); 
        //       // Cloudinary::destroy($user->image);
        //       // $user->image->destroy();
        //     }
        // }
      // $res =   Cloudinary::destroy($user->image);
      //  dd($res);
        // $result = $request->image->storeOnCloudinaryAs('user', $nameF);
        // $imagename = $result->getFileName();
        // $extension = $result->getExtension();

        // $name = $imagename . "." . $extension;
        // $path = $result->getSecurePath();
        // $user->image = $name;
        // $imageID = $result->getPublicId();
        // $user->image = $request->image;
      // }

       $user->save();

      $response = Response([
        'message' => 'Editing profile has been successfully updated',
        'data' => $user,
        
        "success" => true,
      ], 200);

  return $response;

      }


   /// find all user profile 
   
   public function profile(Request $request){
     $user = User::with('address')->find(Auth::user()->id);

     $response = Response([
       "data" => $user,
       "message" => "Show User Profile",
       "success" => true,
     ], 200);

     return $response;
   }


   /// get all products that belong to a perticular User ID

   public  function  products(){
    $user = User::with('products')->find(Auth::user()->id);
     $products = new Response([
      "data" => $user,
      "message" => "Show User Products",
      "success" => true,
     ]);
    return  $products;

   }



    // All Addresss
    public function all_address()
    {
        $address = Address::where('user_id',Auth::user()->id)->orderBy('id','DESC')->get();
        return response()->json(['msg' => 'All Addresses','data' => $address ,'success' => true], 200);
    }


   public function add_address(Request $request){
   
   
   
   
    $request->validate([
      'label' => 'bail|required',
      'addr1' => 'bail|required',
      'lat' => 'bail|required',
      'long' => 'bail|required',
  ]);

  $address = new Address();
  $address->user_id = Auth()->user()->id;
  $address->label = $request->label;
  $address->addr1 = $request->addr1;
  $address->city = $request->city;
  $address->state = $request->state;
  $address->country = $request->country;
  $address->zipcode = $request->zipcode;
  $address->lat = $request->lat;
  $address->long = $request->long;
  $address->save();

   $response = Response([
     "message"=>"Address has been successfully created",
     'success' => true,
     "data"=>$address
   ], 200);


   return $response;
    
   }


   public function sendNotification(){ 
             
    $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

    // $token = "fb9HoBAlTKKuV98t7R_Lm6:APA91bEzJvYmnt3m9d7d4JCrz9zSFaIioIrwXxaiOTLJR-JxvDekoAKS-kJHYX8wZgetytKOiKhdzjZv8tCbmPJbRENzpiOUrQ4hzwBbzX9rGr5H-hMQ2q8-ke3KCYsEKVj5DwpieWHa";  
    // $topic = "topics/Welcome";
    $from = "AAAARpNYIuk:APA91bE7-dodC-2O-MW97FjgMA2M9de5Ra-cbffqm_USOGhwAqb3Tyl55aizOqbCkE1HWSHb75fI9vlMQfcCp1wKg2gvBXkpPMX9Rq4K9medDELG2COvOWnFkNHDWvt_dVDoHptf8Ywg";
    $msg = array
          (
            'body'  => "Thanks for signing up to keep you up to date with Funa Akatale. You'll get regular updates on sales and other  offers.",
            'title' => "Welcome to Funa Akatale",
            'receiver' => 'erw',
            'icon'  => "https://res.cloudinary.com/ivhfizons/image/upload/v1642777098/notification-logo.png",/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
          );

    $fields = array
            (
                'registration_ids' => $firebaseToken, // "registration_ids" => $firebaseToken, ///'to' => implode($firebaseToken),//$token,
                'notification'  => $msg,
                'time_to_live' => 3600,
            );

    $headers = array
            (
                'Authorization: key=' . $from,
                'Content-Type: application/json'
            );
    //#Send Reponse To FireBase Server 
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    // dd($result);
    // dd($firebaseToken);
    // print($result);
    curl_close( $ch );
}


}
