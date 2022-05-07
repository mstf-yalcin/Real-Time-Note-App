import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js'
import {getAuth,createUserWithEmailAndPassword,signInWithEmailAndPassword,GoogleAuthProvider,signInWithPopup   } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js'
import { getDatabase,ref,set,child,update,push  } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";



// const config = {
//     apiKey: "***********************",
//     authDomain: "******************",
//     databaseURL: "******************",
//     projectId: "*****************",
//     storageBucket: "**************",
//     messagingSenderId: "******************",
//     appId: "************",
//     measurementId: "*******************"
//   };

//   const app  = initializeApp(config);

  const provider = new GoogleAuthProvider();
  const auth = getAuth();


//   var loginEmail=document.getElementById('loginEmail');

//   loginEmail.addEventListener('click',function(){
//     var email=document.getElementById('email');
//     var password=document.getElementById('pass');
  
//     if(email.value !="" && password.value!="")
//     {
//         signInWithEmailAndPassword (auth,email.value,password.value).then((data)=>{
//             localStorage.setItem('user',JSON.stringify( data.user));
//             console.log("success");

//            }).catch((err)=>{
//                var loginError=document.querySelectorAll('#loginError');
//                loginError.forEach(element => {
//                    element.style.display="block";
//                });
//                email.classList.add('is-invalid');
//                password.classList.add('is-invalid');
//                console.log(err.message);
//            })
//     }
  

//   })


//   var loginGoogle=document.getElementById('loginGoogle');

//   loginGoogle.addEventListener('click',function(){
//       signInWithPopup(auth,provider ).then((data)=>{
//       console.log(data);

//     }).catch((err)=>{
//         console.log(err.message);
//     })

//   })


  var sign=document.getElementById('sign');

  sign.addEventListener('click',function(){
    var email=document.getElementById('email');
    var password=document.getElementById('pass');
    var name=document.getElementById('name');

      console.log("icerde");
    if(email.value!="" && password.value!="")
    {
        createUserWithEmailAndPassword(auth,email.value,password.value).then((data)=>{
            localStorage.setItem('user',JSON.stringify( data.user));
       
            console.log("girdi");
       
        const db = getDatabase();
        set(ref(db,`users/${data.user.uid}`), {
           uid:data.user.uid,
           email:email.value,
           name:name.value,
           pp:null,
           created_at:serverTimestamp()

             });



            }).catch((err)=>{
                var loginError=document.querySelectorAll('#loginError');
                loginError.forEach(element => {
                    element.style.display="block";
                });
                email.classList.add('is-invalid');
                password.classList.add('is-invalid');
                name.classList.add('is-invalid');

                console.log(err.message);
            })
    }
      
  

  })