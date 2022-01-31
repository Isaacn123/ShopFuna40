@extends('layouts.admin')
@section('content')

<h1>Firebase Notification</h1>

<!-- <a href="{{url('send-notification')}}">Send Notification</a>
 -->

 <a href="{{url('send-notification')}}">Send Notification</a>
            <center>
  <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-xs btn-flat">Allow for Notification</button>
            </center>

 <form action="{{ route('send.notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title">
                        </div>
                        <div class="form-group">
                            <label>Body</label>
                            <textarea class="form-control" name="body"></textarea>
                          </div>
                        <button type="submit" class="btn btn-primary">Send Notification</button>
                    </form>


@endsection


@section('scripts')
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js"></script>
<script type="text/javascript">

  // Import the functions you need from the SDKs you need
//   import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.5/firebase-app.js";
//   import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.6.5/firebase-analytics.js";
//   // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
  apiKey: "AIzaSyB1vAnzdtTxkfoCrP33AXxaqLuQXxMyQaI",
  authDomain: "funa-akatale.firebaseapp.com",
  projectId: "funa-akatale",
  storageBucket: "funa-akatale.appspot.com",
  messagingSenderId: "303119737577",
  appId: "1:303119737577:web:c32b01f2526d0a12710678",
  measurementId: "G-ZKSCPE26CR"
};

  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
//   const analytics = getAnalytics(app);


  const messaging = firebase.messaging();

  
	messaging
.requestPermission()
.then(function () {
//MsgElem.innerHTML = "Notification permission granted." 
	console.log("Notification permission granted.");

     // get the token in the form of promise
	return messaging.getToken()
})
.then(function(token) {
 // print the token on the HTML page     
  console.log(token);
  
  
  
})
.catch(function (err) {
	console.log("Unable to get permission to notify.", err);
});




function initFirebaseMessagingRegistration() {
            messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);
   
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
  
                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token,
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Token saved successfully.');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });
  
            }).catch(function (err) {
                console.log('User Chat Token Error'+ err);
            });
     }  

messaging.onMessage(function(payload) {
    console.log(payload);
    var notify;
    notify = new Notification(payload.notification.title,{
        body: payload.notification.body,
        icon: payload.notification.icon,
        tag: "Dummy"
    });
    console.log(payload.notification);
});

    //firebase.initializeApp(config);
var database = firebase.database().ref().child("/users/");
   
database.on('value', function(snapshot) {
    renderUI(snapshot.val());
});

// On child added to db
database.on('child_added', function(data) {
	console.log("Comming");
    if(Notification.permission!=='default'){
        var notify;
         
        notify= new Notification('CodeWife - '+data.val().username,{
            'body': data.val().message,
            'icon': 'bell.png',
            'tag': data.getKey()
        });
        notify.onclick = function(){
            alert(this.tag);
        }
    }else{
        alert('Please allow the notification first');
    }
});

self.addEventListener('notificationclick', function(event) {       
    event.notification.close();
});
</script>



@endsection