<!--
Andrew Deal
Secret Shelf Home Page HTML
DUE DATE
-->

<!--REMEMBER TO UPDATE HTML OF OTHER PAGES AS TOP LINKS PAGE HTML CHANGES-->

<!DOCTYPE html>
<html>
    <head>
        <title>ProLog Books: Organize and Share Your Books Online</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="Images/PLBLogo.png">

        <link rel="stylesheet" href="Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="Stylesheets/home.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

        <style>
            /*Using in-file css to keep only the background cached*/
            body {
                background-image: url("../Images/comicBackgroundBlurred.jpg");
                background-size: 300% auto; /*Background for mobile version*/
                background-repeat: repeat-y; /* Repeat vertically */
            }

            @media only screen and (min-width: 1100px) {
                body {
                    background-size: 100% auto; /*Set background for pc version*/
                }
            }
        </style>
    </head>
    <body>
        <!--Page Banner with Navlinks at the top of each page-->
        <?php 
            include_once 'Pages/Includes/header.php'; 
        ?>

        <!--Rest of Page Code-->
        <div id="landingBox">
            <h1 id="homeTitle">Welcome to ProLog Books!</h1>
            <p>This program is designed to help you inventory your books and share your collection with others with
                similar interests. Use our collection manager feature to organize your books and keep track of your collection, 
                reading order, and personal thoughts. Our social features help you create a personalized profile to share
                the things you consider important from your collection. You can also check out our blog/news page and
                our daily puzzle game, Comicle, for more fun with the books you love!
            </p>
        </div>

        <div class="info leftBox">
            <div class="previewImage"><img src="Images/startHerePreview.jpg?v=<?php echo time(); ?>"></div>
            <div class="infoText">
                <h2>Create an Acount!</h2>
                <p>
                    If this is your first time on ProLog books, start here! We require you to create an account and sign in to use some of our features in order to avoid bot spam
                    and keep bandwidth down to create the best experience for you. Don't worry, it's completely free to sign up! Head to our <a href="Pages/signUp.php">Sign Up</a>
                    page to get started. Then check out everything we have to offer at ProLog Books! Not ready to do that yet or already done? Then you should check out our article at
                    <a href="Pages/article.php?id=1">ProLog Books News</a> on how to get started with our site! Or check out our <a target="_blank" href="userman.pdf">User Manual</a>! 
                    We hope you enjoy seeing all we have to offer!
                </p>
            </div>
        </div>

        <div class="info rightBox">
            <div class="infoText">
                <h2>Log Your Collection!</h2>
                <p>On the <a href="Pages/construction.php">Collection</a> page, keep an inventory of all your books. The books stay in the order you add them so you 
                can use it to keep track of reading order. Store titles, publishers, notes, ratings, and any other information you want!    </p>
            </div>
            <div class="previewImage"><img src="Images/collectionPagePreview.jpg?v=<?php echo time(); ?>"></div>
        </div>

        <div class="info leftBox">
            <div class="previewImage"><img src="Images/unfinishedPreview.jpg?v=<?php echo time(); ?>"></div>
            <div class="infoText">
                <h2>Share Your Shelf!</h2>
                <p>Our <a href="Pages/construction.php">Social</a> page is the best place to connect with other book lovers! Create a profile that 
                shows off your favorite parts of your collection and share it with others! Then browse the explore section to see featured 
                users for the week. Everyone is welcome to express their personality!</p>
            </div>
        </div>

        <div class="info rightBox">
            <div class="infoText">
                <h2>Stay Connected!</h2>
                <p>Want to spend some time reading instead of managing your books? Check out the <a href="Pages/news.php">News</a> page! Here, you'll 
                find curated articles about all sorts of different things! Articles might include site tutorials, new releases, blog posts, surveys, 
                or even a monthly book suggestion! There's an article for any occasion at ProLog Books News!</p>
            </div>
            <div class="previewImage"><img src="Images/newsPreview.jpg?v=<?php echo time(); ?>"></div>
        </div>

        <div class="info leftBox">
            <div class="previewImage"><img src="Images/comiclePreview.jpg?v=<?php echo time(); ?>"></div>
            <div class="infoText">
                <h2>Daily Fun!</h2>
                <p>
                    Test your knowledge of comic books with <a href="Pages/puzzle.php">Comicle</a>, our daily puzzle game! Answers range from all-time greats
                    to this weeks new releases! Enjoy guessing a wide variety of comic covers from publishers like DC, Marvel, Image, and more! We
                    also feature the occasional iconic cover from international publishers, including manga, such as Assassination Classroom (I mean,
                    who doesn't love that cover?) Have fun playing every day! We add new features all the time so we hope you keep coming back to see
                    all the cool covers and fun new things to do on Comicle!
                </p>
            </div>
        </div>

        <script src="Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
        <script src="Scripts/home.js?v=<?php echo time(); ?>"></script>
    </body>
</html>