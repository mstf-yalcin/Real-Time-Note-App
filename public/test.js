import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-app.js'
import { getDatabase,ref,set,child,update,remove,onValue } from "https://www.gstatic.com/firebasejs/9.6.10/firebase-database.js";
// If you enabled Analytics in your project, add the Firebase SDK for Google Analytics
// import { analytics } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-analytics.js'
// Add Firebase products that you want to use
// import { auth } from 'https://www.gstatic.com/firebasejs/9.6.10/firebase-auth.js'

const config = {
    apiKey: "AIzaSyAc9BAKTEV-xJXbXC-8uhBiEJ0wxuRfgrU",
    authDomain: "note-app-3a73c.firebaseapp.com",
    databaseURL: "https://note-app-3a73c-default-rtdb.europe-west1.firebasedatabase.app",
    projectId: "note-app-3a73c",
    storageBucket: "note-app-3a73c.appspot.com",
    messagingSenderId: "165140820270",
    appId: "1:165140820270:web:73824ebc52afa42cd1cabf",
    measurementId: "G-PW81EVN3KR"
  };

const app  = initializeApp(config);


const db = getDatabase();
const doc = ref(db, 'as/');
onValue(doc, (snapshot) => {
const data = snapshot.val();
console.log(data);
});
