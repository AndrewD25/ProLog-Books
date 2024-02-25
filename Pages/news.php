<!--
Andrew Deal
ProLog Books News Page HTML
DUE DATE
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Articles - ProLog Books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/PLBLogo.png">

        <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../Stylesheets/news.css?v=<?php echo time(); ?>">
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
        <div id="pageTitle">
            <h1>ProLog Books Articles</h1>
        </div>
        <div id="blogColumns">
            <article>
                <a href="Articles/02-01-24.php">
                    <img class="thumbnail" style="background-image: url(https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg);">
                    <div class="data">
                        <h2 class="title">Welcome to<br>ProLog Books</h2>
                        <div class="subData">
                            <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                            <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                        </div>
                    </div>
                </a>
                
            </article>
            <article>
                <a href="Articles/02-01-24.php">
                    <img class="thumbnail" style="background-image: url(https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg);">
                    <div class="data">
                        <h2 class="title">Welcome to<br>ProLog Books</h2>
                        <div class="subData">
                            <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                            <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                        </div>
                    </div>
                </a>
                
            </article>
            <article>
                <a href="Articles/02-01-24.php">
                    <img class="thumbnail" style="background-image: url(https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg);">
                    <div class="data">
                        <h2 class="title">Welcome to<br>ProLog Books</h2>
                        <div class="subData">
                            <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                            <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                        </div>
                    </div>
                </a>
                
            </article>
            <article>
                <a href="Articles/02-01-24.php">
                    <img class="thumbnail" style="background-image: url(https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg);">
                    <div class="data">
                        <h2 class="title">Welcome to<br>ProLog Books</h2>
                        <div class="subData">
                            <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                            <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                        </div>
                    </div>
                </a>
                
            </article>
            <article>
                <a href="Articles/02-01-24.php">
                    <img class="thumbnail" style="background-image: url(https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg);">
                    <div class="data">
                        <h2 class="title">Welcome to<br>ProLog Books</h2>
                        <div class="subData">
                            <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                            <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                        </div>
                    </div>
                </a>
                
            </article>
            <article>
                <a href="Articles/02-01-24.php">
                    <img class="thumbnail" style="background-image: url(https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg);">
                    <div class="data">
                        <h2 class="title">Welcome to<br>ProLog Books</h2>
                        <div class="subData">
                            <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                            <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                        </div>
                    </div>
                </a>
                
            </article>
            <!--End of last article-->
        </div>


        <script src="../Scripts/news.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>