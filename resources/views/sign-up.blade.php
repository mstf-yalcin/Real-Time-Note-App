<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Sign-Up Online Note-App</title>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
 
  <link rel="stylesheet" href="{{asset('css/login.css')}}">
  <link rel="stylesheet" href="{{asset('css/load.css')}}">
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
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form  action="javascript:void(0);"  class="pt-3">
                <div class="form-group">
                  <input minlength="2" type="text" class="form-control form-control-lg" id="name" required placeholder="Name">
                  <div style="display: none" id="loginError" class="invalid-feedback">
                    Incorrect email or password
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg" id="email" required placeholder="Email">
                  <div style="display: none" id="loginError" class="invalid-feedback">
                    Incorrect email or password
                  </div>
                </div>
                <div class="form-group">
                  <input minlength="6" type="password" class="form-control form-control-lg" id="pass" required placeholder="Password">
                  <div style="display: none" id="loginError" class="invalid-feedback">
                    Incorrect email or password
                  </div>
                </div>
                <div class="mb-4">
                  <div style="margin-left: 25px">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" required class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <div class="mt-3">
                  <button  id="sign" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN UP</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="{{route('login')}}" class="text-primary">Login</a>
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

@php
$time=\Carbon\Carbon::now();
echo "<script> var time='".$time."'</script>"
@endphp


<script src="https://code.jquery.com/jquery-3.6.0.js"></script>



<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-app.js" ></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-database.js" ></script>
<script src="https://www.gstatic.com/firebasejs/8.9.1/firebase-auth.js" ></script>

<script src="{{asset('js/config.js')}}"></script>

<script>
  
  var sign=document.getElementById('sign');
  var user;
  sign.addEventListener('click',function(){
    var email=document.getElementById('email');
    var password=document.getElementById('pass');
    var name=document.getElementById('name');
  
    if(email.value!="" && password.value!="")
    {
      var load=document.getElementById('loading-wrapper');
                load.style.display="block";
     firebase.auth().createUserWithEmailAndPassword(email.value,password.value).then((data)=>{
   
        // const db = getDatabase();
        // set(ref(db,`users/${data.user.uid}`), {
        //    uid:data.user.uid,
        //    email:email.value,
        //    name:name.value,
        //    pp:null,
        //    created_at:time
        //      }).then(()=>{
  
         
        //      });
  
        $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
  
       $.ajax({
              method: "post",
              type: "post",
              url: '{{route('signUpRequest')}}',
              data: {'uid':data.user.uid,'email':data.user.email,'name':name.value},
              success: function (response) {
                window.location.href ="/";
              },
              error:function (error)
              {
                load.style.display="none";
              }
           });
  
            }).catch((err)=>{
                var loginError=document.querySelectorAll('#loginError');
                load.style.display="none";
                loginError.forEach(element => {
                    element.style.display="block";
                });
                email.classList.add('is-invalid');
                password.classList.add('is-invalid');
                name.classList.add('is-invalid');
            })
        }
  })
  </script> 


{{--************************** firebase 9 ************************ --}}

{{-- <script src="{{asset('js/config.js')}}" type="module" ></script>

<script type="module">
import { getAuth,createUserWithEmailAndPassword } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js'
import { getDatabase,ref,set,child,update,push } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";

 
const auth = getAuth();

var sign=document.getElementById('sign');
var user;
sign.addEventListener('click',function(){
  var email=document.getElementById('email');
  var password=document.getElementById('pass');
  var name=document.getElementById('name');

  if(email.value!="" && password.value!="")
  {
    var load=document.getElementById('loading-wrapper');
              load.style.display="block";
      createUserWithEmailAndPassword(auth,email.value,password.value).then((data)=>{
 
      // const db = getDatabase();
      // set(ref(db,`users/${data.user.uid}`), {
      //    uid:data.user.uid,
      //    email:email.value,
      //    name:name.value,
      //    pp:null,
      //    created_at:time
      //      }).then(()=>{

       
      //      });

      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });

     $.ajax({
            method: "post",
            type: "post",
            url: '{{route('signUpRequest')}}',
            data: {'uid':data.user.uid,'email':data.user.email,'name':name.value},
            success: function (response) {
              window.location.href ="/";
            },
            error:function (error)
            {
              load.style.display="none";
            }
         });




          }).catch((err)=>{
              var loginError=document.querySelectorAll('#loginError');
              load.style.display="none";
              loginError.forEach(element => {
                  element.style.display="block";
              });
              email.classList.add('is-invalid');
              password.classList.add('is-invalid');
              name.classList.add('is-invalid');
          })
      }
})
</script> --}}

 


</html>
