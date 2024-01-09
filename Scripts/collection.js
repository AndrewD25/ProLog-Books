/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";


//Add flip ability to all books
let allFlipButtons = document.getElementsByClassName("flipButton");

for (let i = 0; i < allFlipButtons.length; i++) {
    allFlipButtons[i].addEventListener("click", function(e) {
        // Traverse up the DOM to find the closest parent with the 'book' class
        let currentBook = e.target.closest('.book');
        console.log(currentBook);

        if (currentBook) {
            // Toggle the 'flipped' class on the found book
            currentBook.classList.toggle("flipped");

            // Remove 'flipped' from other books
            let otherBooks = document.getElementsByClassName("book");
            for (let j = 0; j < otherBooks.length; j++) {
                if (otherBooks[j] !== currentBook) {
                    otherBooks[j].classList.remove("flipped");
                }
            }
        }
    });
}

// Example function for draw folder links
function drawFolderLinks() {
    let folderContainer = document.getElementById("folderContainer");
    let allFolders = document.getElementsByClassName("folder");
    let folderIDs = [];
    for (let i = 0; i < allFolders.length; i++) {
        folderIDs.push(allFolders[i].id);
    };
    for (let i = 0; i < folderIDs.length; i++) {
        let p = document.createElement("p");
        p.classList.add("folderLink");
        p.innerHTML = `${folderIDs[i]} <i class="fas fa-folder"></i> <span class="folderCount">X</span>`;
        folderContainer.append(p);
    }
};
drawFolderLinks();

