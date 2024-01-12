/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";

// "All" Variables
let everythingArray = []; //To possibly be used later
let allBooks = document.getElementsByClassName("book");
let allAddBookButtons = document.getElementsByClassName("addBookButton");
let folderContainer = document.getElementById("folderContainer");
let allFolders = document.getElementsByClassName("folder");
let allFolderLinks = document.getElementsByClassName("folderLink");
let allFlipButtons = document.getElementsByClassName("flipButton");


//Add flip ability to all books

for (let i = 0; i < allFlipButtons.length; i++) {
    allFlipButtons[i].addEventListener("click", function(e) {
        // Traverse up the DOM to find the closest parent with the 'book' class
        let currentBook = e.target.closest('.book');

        if (currentBook) {
            // Toggle the 'flipped' class on the found book
            currentBook.classList.toggle("flipped");

            // Remove 'flipped' from other books
            // let otherBooks = document.getElementsByClassName("book");
            // for (let j = 0; j < otherBooks.length; j++) {
            //     if (otherBooks[j] !== currentBook) {
            //         otherBooks[j].classList.remove("flipped");
            //     }
            // }
        }
    });
}

// Example function for draw folder links
function drawFolderLinks() {
    let folderIDs = [];
    for (let i = 0; i < allFolders.length; i++) {
        folderIDs.push(allFolders[i].id);
    };
    for (let i = 0; i < folderIDs.length; i++) {
        //Count number of books in each folder
        let countNumber = Array.from(allFolders[i].children).filter(child => child.classList.contains("book")).length

        //Create labels
        let p = document.createElement("p");
        p.classList.add("folderLink");
        p.innerHTML = `${folderIDs[i]} <i class="fas fa-folder"></i> <span class="folderCount">${countNumber}</span>`;
        folderContainer.append(p);
    }
};
drawFolderLinks();

//Add functionality to folder links
for (let i = 0; i < allFolderLinks.length; i++) {
    allFolderLinks[i].addEventListener("click", function() {
        for (let j = 0; j < allFolders.length; j++) {
            let folderInner = allFolderLinks[i].innerHTML;
            let htmlStart = folderInner.indexOf('<i class="fas fa-folder"></i> <span class="folderCount">') - 1 //Get the index where the title ends
            if (allFolders[j].id == folderInner.substring(0, htmlStart)) {
                allFolders[j].classList.remove("hidden");
            } else {
                allFolders[j].classList.add("hidden");
            }
        }
    })
}

// Make addBookButtons disappear until prompted to appear, then stay open for a few seconds or until other buttons appear
for (let i = 0; i < allBooks.length; i++) {
    //Create an event listener for the book to activate
}
function activate() {
    //Make add books show
    //Start making them fade away and make them disappear after a few seconds
    //Hide buttons if another book is activated
}




// Make Add Book Buttons Functional
// for (let i = 0; i < allAddBookButtons.length; i++) {
//     allAddBookButtons[i].addEventListener("click", function(e) {
//         //Get target book
//         //Get book position
//         //Save either a .before or .after position
//     })
// }


