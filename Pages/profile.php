<!--
Andrew Deal
ProLog Books Settings Page HTML
DUE DATE
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Account - ProLog Books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/PLBLogo.png">

        <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../Stylesheets/profile.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body>
        <?php
            // Start the session
            session_start();

            // Check if the username session variable exists and has a value
            if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
                // Redirect the user to the sign-in page
                header("Location: signInPage.php");
                exit(); // Make sure to exit after redirection
            }
        ?>

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
        <h2>Your Profile</h2>
        <div id="profileDisplay">

        </div>

        <h2>Account Settings</h2>
        <div id="settings">

        </div>

        <button id="signOutButton" onclick="signOut()">Sign Out</button>

        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>