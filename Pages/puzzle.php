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

        <h1>Daily Comicle</h1>

        <?php
            include_once 'Includes/connect.php';
            $currentDate = date("Y-m-d");
            $query = "SELECT * FROM Puzzles WHERE puzzle_date = '$currentDate'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();

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
                    <input type="number" id="numberInput" placeholder="Number">
                </div>
                <button id="guessButton">Guess!</button>

                <!--Keep track of guesses-->
                <h3>Guesses:</h3>
                <div id="guessContainer">
                    <!-- <p class="guess">Guess</p> -->
                </div>
            </div>
            <div id="kofi">
                <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script>
                <script type='text/javascript'>kofiwidget2.init('Support Us on Ko-fi', '#074670', 'K3K6UOKXY');kofiwidget2.draw();</script> 
            </div>
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