<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Under Construction</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
</head>
<body>
    <!--Page Banner with Navlinks at the top of each page-->
    <header id="pageTop">
        <a href="../index.php"><img id="mainLogo" src="../Images/ProLogBooksLogo.png" alt="ProLog Books Logo"></a>

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

    <!--Under Construction page code-->
    <h1 style="text-align: center;">Page Under Construction</h1>
    <p style="width: 90%; text-align: center; margin-left: auto; margin-right: auto; margin-block: 0; font-size: 200px;"><i class="fa-solid fa-person-digging"></i></p>
    <p style="text-align: center;">Please Come Back Soon! 😀</p>
    <a style="display: block; text-align: center; color: white;" href="puzzle.php">In the meantime, check out our puzzle page!</a>

    <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
</body>
</html>