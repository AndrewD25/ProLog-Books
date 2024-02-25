<!--
Andrew Deal
ProLog Books Collection Page HTML
DUE DATE
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Collection - ProLog Books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/PLBLogo.png">

        <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../Stylesheets/collection.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body>
        <!--Page Banner with Navlinks at the top of each page-->
        <header id="pageTop">
            <a href="../index.php"><img id="mainLogo" src="../Images/PLBLogo.png"></a>

            <!--Navigation Links-->
            <nav>
                <li><a href="../index.php"><i class="fas fa-home" title="Home"></i> <span>Home</span></a></li>
                <li><a href="collection.php"><i class="fa-solid fa-book" title="Collection"></i> <span>Collection</span></a></li>
                <li><a href="social.php"><i class="fa-solid fa-people-arrows" title="Social"></i> <span>Social</span></a></li>
                <li><a href="news.php"><i class="fa-solid fa-newspaper" title="News"></i> <span>News</span></a></li>
                <li><a href="puzzle.php"><i class="fa-solid fa-puzzle-piece" title="Play Comicle"></i> <span>Play Comicle</span></a></li>
                <li id="accountLi"><a><i class="fa-solid fa-user"></i> <span>Account</span></a>
                    <div id="accountMenu" class="hidden dropdown">
                        <ul>
                            <li><a href="signUp.php">Sign Up</a></li>
                            <li><a href="signInPage.php">Sign In</a></li>
                            <li><a href="profile.php">Profile</a></li>
                            <li><a>Sign Out</a></li>
                        </ul>
                    </div>
                </li>
            </nav>
        </header>

        <!--Rest of Page Code-->
        
            <div id="folderContainer"> 
                <!-- <p id="addFolderLink">Add a new folder +</p> -->
                <!--Folders are now added via javascript - example of html folder format below-->
                <!-- <p class="folderLink">DC Comics <i class="fas fa-folder"></i> <span class="folderCount">X</span></p> -->
            </div>
            
            <div id="collectionContainer">
                <button id="startSignInButton">Sign In</button>
                
                <!--<div class="folder" id="DC Comics">
                    
                    EXAMPLE OF A BOOK 
                        <div class="book"> Can be flipped 
                        <img class="cover" src="../Images/exampleCover.png"> 
                        <div class="details"> When not flipped: display-none
                            These are the current book details. May change over time
                            Maybe make some details optional
                            <h3 class="title">Green Lantern: Rebirth</h3>
                            <h4 class="subtitle">DC Comics - Post-Crisis</h4>
                            <textarea class=notes></textarea>
                            <div class="selectBox">
                                <select class="read">
                                    <option>---</option>
                                    <option>Unread</option>
                                    <option>Reading</option>
                                    <option>Read</option>
                                </select>
                                <select class="rating">
                                    <option>---</option>
                                    <option>Unhaul</option>
                                    <option>Meh</option>
                                    <option>Good</option>
                                    <option>Great</option>
                                    <option>Favorite</option>
                                </select>
                            </div>
                            <div class="bookBottomButtons">
                                <button>&lt;</button>
                                <button><i class="fa-solid fa-trash"></i></button>
                                <button>&gt;</button>
                            </div>
                        </div>
                        Absolute Positioned Book Buttons
                        <button class="bookCircle addBookButton before">+</button>
                        <div class="bookCircle positionNum">1</div>
                        <div class="bookCircle editButton"><i class="fa-solid fa-pencil"></i></div>
                        <button class="bookCircle copyButton"><i class="fa-solid fa-copy"></i></button>
                        <button class="bookCircle flipButton"><i class="fa-solid fa-arrows-spin"></i></button>
                        <button class="bookCircle addBookButton after">+</button>
                    </div>
                </div>-->
                
            </div>



        <!--Modal Window Elements-->
        <div class="modal hidden" id="addBookModal">
            <h1>Add Book</h1>
            <div>
                <label>Title: </label>
                <input type="text" id="modalTitle">
                <p class="smallText">A title may include a series, number, and/or name</p>
            </div>
            <div>
                <label>Subtitle: </label>
                <input type="text" id="modalSubtitle">
                <p class="smallText">A subtitle may include publisher or continuity</p>
            </div>
            <div>
                <label>Notes: </label>
                <textarea class="" id="modalNotes"></textarea>
                <p class="smallText">Information about the book - or leave a review!</p>
            </div>
            <div>
                <label>Read: </label>
                <select id="modalRead">
                    <option>---</option>
                    <option>Unread</option>
                    <option>Reading</option>
                    <option>Read</option>
                </select>
            </div>
            <div>
                <label>Rating: </label>
                <select id="modalRating">
                    <option>---</option>
                    <option>Unhaul</option>
                    <option>Meh</option>
                    <option>Good</option>
                    <option>Great</option>
                    <option>Favorite</option>
                </select>
            </div>
            <div>
                <label>Image URL: </label>
                <input type="text" id="modalImageText">
                <!--Currently hidden-->
                <input class="hidden" type="file" id="modalImageFile" accept="image/png, image/jpeg">
                <p class="smallText hidden">File selected:</p>
            </div>
            <button id="addBookToCollectionButton" onclick="addBook()">Add Book</button>
            <button id="cancelAddBookButton">Cancel</button>
        </div>            

        <div class="modal hidden" id="signInModal">
            <label for="usernameInput">Username:</label>
            <input type="text" name="usernameInput" id="usernameInput">
            <label for="passwordInput">Password:</label>
            <input type="password" name="passwordInput" id="passwordInput">
            <div>
                <button id="signInButton">Sign In</button>
                <button id="cancelSignIn">Cancel</button>
            </div>
        </div>

        <div class="overlay hidden" id="overlay"></div>
        

        <script src="../Scripts/collection.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>