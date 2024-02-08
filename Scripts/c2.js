/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

/*
High priority to do:
 - Add images to the add book modal
 - make the copy button highlight when it is clicked
 - make the delete button functional
 - get database and web hosting set up
*/

"use strict";

  ////////////////////
 // Data variables //
////////////////////

let username = "";
let password = ""; //Might delete later

//User collection is an object that has folders as its properties which each hold an array of books
let collection = {
    "Example": ["String"]
}


  ////////////////////////////
 // HTML Element Variables //
////////////////////////////

//Login Modal
let loginModal = document.getElementById("loginModal");
let usernameInput = document.getElementById("usernameInput");
let passwordInput = document.getElementById("passwordInput");
let loginBtn = document.getElementById("loginButton")
let cancelLoginBtn = document.getElementById("cancelLogin");

//Add Books Modal
// let addBookModal = document.getElementById("addBookModal");


  ///////////////
 // Functions //
///////////////

function login() {
    //Check if fields are filled in
    if (usernameInput.value == "" || passwordInput.value == "") {
        alert("Username and Password cannot be empty");
        return;
    }

    //Login Functionality
    username = usernameInput.value;

    //Close the login modal window
    hideLoginModal();
}

function saveData() {
    localStorage.setItem(username, JSON.stringify(collection));
}

function loadData() {
    let collection = JSON.parse(localStorage.getItem(username));
    console.log(collection);
}

function showLoginModal() {
    loginModal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hideLoginModal() {
    loginModal.classList.add('hidden');
    overlay.classList.add("hidden");
    //Clear text in all input fields
    let inputs = loginModal.querySelectorAll('input, textarea');
    inputs.forEach(function(input) {
        input.value = '';
    });
}



  ///////////////////////////////////////
 // Onclicks and On Startup Functions //
///////////////////////////////////////

loginBtn.onclick = login;
cancelLoginBtn.onclick = hideLoginModal;




