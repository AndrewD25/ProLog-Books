/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";

//Storage Variables
let folders = {}; //Store all folders from the db into this objet
//Then add the books into the folders as arrays

// "All" Variables
let allBooks = document.getElementsByClassName("book");
let folderContainer = document.getElementById("folderContainer");
let allFolders = document.getElementsByClassName("folder");
let allFolderLinks = document.getElementsByClassName("folderLink");
let allFlipButtons = document.getElementsByClassName("flipButton");
let allAddBookButtons = document.getElementsByClassName("addBookButton");

//Add flip ability to all books

for (let i = 0; i < allFlipButtons.length; i++) {
    allFlipButtons[i].addEventListener("click", function(e) {
        // Traverse up the DOM to find the closest parent with the 'book' class
        let currentBook = e.target.closest('.book');

        if (currentBook) {
            // Toggle the 'flipped' class on the found book
            currentBook.classList.toggle("flipped");

            //Remove 'flipped' from other books
            let flippedBooks = document.getElementsByClassName("flipped");
            for (let j = 0; j < flippedBooks.length; j++) {
                if (flippedBooks[j] !== currentBook) {
                    flippedBooks[j].classList.remove("flipped");
                }
            }
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


// Make Add Book Buttons Functional
for (let i = 0; i < allAddBookButtons.length; i++) {
    allAddBookButtons[i].addEventListener("click", function(e) {
        //Get target book
        //Get book position
        //Save either a .before or .after position
        showModal();
    })
}

function showModal() {
    modalWindow.classList.remove('hidden');
    overlay.classList.remove("hidden");
};

function closeModal() {
    modalWindow.classList.add("hidden");
    overlay.classList.add("hidden");
}