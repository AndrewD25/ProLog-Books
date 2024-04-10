<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Play Comicle Online - ProLog Books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/PLBLogo.png">

        <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../Stylesheets/puzzle.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body>
        <!--Page Banner with Navlinks at the top of each page-->
        <?php 
            include_once 'Includes/header.php'; 

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
        ?>   

        <h1>Daily Comicle</h1>

        <?php
            include_once 'Includes/connect.php';
            $currentDate = date("Y-m-d");
            $query = "SELECT * FROM Puzzles WHERE puzzle_date = '$currentDate'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            //Get today's puzzle number
            $presentPuzzle = $row["puzzle_number"];
        
            //Check if user input a custom puzzle number
            if(isset($_GET['puzzle_number'])) {
                $setNumber = (int)$_GET['puzzle_number'];
                if(is_int($setNumber) && $setNumber <= $presentPuzzle) {
                    $query = "SELECT * FROM Puzzles WHERE puzzle_number = '$setNumber'";
                    $result2 = $conn->query($query);
                    $row = $result2->fetch_assoc();
                }
            }

            echo "<p class='puzzleNumber'>Puzzle #" . $row["puzzle_number"] . "</p>";
        ?>

        <div id="centering">
            <div id="leftSide">
                <!--Image to be Pixelated-->
                <canvas id="mycanvas"></canvas>

                <p id="roundText">Round <span id="roundNum">1</span>/6</p>
            </div>
            <div id="rightSide">
                <!--User input boxes-->
                <div id="guessInputs">
                    <div class="autocomplete">
                        <input type="text" id="seriesInput" placeholder="Series">
                    </div>
                    <input type="number" id="numberInput" placeholder="#">
                </div>
                <button id="guessButton">Guess!</button>

                <!--Keep track of guesses-->
                <h3>Guesses:</h3>
                <div id="guessContainer">
                    <!-- <p class="guess">Guess</p> -->
                </div>
            </div>
            <div id="instagram">
                <p>For a daily hint, check out <a href="https://www.instagram.com/prologbooks?utm_source=qr&igsh=MWdpM3V2ZGxrcnJzcg==">
                ProLog Books</a> on Instagram</p>
            </div>
            <div id="kofi">
                <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script>
                <script type='text/javascript'>kofiwidget2.init('Support Us on Ko-fi', '#074670', 'K3K6UOKXY');kofiwidget2.draw();</script> 
            </div>

            <details>
                <summary>View All Puzzles</summary>
                <div id="oldLinks">
                    <?php
                        //Create links for all previous puzzles
                        $query = "SELECT * FROM Puzzles WHERE puzzle_number <= $presentPuzzle";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row3 = $result->fetch_assoc()) {
                                $puzzleNumber = $row3['puzzle_number'];
                                if ($row3['puzzle_number'] == $row["puzzle_number"]) { //Set the current puzzle link to gray
                                    echo "<a class='oldLink' style='background-color: #777 !important;' href='puzzle.php?puzzle_number=$puzzleNumber'>Puzzle $puzzleNumber</a><br>";
                                } else { //All other links show as green
                                    echo "<a class='oldLink' href='puzzle.php?puzzle_number=$puzzleNumber'>Puzzle $puzzleNumber</a><br>";
                                }
                            }
                        } else {
                            echo "No puzzles found.";
                        }

                    ?>
                </div>
            </details>
            
            
        </div>
        
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
        <script type="text/javascript" src="https://cdn.rawgit.com/rogeriopvl/8bit/master/8bit.js">
        </script><script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script>
        <script src="../Scripts/autocomplete.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/puzzle.js?v=<?php echo time(); ?>"></script>

        <?php
            //Set the puzzle image
            echo "<script id='deleteMe'>setAnswer('" . $row["image_id"] . "', '" . $row["answer_series"] . "', '" . $row["answer_number"] . "')</script>";
            
        ?>
    </body>
</html>