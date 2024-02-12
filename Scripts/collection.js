/*
Andrew Deal
Capstone Project Collection Page Script
Due Date
*/

/*
High priority to do:
 - Button for adding books when none are in there
 - Add images to the add book modal
 - make the copy button highlight when it is clicked
 - make the delete button functional
 - get database and web hosting set up
*/

"use strict";

  ////////////////////
 // Data variables //
////////////////////

let username;
if (localStorage.getItem("username") !== null) {
    username = localStorage.getItem("username");
}
let password; //Might delete later

//User collection is an object that has folders as its properties which each hold an array of books
let collection;
// collection  = { "Example": [{title: "", subti...}, {}, {}], "Ex2": [] }

//Test collection data
let testData = {
    "DC": [
        {
            title: "Batman #129",
            subtitle: "DC Comics, Dawn of DC",
            image: "https://s3.amazonaws.com/comicgeeks/comics/covers/large-4298766.jpg?1688842554",
            notes: "Start of Failsafe arc",
            read: "Read",
            Rating: "Good"
        },
        {
            title: "Green Lantern Rebirth #1",
            subtitle: "DC Comics, Post Crisis",
            image: "../Images/exampleCover.png",
            notes: "This book good.",
            read: "Read",
            Rating: "Great"
        },
        {
            title: "Green Lantern Rebirth #2",
            subtitle: "DC Comics, Post Crisis",
            image: "https://prodimage.images-bn.com/pimages/2940045386319_p0_v1_s1200x630.jpg",
            notes: "This book good 2.",
            read: "Read",
            Rating: "Great"
        },
        {
            title: "Superman Secret Identity",
            subtitle: "Andrew's Favorite Book",
            image: "https://upload.wikimedia.org/wikipedia/en/4/4d/Superman-secretidentity1.jpg",
            notes: "Peak fiction",
            read: "Read",
            Rating: "Favorite"
        }
    ],
    "Manga": [
        {
            title: "Blue Lock vol 1",
            subtitle: "Barnes and Noble Exclusive",
            image: "https://prodimage.images-bn.com/pimages/9798888772300_p0_v1_s1200x630.jpg",
            notes: "This book good 4.",
            read: "Read",
            Rating: "Favorite"
        },
        {
            title: "Kaiju No. 8 vol 8",
            subtitle: "Funny volume",
            image: "https://prodimage.images-bn.com/pimages/9781974740628_p0_v1_s1200x630.jpg",
            notes: "",
            read: "Read",
            Rating: "Great"
        },
        {
            title: "Kaguya Sama vol 1",
            subtitle: "Love is War",
            image: "https://m.media-amazon.com/images/I/61EP4kOgxyL._AC_UF1000,1000_QL80_.jpg",
            notes: "",
            read: "Read",
            Rating: "Great"
        },
    ],
    "Marvel": [
        {
            title: "Amazing Fantasy #15",
            subtitle: "First Appearance Spider-Man",
            image: "https://m.media-amazon.com/images/I/51ylofh3QmL.jpg",
            notes: "This book good 3.",
            read: "Unread",
            Rating: "---"
        },
        {
            title: "Amazing Spider-Man by Nick Spencer Omnibus",
            subtitle: "Testing a long name",
            image: "https://m.media-amazon.com/images/I/51Msd0CX31L.jpg",
            notes: "Good spidey writing.",
            read: "Read",
            Rating: "---"
        },
    ],
}; //Store all folders from the db into this objet
//Then add the books into the folders as arrays

let newBookData = { //Used to save data when pulling up modal window
    folderArray: null, //The array the book will be added to
    index: null //The index to add the book at
}
let copy = false; //For copying book details into the target modal
let parentBook; //Used to save a copied book

  ////////////////////////////
 // HTML Element Variables //
////////////////////////////

//Left half div
let folderContainer = document.getElementById("folderContainer");

//Right half div
let collectionContainer = document.getElementById("collectionContainer");

//Button to pull up sign in modal
let startSignInBtn = document.getElementById("startSignInButton");

//SignIn Modal
let signInModal = document.getElementById("signInModal");
let usernameInput = document.getElementById("usernameInput");
let passwordInput = document.getElementById("passwordInput");
let signInBtn = document.getElementById("signInButton")
let cancelSignInBtn = document.getElementById("cancelSignIn");

//Add Books Modal
let addBookModal = document.getElementById("addBookModal");
let addBookToCollectionBtn = document.getElementById("addBookToCollectionButton");
let cancelAddBookBtn = document.getElementById("cancelAddBookButton");

