
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Welcome to ProLog Books!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../../Images/PLBLogo.png">

        <link rel="stylesheet" href="../../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../../Stylesheets/articles.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body>
        <?php
            // Start the session
            session_start();

            //Set theme mode to dark or light
            if (isset($_SESSION['theme'])) {
                $darkMode = $_SESSION['theme'] == 1;
                if(!$darkMode) {
                    echo '<script>';
                    echo 'document.documentElement.style.setProperty("--primaryColor", "#ffffff");'; // Change primary color variable
                    echo 'document.documentElement.style.setProperty("--textColor", "#000000");'; // Change text color variable
                    echo '</script>';
                }
            }

            //Banner with NavLinks
            include_once 'Includes/header.php'; 

            //Connect to the database and get article number
            $article_id = $_GET['id'];
            include_once 'Includes/connect.php'; 
        ?>

        <!--Rest of Page Code-->
        <div id="blurryBackground">
            <div id="centerScrolling">
                <h1 id="Title">Welcome to ProLog Books!</h1>
                <h2 id="Author">By Andrew Deal</h2>
                <h3 id="Date">02/01/2024</h3>
                <img id="Image" src="https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg">
                <p id="Content">
                    Text Here
                </p>
            </div>
        </div>

        <script>
            // let InputTitle = "How to Write a Blog Post";
            // let InputAuthor = "Andrew Deal";
            // let InputDate = "01-16-24";
            // let InputImage = "https://img.freepik.com/free-photo/sunset-time-tropical-beach-sea-with-coconut-palm-tree_74190-1075.jpg";
            // let InputContent = "EXAMPLE TEXT";

            // document.getElementById("Title").innerText = InputTitle;
            // document.getElementById("Author").innerText = InputAuthor;
            // document.getElementById("Date").innerText = InputDate;
            // document.getElementById("Image").setAttribute("src", InputImage);
            // document.getElementById("Content").innerText = InputContent;
        </script>
    </body>
</html>