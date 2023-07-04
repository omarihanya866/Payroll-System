import { initializeApp } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-app.js";
import { getDatabase } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-database.js";
import {
getAuth,
signOut 
} from "https://www.gstatic.com/firebasejs/9.15.0/firebase-auth.js";
// import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.15.0/firebase-analytics.js";

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyARTK3Lvx7WgXMmUoGhzs0MO0rCZOE6hZg",
    authDomain: "payroll-system-8f630.firebaseapp.com",
    databaseURL: "https://payroll-system-8f630-default-rtdb.firebaseio.com",
    projectId: "payroll-system-8f630",
    storageBucket: "payroll-system-8f630.appspot.com",
    messagingSenderId: "512846977040",
    appId: "1:512846977040:web:361c0416418a39d9019295",
    measurementId: "G-DDZNWB0QSY"
  };

const app = initializeApp(firebaseConfig);
/*const database = getDatabase(app);*/
const auth = getAuth();
        
const signOutButton = document.getElementById("logout-link");

// Sign-Out
const signOutNow = () => {
signOut(auth).then(() => {
// Sign-out successful.
window.location = "./login.html";
}).catch((error) => {
// An error happened.
});
}
signOutButton.addEventListener('click', signOutNow);