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
        <?php
            // Start the session
            session_start();

            // Store the current page's URL in a session variable
            $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];

            //My google books api key : key=AIzaSyBnGRxwvJL-zDN5YgE0Z6ZhWPMg_BCG_rE

            // Redirect the user to sign in if they are logged out
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
                // Redirect the user to the sign-in page
                header("Location: /Pages/signInPage.php");
                exit(); // Make sure to exit after redirection
            } else {
                include_once 'Includes/connect.php';
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
                $query = "SELECT username FROM Users WHERE user_id = '$user_id'";
                $results = mysqli_query($conn, $query);

                if (mysqli_num_rows($results) > 0) {
                    $row = mysqli_fetch_assoc($results);
                    $username = $row['username'];
                }
            }
        ?>

       <!--Page Banner with Navlinks at the top of each page-->
       <?php 
            include_once 'Includes/header.php'; 
        ?>

        <!--Rest of Page Code-->
        <div id="folderContainer"> 
            <p id="addFolderLink" onclick="showModal('addFolderModal')">Add Folder +</p>

            <!--Add Folders With PHP-->
            <?php
                $stmt = $conn->prepare("SELECT * FROM Folders WHERE user_id = ? ORDER BY folder_name");
                $stmt->bind_param("s", $user_id);
                $stmt->execute();
                $folders = $stmt->get_result();

                $collection = [];

                if ($folders->num_rows >= 1) {
                    while ($folder = $folders->fetch_assoc()) {
                        $collection[$folder['folder_name']] = []; //Here

                        //Store books into the folder array
                        $stmt_books = $conn->prepare("SELECT * FROM Books WHERE user_id = ? AND folder_name = ? ORDER BY position_id ASC");
                        $stmt_books->bind_param("ss", $user_id, $folder['folder_name']);
                        $stmt_books->execute();
                        $books_result = $stmt_books->get_result();
                        if ($books_result->num_rows >= 1) {
                            while ($book_row = $books_result->fetch_assoc()) {
                                // Append each book row to the folder array
                                $collection[$folder['folder_name']][] = $book_row;
                            }
                        }

                        echo '<p class="folderLink"><span class="folderName">' . $folder['folder_name'] . 
                        '</span> <i class="fas fa-folder"></i>  <span class="folderCount">' . $books_result->num_rows . '</span>
                        <i class="deleteFolder fa-solid fa-trash"></i></p>';
                    }
                } else {
                    echo '<p>You don\'t have any saved folders. Start by adding one with the button above!</p>';
                }
            ?>
            <a href="https://readrover.netlify.app" class="readRoverLink" target="_blank"><img src="../Images/RR.jpg"></a>
            <!-- <p class="folderLink">DC Comics <i class="fas fa-folder"></i> <span class="folderCount">X</span></p> -->
        </div>
        
        <div id="collectionContainer">
            <?php
                foreach ($collection as $folder_name => $books) {

                    // Create a div element for each folder with its name as the id
                    echo '<div class="folder hidden" id="' . $folder_name . '">';

                        // Loop through each book in the $books array
                        foreach ($books as $book) {
                            // Echo the book with its details
                            echo '<div class="book" id="' . $book["book_id"] . '">
                                <img class="cover" src="' . $book["image_url"] . '" alt="$book["title"]" onerror="this.src=`../Images/altImg.jpg`;">
                                <div class="details">
                                    <p class="book_id" style="display: none;">' . $book["book_id"] . '</p>
                                    <h3 class="title">' . $book["title"] . '</h3>
                                    <h4 class="subtitle">' . $book["subtitle"] . '</h4>
                                    <p class="notes">' . $book["notes"] . '</p>
                                    <div>
                                        <p class="selectLabel">Format: </p>
                                        <p class="format">' . $book["format"] . '</p>
                                    </div>
                                    <div>
                                        <p class="selectLabel">Read: </p>
                                        <p class="read">' . $book["read_status"] . '</p>
                                    </div>
                                    <div>
                                        <p class="selectLabel">Rating: </p>
                                        <p class="rating">' . $book["rating"] . '</p>
                                    </div>
                                    <div class="bookBottomButtons">
                                        <button>&lt;</button>
                                        <button class="deleteBook"><i class="fa-solid fa-trash"></i></button>
                                        <button>&gt;</button>
                                    </div>
                                </div>

                                <button class="bookCircle addBookButton before">+</button>
                                <div class="bookCircle positionNum">' . $book["position_id"] . '</div>
                                <div class="bookCircle editButton"><i class="fa-solid fa-pencil"></i></div>
                                <button class="bookCircle copyButton"><i class="fa-solid fa-copy"></i></button>
                                <button class="bookCircle flipButton"><i class="fa-solid fa-arrows-spin"></i></button>
                                <button class="bookCircle addBookButton after">+</button>

                            </div>';
                        }

                        // Append the button for each folder
                        echo '<button class="appendBook">+</button>
                    </div>';
                }
                echo '<script>
                    //Script to make append book button work
                    let allAppendBooks = document.getElementsByClassName("appendBook");
                    for (let i = 0; i < allAppendBooks.length; i++) {
                        allAppendBooks[i].addEventListener("click", function (e) {
                            let buttonClicked = e.target;
                            let currentFolder = buttonClicked.closest(".folder");
                            showModal("addBookModal");
                            document.getElementById("folder_location").value = currentFolder.id;
                            document.getElementById("position").value = currentFolder.childElementCount;
                        });
                    }

                    //Script to make add book buttons work
                    let allABBs = document.getElementsByClassName("addBookButton");
                    for (let i = 0; i < allABBs.length; i++) {
                        allABBs[i].addEventListener("click", function (e) {
                            let buttonClicked = e.target;
                            let bookPosition = buttonClicked.closest(".book").querySelector(".positionNum").innerText;
                            let currentFolder = buttonClicked.closest(".folder");
                            showModal("addBookModal");
                            document.getElementById("folder_location").value = currentFolder.id;
                            //Set position based on current books position
                            if (buttonClicked.classList.contains("before")) {console.log("Before");
                                document.getElementById("position").value = bookPosition; //This will not work until I update the transaction
                            } else if (buttonClicked.classList.contains("after")) {
                                document.getElementById("position").value = parseInt(bookPosition) + 1;
                            } else {
                                console.log("Could not find a before or after class");
                            }
                        });
                    }
                </script>'
            ?>
            
        </div>

        <!--Modal Window Elements-->
        <!--Add folder modal-->
        <div class="modal hidden" id="addFolderModal">
            <h1>Add New Folder</h1>
            <form action="Includes/addFolder.php" method="post">
                <input type="text" id="folder_name" name="folder_name" maxlength="30" required placeholder="Enter Folder Name">
                <input type="hidden" id="storeUserId" name="storeUserId" value="<?php echo $user_id ?>">
                <div style="min-width: 45%; display: flex; justify-content: space-between;">
                    <button type="button" class="cancel" onclick="hideModal()">Cancel</button>
                    <input type="submit" value="Add Folder">
                </div>
            </form>
        </div>

        <!--Delete folder modal-->
        <div class="modal hidden" id="deleteFolderModal">
            <h1>Delete Folder?</h1>
            <h2>⚠️ Deleting this folder will delete all books inside it from your collection.</h2>
            <form action="Includes/deleteFolder.php" method="post">
                <input type="hidden" id="folder_to_delete" name="folder_to_delete" required>
                <input type="hidden" id="storeUserId2" name="storeUserId" value="<?php echo $user_id ?>">
                <div style="min-width: 45%; display: flex; justify-content: space-between;">
                    <button type="button" class="cancel" onclick="hideModal()">Cancel</button>
                    <input type="submit" value="Delete Folder">
                </div>
            </form>
        </div>

        <!--Add book modal-->
        <div class="modal hidden" id="addBookModal">
            <h1>Add Book</h1>
            <form action="Includes/addBook.php" method="post">

                <input type="hidden" name="folder_location" id="folder_location" value="">
                <input type="hidden" name="position" id="position" value=""> 

                <div>
                    <label for="title_input">Title: </label>
                    <input type="text" placeholder="Example Vol 1: Title" name="title_input" id="title_input" maxlength="100">
                </div>
                <p class="smallText">A title may include a series, number, and/or name</p>

                <div>
                    <label for="subtitle_input">Subtitle: </label>
                    <input type="text" placeholder="Published By X" name="subtitle_input" id="subtitle_input" maxlength="50">
                </div>
                <p class="smallText">A subtitle may include publisher or continuity</p>

                <div>
                    <label for="image_input">Image: </label>
                    <input type="text" placeholder=".jpg, .png" name="image_input" id="image_input" value=""> 
                </div>
                <p class="smallText">Right click an image and select "Copy Image Address"</p>

                <div>
                    <label for="notes_input">Notes: </label>
                    <input type="text" placeholder="This book is..." name="notes_input" id="notes_input" maxlength="255">
                </div>
                <p class="smallText">Information about the book - or leave a review!</p>

                <div>
                   <label for="format">Format: </label>
                    <select name="format_input" id="format_input">
                        <option>---</option>
                        <option>Comic Single</option>
                        <option>Paperback</option>
                        <option>Hardcover</option>
                        <option>Compendium</option>
                        <option>Omnibus</option>
                        <option>Manga</option>
                        <option>Manhwa</option>
                        <option>Other</option>
                    </select> 
                </div>

                <div>
                   <label for="read_input">Read: </label>
                    <select name="read_input" id="read_input">
                        <option>---</option>
                        <option>Unread</option>
                        <option>Reading</option>
                        <option>Read</option>
                    </select> 
                </div>
                
                <div>
                    <label for="rating_input">Rating: </label>
                    <select name="rating_input" id="rating_input">
                        <option>---</option>
                        <option>Unhaul</option>
                        <option>Meh</option>
                        <option>Good</option>
                        <option>Great</option>
                        <option>Favorite</option>
                    </select>
                </div>
                
                <input type="hidden" id="storeUserId3" name="storeUserId" value="<?php echo $user_id ?>">
                <div style="min-width: 45%; display: flex; justify-content: space-between;">
                    <button type="button" class="cancel" onclick="hideModal()">Cancel</button>
                    <input type="submit" value="Add Book">
                </div>
            </form>
        </div>

        <!--Delete book modal-->
        <div class="modal hidden" id="deleteBookModal">
            <h1>Delete Book?</h1>
            <h2>⚠️ There is no way to undo this action.</h2>
            <form action="Includes/deleteBook.php" method="post">
                <input type="hidden" name="folder_location" id="folder_location2" value="">
                <input type="hidden" name="position" id="position2" value=""> 
                <input type="hidden" id="book_to_delete" name="book_to_delete" required>
                <input type="hidden" id="storeUserId4" name="storeUserId" value="<?php echo $user_id ?>">
                <div style="min-width: 45%; display: flex; justify-content: space-between;">
                    <button type="button" class="cancel" onclick="hideModal()">Cancel</button>
                    <input type="submit" value="Delete Book">
                </div>
            </form>
        </div>

        <!-- Edit book modal -->
        <div class="modal hidden" id="editBookModal">
            <h1>Edit Book</h1>
            <form action="Includes/editBook.php" method="post">

                <input type="hidden" id="book_to_edit" name="book_to_edit" required>

                <div>
                    <label for="new_title_input">Title: </label>
                    <input type="text" placeholder="Example Vol 1: Title" name="title_input" id="new_title_input" maxlength="100">
                </div>
                <p class="smallText">A title may include a series, number, and/or name</p>

                <div>
                    <label for="new_subtitle_input">Subtitle: </label>
                    <input type="text" placeholder="Published By X" name="subtitle_input" id="new_subtitle_input" maxlength="50">
                </div>
                <p class="smallText">A subtitle may include publisher or continuity</p>

                <div>
                    <label for="new_image_input">Image: </label>
                    <input type="text" placeholder=".jpg, .png" name="image_input" id="new_image_input" value=""> 
                </div>
                <p class="smallText">Right click an image and select "Copy Image Address"</p>

                <div>
                    <label for="new_notes_input">Notes: </label>
                    <input type="text" placeholder="This book is..." name="notes_input" id="new_notes_input" maxlength="255">
                </div>
                <p class="smallText">Information about the book - or leave a review!</p>

                <div>
                   <label for="new_format">Format: </label>
                    <select name="format_input" id="new_format_input">
                        <option>---</option>
                        <option>Comic Single</option>
                        <option>Paperback</option>
                        <option>Hardcover</option>
                        <option>Compendium</option>
                        <option>Omnibus</option>
                        <option>Manga</option>
                        <option>Manhwa</option>
                        <option>Other</option>
                    </select> 
                </div>

                <div>
                   <label for="new_read_input">Read: </label>
                    <select name="read_input" id="new_read_input">
                        <option>---</option>
                        <option>Unread</option>
                        <option>Reading</option>
                        <option>Read</option>
                    </select> 
                </div>
                
                <div>
                    <label for="new_rating_input">Rating: </label>
                    <select name="rating_input" id="new_rating_input">
                        <option>---</option>
                        <option>Unhaul</option>
                        <option>Meh</option>
                        <option>Good</option>
                        <option>Great</option>
                        <option>Favorite</option>
                    </select>
                </div>
                
                <input type="hidden" id="storeUserId5" name="storeUserId" value="<?php echo $user_id ?>">

                <div style="min-width: 50%; display: flex; justify-content: space-between;">
                    <button type="button" class="cancel" onclick="hideModal()">Cancel</button>
                    <input type="submit" value="Save Changes">
                </div>
            </form>
        </div>

        
        <div class="overlay hidden" id="overlay"></div>
        
        <script src="../Scripts/collection.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>