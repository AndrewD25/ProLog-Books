/*
Andrew Deal
Social Page Script
DUE DATE 
*/

"use strict";

const searchBox = document.getElementById("search");
const userBox = document.getElementById("usersContainer");

function search() {
    let childrenOfUB = userBox.children;
    for (let i = 0; i < childrenOfUB.length; i++) {
        let my = childrenOfUB[i];
        if (my.textContent.toLowerCase().includes(searchBox.value.toLowerCase()) || my.id === "search") {
            my.classList.remove("hidden");
        } else {
            my.classList.add("hidden");
        }
    }
};

// Scroll to top
let mybutton = document.getElementById("scrollBtn");

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
    mybutton.style.display = "block";
  } else {
    mybutton.style.display = "none";
  }
}

function topFunction() {
    window.scrollTo({top: 0, behavior: 'smooth'});
}

searchBox.addEventListener("keyup", search);
searchBox.addEventListener("click", search);