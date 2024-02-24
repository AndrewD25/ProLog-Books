/*
Andrew Deal
Secret Shelf All Pages Shared JS
DUE DATE
*/

"use strict";

//Toggle Dropdown : Used on all pages' heading to show or hide the dropdown menus
//Right now I only have one for accounts but if I add another one then I will need this more flexible function
function toggleDropdown(elementID) {
    let elementToChange = document.getElementById(elementID);
    elementToChange.classList.toggle("hidden");
}
//Given as an onclick in the page header

//Add the hidden class when anywhere else is clicked on the page
document.addEventListener("click", function (e) {
    let allDropdowns = document.getElementsByClassName("dropdown");
    for (let i = 0; i < allDropdowns.length; i++) {
        allDropdowns[i].classList.add("hidden");
    }
    try {
        let childDropdown = e.target.closest('li').querySelector(".dropdown");
        childDropdown.classList.toggle("hidden");
    } catch (err) {
        //clicked outside of dropdown
    }
})

//Sign Out : Primarily used on Collection and Account pages
function signOut() {
    localStorage.removeItem("username");
    location.reload();
}