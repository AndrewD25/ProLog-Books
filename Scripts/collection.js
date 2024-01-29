/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";

//Storage Variables PRE POPULATED EXAMPLE
let folders = {
    "DC": [
        {
            position: 1,
            title: "Green Lantern Rebirth #1",
            subtitle: "DC Comics, Post Crisis",
            image: "../Images/exampleCover.png",
            notes: "This book good.",
            read: "Read",
            Rating: "Great"
        },
        {
            position: 2,
            title: "Green Lantern Rebirth #2",
            subtitle: "DC Comics, Post Crisis",
            image: "https://prodimage.images-bn.com/pimages/2940045386319_p0_v1_s1200x630.jpg",
            notes: "This book good 2.",
            read: "Read",
            Rating: "Great"
        }
    ],
    "Marvel": [
        {
            position: 1,
            title: "Amazing Fantasy #15",
            subtitle: "First Appearance Spider-Man",
            image: "https://m.media-amazon.com/images/I/51ylofh3QmL.jpg",
            notes: "This book good 3.",
            read: "Unread",
            Rating: "---"
        },
    ],
    "Manga": [
        {
            position: 1,
            title: "Blue Lock vol 1",
            subtitle: "Barnes and Noble Exclusive",
            image: "https://prodimage.images-bn.com/pimages/9798888772300_p0_v1_s1200x630.jpg",
            notes: "This book good 4.",
            read: "Read",
            Rating: "Favorite"
        },
    ]
}; //Store all folders from the db into this objet
//Then add the books into the folders as arrays

// Create Variables
let allBooks = document.getElementsByClassName("book");
let folderContainer = document.getElementById("folderContainer"); //This is where folder links are added
let collectionContainer = document.getElementById("collectionContainer"); //This is where actual folders and books are added
let allFolderLinks = document.getElementsByClassName("folderLink");
let allFlipButtons = document.getElementsByClassName("flipButton");
let allAddBookButtons = document.getElementsByClassName("addBookButton");

//Add flip ability to all books REFACTOR INTO DRAW FUNCTION
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

// Draw Elements of the Page on Load
function draw() {
    //Create folders for each key of the folders object
    for (let folderName in folders) {
        //Create the folder divs
        let newFolder = document.createElement("div");
        newFolder.classList.add("folder");
            // ⚠️ ALSO ADD THE HIDDEN CLASS TO EACH FOLDER, ADD CODE AFTER TESTING WITHOUT IT
        newFolder.id = folderName;
        collectionContainer.appendChild(newFolder)

        //Add the folder to the folder links
        let folderBooks = folders[folderName]; //Get the array of books in the folder
        let bookCount = folderBooks.length; //Get count of elements inside array value in folder
        let p = document.createElement("p");
        p.classList.add("folderLink");
        p.innerHTML = `${folderName} <i class="fas fa-folder"></i> <span class="folderCount">${bookCount}</span>`;
        folderContainer.append(p); //Add the folder link to the list

        //Create the books inside each folder
        folderBooks.forEach((book) => {
            //Create book div
            let newBook = document.createElement("div");
            newBook.classList.add("book");

            //Add the cover image
            let coverImg = document.createElement("img");
            coverImg.classList.add("cover");
            coverImg.src = book.image;
            newBook.appendChild(coverImg);

            //Add the details div
            let detailsDiv = document.createElement("div");
            detailsDiv.classList.add("details");
            let titleHeading = document.createElement("h3"); //Create the title
            titleHeading.classList.add("title");
            titleHeading.innerText = book.title;
            detailsDiv.appendChild(titleHeading);
            let subtitleHeading = document.createElement("h4"); //Create the subtitle
            subtitleHeading.classList.add("subtitle");
            subtitleHeading.innerText = book.subtitle;
            detailsDiv.appendChild(subtitleHeading);
            let notesBox = document.createElement("textarea"); //Create notes area
            notesBox.classList.add("notes");
            detailsDiv.appendChild(notesBox);
            // ⚠️ TO-DO: Create the elements for the read and rating selects
            let bottomBtnDiv = document.createElement("div"); //Create div for bottom buttons
            bottomBtnDiv.classList.add("bookBottomButtons");
            let btmLeftBtn = document.createElement("button"); //Move book left btn
            btmLeftBtn.innerHTML = "&lt;";
            bottomBtnDiv.appendChild(btmLeftBtn);
            let btmTrashBtn = document.createElement("button"); //Delete book btn
            btmTrashBtn.innerHTML = `<i class="fa-solid fa-trash"></i>`;
            bottomBtnDiv.appendChild(btmTrashBtn);
            let btmRightBtn = document.createElement("button"); //Move book right btn
            btmRightBtn.innerHTML = "&gt;";
            bottomBtnDiv.appendChild(btmRightBtn);
            detailsDiv.appendChild(bottomBtnDiv);
            newBook.appendChild(detailsDiv);

            //Add the "bookButtons" that are absolute positioned over it

            let flipBtn = document.createElement("button");
            flipBtn.classList.add("bookCircle", "flipButton");
            flipBtn.innerHTML = `<i class="fa-solid fa-arrows-spin"></i>`;
            newBook.appendChild(flipBtn);


            //Append the book to the folder
            newFolder.appendChild(newBook);
        });

        /*
        Temporary Documentation for me for later
        -----------------------------------------
         -- folderName //The name/property of the folders object
         -- folderBooks //The array that stores all the books that go in a folder
         -- bookCount //The amount of books inside a folder
         -- //Maybe use a foreach loop to simplify drawing the books even further
         -- newFolder //This is the div that books from the current folder should be appended into
        */
    }
}
draw(); 

let allFolders = document.getElementsByClassName("folder");

// // Example function for draw folder links
// function drawFolderLinks() {
//     let folderIDs = [];
//     for (let i = 0; i < allFolders.length; i++) {
//         folderIDs.push(allFolders[i].id);
//     };
//     for (let i = 0; i < folderIDs.length; i++) {
//         //Count number of books in each folder
//         let countNumber = Array.from(allFolders[i].children).filter(child => child.classList.contains("book")).length

//         //Create labels
//         let p = document.createElement("p");
//         p.classList.add("folderLink");
//         p.innerHTML = `${folderIDs[i]} <i class="fas fa-folder"></i> <span class="folderCount">${countNumber}</span>`;
//         folderContainer.append(p);
//     }
// };
// // drawFolderLinks();

//Add functionality to folder links REFACTOR INTO DRAW FUNCTION
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