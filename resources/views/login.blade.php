<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Online Note-App</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />

  <link rel="stylesheet" href="{{asset('css/login.css')}}">
  <link rel="shortcut icon" href="{{asset('img/logo.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{asset('img/logo.png')}}" style="width: 64px;height:64px" alt="logo"><span style="font-size: 1.5em" >Docs</span>
              </div>
              <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form  action="javascript:void(0);" class="pt-3">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" required placeholder="Email">
                  <div style="display: none" id="loginError" class="invalid-feedback">
                    Incorrect email or password
                  </div>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="pass" required placeholder="Password">
                  <div style="display: none" id="loginError" class="invalid-feedback">
                    Incorrect email or password
                  </div>
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-facebook btn-lg font-weight-medium auth-form-btn"  id="loginEmail" style="color:#fff"  >SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      {{-- <input type="checkbox" class="form-check-input">
                      Keep me signed in --}}
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <a type="button" id="loginGoogle" style="color: #fff;background-color:#2684fc !important" class="btn btn-block btn-secondary auth-form-btn">
                   <img src="{{asset('img/google.png')}}" style="width: 24px;height:24px; " alt=""> Connect using google
                  </a>
                  <a href="{{route('guestDocs')}}" onclick="loadingGuest()" type="submit" id="loginGoogle" style="color: #2684fc;background-color:#transparent !important" class="btn btn-block auth-form-btn">
                    Continue without Login
                   </a>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="{{route('signUp')}}" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  {{-- <div style="display: none" id="loading-wrapper">
    <div id="loading-text">LOADING</div>
    <div id="loading-content"></div>
  </div> --}}

  @include('include/load')

</body>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>

<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js" ></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js" ></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js" ></script>


<script src="{{asset('js/config.js')}}"></script>

<script>
  function loadingGuest()
  {
    var load=document.getElementById('loading-wrapper');
              load.style.display="block";
  }
</script>

<script>
var provider = new firebase.auth.GoogleAuthProvider();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });


  var loginEmail=document.getElementById('loginEmail');

  loginEmail.addEventListener('click',function(){
    var load=document.getElementById('loading-wrapper');
              load.style.display="block";

    var email=document.getElementById('email');
    var password=document.getElementById('pass');
  
    if(email.value !="" && password.value!="")
    {
      firebase.auth().signInWithEmailAndPassword(email.value,password.value).then((data)=>{
        const dbRef = firebase.database().ref();
        dbRef.child("users").child(data.user.uid).get().then((snapshot) => {
      if (snapshot.exists()) {
        $.ajax({
            method: "post",
            type: "post",
            url: '{{route('loginRequest')}}',
            data: {'uid':snapshot.val().uid,'email':snapshot.val().email,'name':snapshot.val().name,'docs':snapshot.val().docs,'pp':snapshot.val().pp,'stat':0},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
              // console.log(error);
            }
           });        

      } 
 
     }).catch((error) => {
    });
           
           }).catch((err)=>{
            //  console.log(err);
            load.style.display="none";
               var loginError=document.querySelectorAll('#loginError');
               loginError.forEach(element => {
                   element.style.display="block";
               });
               email.classList.add('is-invalid');
               password.classList.add('is-invalid');
           })
    }
  

  })


  var loginGoogle=document.getElementById('loginGoogle');

  loginGoogle.addEventListener('click',function(){
  firebase.auth().signInWithPopup(provider).then((data)=>{
        var load=document.getElementById('loading-wrapper');
              load.style.display="block";
  
      const dbRef = firebase.database().ref();
      dbRef.child("users").child(data.user.uid).get().then((snapshot) => {
     if (snapshot.exists()) {
 
      $.ajax({
            method: "post",
            type: "post",
            url: '{{route('loginRequest')}}',
            data: {'uid':snapshot.val().uid,'email':snapshot.val().email,'name':snapshot.val().name,'docs':snapshot.val().docs,'pp':snapshot.val().pp,'stat':0},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
            }
        });
    } 
    else {
      // const db = getDatabase();
      // set(ref(db,`users/${data.user.uid}`), {
      //    uid:data.user.uid,
      //    email:data.user.email,
      //    name:data.user.displayName,
      //    pp:data.user.photoURL,
      //    created_at:time
      //      })

      $.ajax({
            method: "post",
            type: "post",
            url: '{{route('loginRequest')}}',
            data: {'uid':data.user.uid,'email':data.user.email,'name':data.user.displayName,'pp':data.user.photoURL,'stat':1},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
            }
        });

         }
        }).catch((error) => {
        });




    }).catch((err)=>{
      load.style.display="none";
      
    })

  })



</script>

{{--- ********************** firebase9 ***************** --}}

{{-- <script type="module">
import {getAuth,createUserWithEmailAndPassword,signInWithEmailAndPassword,GoogleAuthProvider,signInWithPopup   } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js'
import { getDatabase,ref,set,child,update,push,get  } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";


const db = getDatabase();
const provider = new GoogleAuthProvider();
const auth = getAuth();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });


  var loginEmail=document.getElementById('loginEmail');

  loginEmail.addEventListener('click',function(){
    var load=document.getElementById('loading-wrapper');
              load.style.display="block";

    var email=document.getElementById('email');
    var password=document.getElementById('pass');
  
    if(email.value !="" && password.value!="")
    {
        signInWithEmailAndPassword (auth,email.value,password.value).then((data)=>{
            const dbRef = ref(getDatabase());
    get(child(dbRef, `users/${data.user.uid}`)).then((snapshot) => {
     if (snapshot.exists()) {

            $.ajax({
            method: "post",
            type: "post",
            url: '{{route('loginRequest')}}',
            data: {'uid':snapshot.val().uid,'email':snapshot.val().email,'pp':snapshot.val().pp,'name':snapshot.val().name,'stat':0},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
            }
        });
        } 
         }).catch((error) => {
        });

           }).catch((err)=>{
            load.style.display="none";
               var loginError=document.querySelectorAll('#loginError');
               loginError.forEach(element => {
                   element.style.display="block";
               });
               email.classList.add('is-invalid');
               password.classList.add('is-invalid');
           })
    }
  

  })


  var loginGoogle=document.getElementById('loginGoogle');

  loginGoogle.addEventListener('click',function(){
      signInWithPopup(auth,provider ).then((data)=>{
        var load=document.getElementById('loading-wrapper');
              load.style.display="block";

      const dbRef = ref(getDatabase());
    get(child(dbRef, `users/${data.user.uid}`)).then((snapshot) => {
     if (snapshot.exists()) {
      $.ajax({
            method: "post",
            type: "post",
            url: '{{route('loginRequest')}}',
            data: {'uid':data.user.uid,'email':data.user.email,'name':data.user.displayName,'pp':data.user.photoURL,'stat':0},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
            }
        });
    } 
    else {
      // const db = getDatabase();
      // set(ref(db,`users/${data.user.uid}`), {
      //    uid:data.user.uid,
      //    email:data.user.email,
      //    name:data.user.displayName,
      //    pp:data.user.photoURL,
      //    created_at:time
      //      })

      $.ajax({
            method: "post",
            type: "post",
            url: '{{route('loginRequest')}}',
            data: {'uid':data.user.uid,'email':data.user.email,'name':data.user.displayName,'pp':data.user.photoURL,'stat':1},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
            }
        });

         }
        }).catch((error) => {
        });




    }).catch((err)=>{
      load.style.display="none";

    })

  })

</script> --}}



 


</html>
