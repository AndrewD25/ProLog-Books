/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";

  ////////////////////
 // Data variables //
////////////////////

let book_to_copy;
function resetBTC() {
    book_to_copy = {
        title: "",
        subtitle: "",
        notes: "",
        image: "",
        format: "---",
        read: "---",
        rating: "---",
    }
    let allCopyButtons = document.getElementsByClassName("copyButton");
    for (let j = 0; j < allCopyButtons.length; j++) {
        allCopyButtons[j].classList.remove("active");
    }
}
resetBTC();

  ////////////////////////////
 // HTML Element Variables //
////////////////////////////

//Left half div
let folderContainer = document.getElementById("folderContainer");

//Right half div
let collectionContainer = document.getElementById("collectionContainer");

//Modal Window Elements
let overlay = document.getElementById("overlay");
const hiddenInput = document.getElementById("storeUsername");

//Folder Elements created in function


  ///////////////
 // Functions //
///////////////

function showModal(id) {
    hideModal();
    clearModalWindows();
    populateModalWindow(id);
    resetBTC();
    const modal = document.getElementById(id);
    modal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hideModal() {
    let modals = document.getElementsByClassName("modal");
    for (let i = 0; i < modals.length; i++) {
        modals[i].classList.add("hidden");
    }
    overlay.classList.add("hidden");
}

function addBook(folder, position) {
    console.log("Ran add book");
}

function folderLinks() {
    let allFolderLinks = document.getElementsByClassName("folderLink");
    let allFolderDivs = document.getElementsByClassName("folder");
    for (let i = 0; i < allFolderLinks.length; i++) {
        allFolderLinks[i].addEventListener("click", function (e) {
            //Replace "newFolder" with the div that has the same id as the text in the folder link
            let id = getFolderId(e.target);
            let newFolder = document.getElementById(id);
            newFolder.classList.remove("hidden");
            for (let j = 0; j < allFolderDivs.length; j++) {
                if (allFolderDivs[j] !== newFolder) {
                    allFolderDivs[j].classList.add("hidden");
                }
            }
        })
    }
}

function getFolderId(linkElement) {
    return linkElement.closest('.folderLink').querySelector(".folderName").innerText;
}

function getBookId(button) {
    return button.closest(".book").id;
}

function deleteFolderButtons() {
    let allFolderDeleters = document.getElementsByClassName("deleteFolder");
    for (let i = 0; i < allFolderDeleters.length; i++) {
        allFolderDeleters[i].addEventListener("click", function (e) {
            let id = getFolderId(e.target);
            document.getElementById("folder_to_delete").value = id;
            showModal("deleteFolderModal");
        })
    }
}

function copyParent(element) {
    let parentBook = element.closest(".book");
    book_to_copy = {
        title: parentBook.querySelector(".title").textContent,
        subtitle: parentBook.querySelector(".subtitle").textContent,
        notes: parentBook.querySelector(".notes").textContent,
        image: parentBook.querySelector(".cover").getAttribute("src"),
        format: parentBook.querySelector(".format").textContent,
        read: parentBook.querySelector(".read").textContent,
        rating: parentBook.querySelector(".rating").textContent,
    }
}

function copyButtons() {
    let allCopyButtons = document.getElementsByClassName("copyButton");
    for (let i = 0; i < allCopyButtons.length; i++) {
        allCopyButtons[i].addEventListener("click", function (e) {
            e.target.closest(".copyButton").classList.toggle("active");

            //Save the book data into the book to copy variable
            copyParent(e.target);

            for (let j = 0; j < allCopyButtons.length; j++) {
                if (allCopyButtons[j] !== e.target.closest(".copyButton")) {
                    allCopyButtons[j].classList.remove("active");
                }
            }
        });
    }
}

function editButtons() {
    let allEditButtons = document.getElementsByClassName("editButton");
    for (let i = 0; i < allEditButtons.length; i++) {
        allEditButtons[i].addEventListener("click", function (e) {
            copyParent(e.target);
            document.getElementById("book_to_edit").value = e.target.closest(".book").id;
            showModal("editBookModal");
        });
    }
}

//Need to refactor
function populateModalWindow(id) {
    if (id === "addBookModal") {
        document.getElementById("title_input").value = book_to_copy.title;
        document.getElementById("subtitle_input").value = book_to_copy.subtitle;
        document.getElementById("notes_input").value = book_to_copy.notes;
        document.getElementById("image_input").value = book_to_copy.image;
        document.getElementById("format_input").value = book_to_copy.format;
        document.getElementById("read_input").value = book_to_copy.read;
        document.getElementById("rating_input").value = book_to_copy.rating;
    } else if (id === "editBookModal") {
        document.getElementById("new_title_input").value = book_to_copy.title;
        document.getElementById("new_subtitle_input").value = book_to_copy.subtitle;
        document.getElementById("new_notes_input").value = book_to_copy.notes;
        document.getElementById("new_image_input").value = book_to_copy.image;
        document.getElementById("new_format_input").value = book_to_copy.format;
        document.getElementById("new_read_input").value = book_to_copy.read;
        document.getElementById("new_rating_input").value = book_to_copy.rating;
    }
}

function clearModalWindows() {
    //Add books
    document.getElementById("title_input").value = "";
    document.getElementById("subtitle_input").value = "";
    document.getElementById("notes_input").value = "";
    document.getElementById("image_input").value = "";
    document.getElementById("format_input").value = "---";
    document.getElementById("read_input").value = "---";
    document.getElementById("rating_input").value = "---";
    //Edit books
    document.getElementById("new_title_input").value = "";
    document.getElementById("new_subtitle_input").value = "";
    document.getElementById("new_notes_input").value = "";
    document.getElementById("new_image_input").value = "";
    document.getElementById("new_format_input").value = "";
    document.getElementById("new_read_input").value = "";
    document.getElementById("new_rating_input").value = "";
    //Also make copy buttons turn off when activating the modal window
}

function flipButtons() {
    let allFlipButtons = document.getElementsByClassName("flipButton");
    for (let i = 0; i < allFlipButtons.length; i++) {
        allFlipButtons[i].addEventListener("click", function (e) {
            const closestFlip = e.target.closest(".flipButton");
            const closestBook = closestFlip.closest(".book");

            //Turn off copy when flipping a book
            if (closestBook.querySelector(".copyButton").classList.contains("active")) {
                resetBTC();
            }

            closestBook.querySelector(".copyButton").classList.remove("active");
            closestBook.classList.toggle("flipped");
        });
    }
}

function deleteBookButtons() {
    let allBookDeleters = document.getElementsByClassName("deleteBook");
    for (let i = 0; i < allBookDeleters.length; i++) {
        allBookDeleters[i].addEventListener("click", function (e) {
            document.getElementById("folder_location2").value = e.target.closest('.folder').id;
            document.getElementById("position2").value = e.target.closest(".book").querySelector(".positionNum").textContent;
            document.getElementById("book_to_delete").value = getBookId(e.target);
            showModal("deleteBookModal");        
        })
    }
}

  ///////////////////
 // Running Logic //
///////////////////

//Add event listeners by running element functions
folderLinks();
deleteFolderButtons();
deleteBookButtons();
editButtons();
copyButtons();
flipButtons();

overlay.onclick = hideModal;