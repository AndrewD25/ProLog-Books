/*
Andrew Deal
Social Page Script
DUE DATE 
*/

"use strict";

//Confetti is just for fun for presentation delete later
//Set up confetti
const jsConfetti = new JSConfetti()
let allBooks = document.querySelectorAll(".book");
for (let i = 0; i < allBooks.length; i++) {
    allBooks[i].addEventListener("click", function () {
        jsConfetti.addConfetti();
    });
}