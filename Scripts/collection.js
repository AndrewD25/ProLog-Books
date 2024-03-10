/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

"use strict";

  ////////////////////
 // Data variables //
////////////////////



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

function flipButtons() {
    let allFlipButtons = document.getElementsByClassName("flipButton");
    for (let i = 0; i < allFlipButtons.length; i++) {
        allFlipButtons[i].addEventListener("click", function (e) {
            const closestFlip = e.target.closest(".flipButton");
            const closestBook = closestFlip.closest(".book");
            closestBook.classList.toggle("flipped");
        });
    }
}

  ///////////////////
 // Running Logic //
///////////////////

//Add event listeners by running element functions
folderLinks();
deleteFolderButtons();
flipButtons();


overlay.onclick = hideModal;