//Modal Window Overlay
let overlay = document.getElementById("overlay");


  ///////////////
 // Functions //
///////////////

function signInCheck() {
    if (username == undefined) {
        console.log("User is signed out");
    } else {
        //Not looking for "username" key, but the key that corresponds to their username
        if (localStorage.getItem(username) !== null) {
            loadData();
        }
        draw();
    }
}

function signIn() {
    //Check if fields are filled in
    if (usernameInput.value == "" || passwordInput.value == "") {
        alert("Username and Password cannot be empty");
        return;
    }

    //SignIn Functionality
    username = usernameInput.value;
    localStorage.setItem("username", username);

    //Refresh the page
    location.reload();
}

function saveData() {
    localStorage.setItem(username, JSON.stringify(collection));
}

function loadData() {
    collection = JSON.parse(localStorage.getItem(username));
    
}

function showSignInModal() {
    signInModal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hideSignInModal() {
    signInModal.classList.add('hidden');
    overlay.classList.add("hidden");
    //Clear text in all input fields
    let inputs = signInModal.querySelectorAll('input, textarea');
    inputs.forEach(function(input) {
        input.value = '';
    });
}

function showAddBookModal() {
    addBookModal.classList.remove('hidden');
    overlay.classList.remove("hidden");
}

function hideAddBookModal() {
    addBookModal.classList.add("hidden");
    overlay.classList.add("hidden");
    //Clear all text in all children of the modal
    copy = false;
    parentBook = null;
    let inputs = addBookModal.querySelectorAll('input, textarea');
    inputs.forEach(function(input) {
        input.value = '';
    });
    let selects = addBookModal.querySelectorAll('select');
    selects.forEach(function(select) {
        select.value = '---';
    });
}

//Add user data to the page
function draw() {
    //Reset page before drawing new content
    folderContainer.innerHTML = "";
    collectionContainer.innerHTML = "";

    for (let folderName in collection) {
        //Instantiate variables
        //folderName: the property of the collection object that leads to a key with data inside
        let folderBooks = collection[folderName]; //Get the array of books in the folder
        let bookCount = folderBooks.length; //Get count of elements inside array value in folder

        //Create the folders
        drawFolder(folderName, bookCount);

        //Create the books inside the folders
        folderBooks.forEach((book, index) => {
            drawBook(book, folderName, index);
        });
    }
}

//Create a folder div and link
function drawFolder(name, count) {
    //Create the folder divs
    let newFolder = document.createElement("div");
    newFolder.classList.add("folder", "hidden");
    newFolder.id = name;
    collectionContainer.appendChild(newFolder)

    //Create the folder links
    let p = document.createElement("p");
    p.classList.add("folderLink");
    p.innerHTML = `${name} <i class="fas fa-folder"></i> <span class="folderCount">${count}</span>`;
    p.addEventListener("click", function () {
        let allFolders = document.getElementsByClassName("folder");
        newFolder.classList.remove("hidden");
        for (let j = 0; j < allFolders.length; j++) {
            if (allFolders[j] !== newFolder) {
                allFolders[j].classList.add("hidden");
            }
        }
    }) 
    folderContainer.append(p); //Add the folder link to the list
}

//Create a book element
function drawBook(book, folder, index) {
    let arrayIn = collection[folder];
    let folderDiv = document.getElementById(String(folder));

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
    notesBox.value = book.notes;
    detailsDiv.appendChild(notesBox);
    let selectBoxDiv = document.createElement("div"); //Create box for selects (read + rating)
    selectBoxDiv.classList.add("selectBox");
    let readSelect = document.createElement("select"); //Create the select element for read
    readSelect.classList.add("read");
    readSelect.innerHTML = `<option>---</option><option>Unread</option><option>Reading</option><option>Read</option>`;
    selectBoxDiv.appendChild(readSelect);
    let ratingSelect = document.createElement("select"); //Create the select element for rating
    ratingSelect.classList.add("rating");
    ratingSelect.innerHTML = `<option>---</option><option>Unhaul</option><option>Meh</option><option>Good</option><option>Great</option><option>Favorite</option>`;
    selectBoxDiv.appendChild(ratingSelect);
    detailsDiv.appendChild(selectBoxDiv);
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
    let addBookBeforeBtn = document.createElement("button");
    addBookBeforeBtn.classList.add("bookCircle", "addBookButton", "before");
    addBookBeforeBtn.innerHTML = "+";
    newBook.appendChild(addBookBeforeBtn);
    let positionNumDiv = document.createElement("div");
    positionNumDiv.classList.add("bookCircle", "positionNum");
    positionNumDiv.innerHTML = String(index + 1);
    newBook.appendChild(positionNumDiv);
    let editBtn = document.createElement("div");
    editBtn.classList.add("bookCircle", "editButton");
    editBtn.innerHTML = `<i class="fa-solid fa-pencil"></i>`;
    newBook.appendChild(editBtn);
    let copyBtn = document.createElement("button");
    copyBtn.classList.add("bookCircle", "copyButton");
    copyBtn.innerHTML = `<i class="fa-solid fa-copy"></i>`;
    copyBtn.addEventListener("click", function(e) {
        copy = true;
        parentBook = e.target.closest(".book");
    })
    newBook.appendChild(copyBtn);
    let flipBtn = document.createElement("button");
    flipBtn.classList.add("bookCircle", "flipButton");
    flipBtn.innerHTML = `<i class="fa-solid fa-arrows-spin"></i>`;
    flipBtn.addEventListener("click", function(e) { //Make Books flippable
        let currentBook = e.target.closest('.book');
        if (currentBook) {
            // Toggle the 'flipped' class on the found book
            currentBook.classList.toggle("flipped");

            //Always turn off copy when a book is flipped
            copy = false;
            parentBook = null;

            //Remove 'flipped' from other books
            let flippedBooks = document.getElementsByClassName("flipped");
            for (let j = 0; j < flippedBooks.length; j++) {
                if (flippedBooks[j] !== currentBook) {
                    flippedBooks[j].classList.remove("flipped");
                }
            }
        }
    })
    newBook.appendChild(flipBtn);
    let addBookAfterBtn = document.createElement("button");
    addBookAfterBtn.classList.add("bookCircle", "addBookButton", "after");
    addBookAfterBtn.innerHTML = "+";
    newBook.appendChild(addBookAfterBtn);
    //Make on book buttons functional
    let addBookButtons = [addBookBeforeBtn, addBookAfterBtn];
    for (let i = 0; i < 2; i++) {
        addBookButtons[i].addEventListener("click", function() {
            let currentIndex = arrayIn.indexOf(book);
            //Start book index -> index
            let newIndex = i < 1 ? currentIndex : currentIndex + 1; //Add before = true = 1 less than index, add after = false = 1 more than index
            //The array of books is called folderBooks
            //Save the data into the newBookData variable
            newBookData.folderArray = arrayIn;
            newBookData.index = newIndex;

            showAddBookModal(); //Bring up the modal window
            
            //Check if the copy button is on
            if (copy) {
                modalTitle.value = parentBook.querySelector('.details .title').innerText; //copy the title
                modalSubtitle.value = parentBook.querySelector('.details .subtitle').innerText; //copy the subtitle
                modalNotes.value = parentBook.querySelector('.details .notes').value; //copy the notes
                modalRead.value = parentBook.querySelector('.details .read').value; //copy the read value
                modalRating.value = parentBook.querySelector('.details .rating').value; //copy the rating
            }
        })
    }

    //Append the book to the folder
    folderDiv.appendChild(newBook);
}

function addBook() {
    let newBookObject = {
        title: modalTitle.value,
        subtitle: modalSubtitle.value,
        image: "../Images/altImg.jpg", //Replace later
        notes: modalNotes.value,
        read: modalRead.value,
        Rating: modalRating.value
    }
    //Add the newBookObject to the array
    if (Array.isArray(newBookData.folderArray) && Number.isInteger(newBookData.index) && newBookData.index >= 0) {
        // Ensure that the index is within the bounds of the array
        if (newBookData.index <= newBookData.folderArray.length) {
            // Use splice to insert the new book at the specified index
            newBookData.folderArray.splice(newBookData.index, 0, newBookObject);
            console.log("Book added successfully!");
        } else {
            console.error("Index is out of bounds.");
        }
    } else {
        console.error("Invalid input data.");
    }
    hideAddBookModal();

    //Call draw function to redraw page
    draw();
}

  ///////////////////////////////////////
 // Onclicks and On Startup Functions //
///////////////////////////////////////

startSignInBtn.onclick = showSignInModal;
signInBtn.onclick = signIn;
cancelSignInBtn.onclick = hideSignInModal;
addBookToCollectionBtn.onclick = addBook;
cancelAddBookBtn.onclick = hideAddBookModal;

signInCheck();


