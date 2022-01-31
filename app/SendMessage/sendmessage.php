

<?php
use App\Models\User;

class SendMessage {

   
    public function sendThanksNotice(){ 
             
        $firebaseToken = User::whereNotNull('device_token')->pluck('device_token')->all();

        $token = "fb9HoBAlTKKuV98t7R_Lm6:APA91bEzJvYmnt3m9d7d4JCrz9zSFaIioIrwXxaiOTLJR-JxvDekoAKS-kJHYX8wZgetytKOiKhdzjZv8tCbmPJbRENzpiOUrQ4hzwBbzX9rGr5H-hMQ2q8-ke3KCYsEKVj5DwpieWHa";  
        $topic = "topics/Welcome";
        $from = "AAAARpNYIuk:APA91bE7-dodC-2O-MW97FjgMA2M9de5Ra-cbffqm_USOGhwAqb3Tyl55aizOqbCkE1HWSHb75fI9vlMQfcCp1wKg2gvBXkpPMX9Rq4K9medDELG2COvOWnFkNHDWvt_dVDoHptf8Ywg";
        $msg = array
              (
                'body'  => "Thanks for Installing Funa Akatale.",
                'title' => "Funa Akatale",
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
        dd($firebaseToken);
        print($result);
        curl_close( $ch );
    }
    }