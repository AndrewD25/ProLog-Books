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
        <?php
            // Start the session
            session_start();

            session_start(); // Start the session if not already started
            // Store the current page's URL in a session variable
            $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];

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

            //Connect to the database
            include_once 'Includes/connect.php'; 
        ?>

        <!--Rest of Page Code-->
        <div id="pageTitle">
            <h1>ProLog Books Articles</h1>
        </div>
        
        <div id="mainContent">
            <div id="articleGrid">
                <?php
                    //Add articles from database
                    $query = "SELECT * FROM Articles ORDER BY published DESC";
                    $result = $conn->query($query);

                    //Create data collection to store dates in
                    $dates = array();

                    // Loop through results
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<article class="post">';
                            echo '<a href="article.php?id=' . $row['article_id'] . '">';
                            echo '<img class="thumbnail" src="../Images/Articles/' . $row['thumbnail'] . '">';
                            echo '<div class="data">';
                            echo '<h2 class="title">' . $row['header'] . '</h2>';
                            echo '<div class="subData">';
                            echo '<p class="author"><i class="fa-solid fa-pencil"></i> ' . $row['author'] . '</p>';
                            echo '<p class="date"><i class="fa-regular fa-calendar"></i> ' . date('m/d/y', strtotime($row['published'])) . '</p>';

                            $dateTime = new DateTime($row['published']);
                            $formattedDate = $dateTime->format("F Y");
                            $dates[] = $formattedDate;

                            echo '</div>';
                            echo '<p class="preview">' . str_replace("\n", " ", substr($row['content'], 0, 40)) . '...</p>';
                            echo '</div>';
                            echo '</a>';
                            echo '</article>';
                        }
                    } else {
                        echo "No articles found.";
                    }
                ?>
            </div>
            <div id="sidebar">
                <div id="searchBox">
                    <p>Search:</p>
                    <input type="search" id="search">
                </div>
                <div id="filterBox">
                    <p>Filter By Month:</p>
                    <div id="monthFilters">
                        <?php
                            foreach (array_unique($dates) as $date) {
                                echo '<div><input checked type="checkbox"><p>' . $date . '</p></div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- Example article html structure:
        <article>
            <a href="article.php"> APPEND THE ARTICLE ID TO THE END OF THE URL
                <img class="thumbnail" style="background-image: url("../Images/Articles/IMAGE_ID_HERE");">
                <div class="data">
                    <h2 class="title">Welcome to<br>ProLog Books</h2>
                    <div class="subData">
                        <p class="author"><i class="fa-solid fa-pencil"></i> Andrew Deal</p>
                        <p class="date"><i class="fa-regular fa-calendar"></i> 02/01/24 </p>
                    </div>
                </div>
            </a>
        </article>
        -->


        <script src="../Scripts/news.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>