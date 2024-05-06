/*
Andrew Deal
Secret Shelf Articles Page JS
DUE DATE
*/

"use strict";


const articlesContainer = document.getElementById("articleGrid");
let articles = articlesContainer.children;


//Search Feature 

const searchBox = document.getElementById("search");

function search() {
    for (let i = 0; i < articles.length; i++) {
        let my = articles[i];
        let myTitle = my.querySelector(".title").textContent;
        if (myTitle.toLowerCase().includes(searchBox.value.toLowerCase())) {
            my.classList.remove("hidden");
        } else {
            my.classList.add("hidden");
        }
    }
};

searchBox.addEventListener("keyup", search);
searchBox.addEventListener("click", search);


//Filter Feature

const filterContainer = document.getElementById("filterBox");
let filterSelects = filterContainer.querySelectorAll("input[type=checkbox]"); //The array of the actual selectors for filtering on and off

function applyFilter() {
    // Loop through articles
    for (let i = 0; i < articles.length; i++) {
        let articleDate = articles[i].querySelector(".date").textContent;
        let parts = articleDate.split("/");
        let articleMonth = parseInt(parts[0], 10);
        let articleYear = parseInt("20" + parts[2], 10);

        // Loop through filters
        let hidden = false;
        for (let k = 0; k < filterSelects.length; k++) {
            if (!filterSelects[k].checked) {
                let filterDate = filterSelects[k].parentElement.querySelector("p").textContent;
                let filterParts = filterDate.split(" ");
                let filterMonth = filterParts[0];
                let filterYear = parseInt(filterParts[1], 10);

                if (articleMonth === getMonthNumber(filterMonth) && articleYear === filterYear) {
                    hidden = true;
                    break;
                }
            }
        }
        if (hidden) {
            articles[i].classList.add("hidden2");
        } else {
            articles[i].classList.remove("hidden2");
        }
    }
}

function getMonthNumber(monthName) {
    let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    return months.indexOf(monthName) + 1;
}

for (let i = 0; i < filterSelects.length; i++) {
    filterSelects[i].addEventListener("click", function () {
        applyFilter();
    });
}

