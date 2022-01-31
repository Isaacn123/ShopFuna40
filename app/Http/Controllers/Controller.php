<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
// use App\Http\Controllers\Controller;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  

    public function index(){

        // return view('fcm.firebase');
// 
        // dd()

    }

    public function saveToken(Request $request)
    {
        auth()->user()->update(['device_token'=>$request->token]);
        return response()->json(['token saved successfully.']);
    }

    public function sendNotification(){ 
             
            $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

            $token = "fb9HoBAlTKKuV98t7R_Lm6:APA91bEzJvYmnt3m9d7d4JCrz9zSFaIioIrwXxaiOTLJR-JxvDekoAKS-kJHYX8wZgetytKOiKhdzjZv8tCbmPJbRENzpiOUrQ4hzwBbzX9rGr5H-hMQ2q8-ke3KCYsEKVj5DwpieWHa";  
            $topic = "topics/Welcome";
            $from = "AAAARpNYIuk:APA91bE7-dodC-2O-MW97FjgMA2M9de5Ra-cbffqm_USOGhwAqb3Tyl55aizOqbCkE1HWSHb75fI9vlMQfcCp1wKg2gvBXkpPMX9Rq4K9medDELG2COvOWnFkNHDWvt_dVDoHptf8Ywg";
            $msg = array
                  (
                    'body'  => "Testing Testing",
                    'title' => "Hi, From ISAAC",
                    'receiver' => 'erw',
                    'icon'  => "https://image.flaticon.com/icons/png/512/270/270014.png",/*Default Icon*/
                    'sound' => 'mySound'/*Default sound*/
                  );
    
            $fields = array
                    (
                        'to'        => $firebaseToken,//$token,
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
            
            print($result);
            curl_close( $ch );
        }
    
    
}



