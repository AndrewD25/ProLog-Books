/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";


//Add flip ability to all books
let allBooks = document.getElementsByClassName("book");

for (let i = 0; i < allBooks.length; i++) {
    allBooks[i].addEventListener("click", function(e) {
        //Save the book that is clicked into a variable
        let currentBook = e.target.closest('.book');

        if (currentBook) {
            // Toggle the 'flipped' class on the clicked book
            currentBook.classList.toggle("flipped");

            // Remove 'flipped' from other books
            let otherBooks = document.getElementsByClassName("book");
            for (let j = 0; j < otherBooks.length; j++) {
                if (otherBooks[j] !== currentBook) {
                    otherBooks[j].classList.remove("flipped");
                };
            };
        };
    });
};


