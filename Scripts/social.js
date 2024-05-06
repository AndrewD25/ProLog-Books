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
        if (my.textContent.includes(searchBox.value) || my.id === "search") {
            my.classList.remove("hidden");
        } else {
            my.classList.add("hidden");
        }
    }
};

searchBox.addEventListener("keyup", search);
searchBox.addEventListener("click", search);