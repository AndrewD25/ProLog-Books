<!--
Andrew Deal
ProLog Books Social Page HTML
DUE DATE
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Social - ProLog Books</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="../Images/PLBLogo.png">

        <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="../Stylesheets/social.css?v=<?php echo time(); ?>">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    </head>
    <body>
        <header id="pageTop">
            <a href="../index.php"><img id="mainLogo" src="../Images/PLBLogo.png"></a>
            <nav>
                <li><a href="../index.php"><i class="fas fa-home" title="Home"></i> <span>Home</span></a></li>
                <li><a href="collection.php"><i class="fa-solid fa-book" title="Collection"></i> <span>Collection</span></a></li>
                <li><a href="social.php"><i class="fa-solid fa-people-arrows" title="Social"></i> <span>Social</span></a></li>
                <li><a href="news.php"><i class="fa-solid fa-newspaper" title="News"></i> <span>News</span></a></li>
                <li><a href="puzzle.php"><i class="fa-solid fa-puzzle-piece" title="Play Comicle"></i> <span>Play Comicle</span></a></li>
                <li id="accountLi"><a><i class="fa-solid fa-user"></i> <span>Account</span></a>
                    <div id="accountMenu" class="hidden">
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

        <h1><i class="fa-solid fa-user"></i>&nbsp;&nbsp;AgentQuacc's Profile:</h1>
        <div id="backgroundShelf">
            <!-- Shelf 1 -->
            <div class="shelf">
                <div class="book green">
                    <p class="vertical">Book 1</p>
                </div>
                <div class="book blue">
                    <p class="vertical">Book 2</p>
                </div>
                <div class="book purple">
                    <p class="vertical">Book 3</p>
                </div>
                <div class="book red">
                    <p class="vertical">Book 4</p>
                </div>
                <div class="book yellow">
                    <p class="vertical">Book 5</p>
                </div>
                <div class="book teal">
                    <p class="vertical">Book 6</p>
                </div>
                <div class="book red">
                    <p class="vertical">Book 7</p>
                </div>
                <div class="book blue">
                    <p class="vertical">Book 8</p>
                </div>
                <div class="book green">
                    <p class="vertical">Book 9</p>
                </div>
                <div class="book purple">
                    <p class="vertical">Book 10</p>
                </div>
            </div>
        
            <!-- Shelf 2 -->
            <div class="shelf">
                <div class="book blue">
                    <p class="vertical">Book 11</p>
                </div>
                <div class="book teal">
                    <p class="vertical">Book 12</p>
                </div>
                <div class="book yellow">
                    <p class="vertical">Book 13</p>
                </div>
                <div class="book red">
                    <p class="vertical">Book 14</p>
                </div>
                <div class="book green">
                    <p class="vertical">Book 15</p>
                </div>
                <div class="book purple">
                    <p class="vertical">Book 16</p>
                </div>
                <div class="book green">
                    <p class="vertical">Book 17</p>
                </div>
                <div class="book red">
                    <p class="vertical">Book 18</p>
                </div>
                <div class="book purple">
                    <p class="vertical">Book 19</p>
                </div>
                <div class="book blue">
                    <p class="vertical">Book 20</p>
                </div>
            </div>
        
            <!-- Shelf 3 -->
            <div class="shelf">
                <div class="book teal">
                    <p class="vertical">Book 21</p>
                </div>
                <div class="book red">
                    <p class="vertical">Book 22</p>
                </div>
                <div class="book blue">
                    <p class="vertical">Book 23</p>
                </div>
                <div class="book purple">
                    <p class="vertical">Book 24</p>
                </div>
                <div class="book yellow">
                    <p class="vertical">Book 25</p>
                </div>
                <div class="book green">
                    <p class="vertical">Book 26</p>
                </div>
                <div class="book purple">
                    <p class="vertical">Book 27</p>
                </div>
                <div class="book blue">
                    <p class="vertical">Book 28</p>
                </div>
                <div class="book green">
                    <p class="vertical">Book 29</p>
                </div>
                <div class="book red">
                    <p class="vertical">Book 30</p>
                </div>
            </div>
        </div>
        
        <!--Temporary Addition Just for Fun for Presentation Remove This Later--><script src="https://cdn.jsdelivr.net/npm/js-confetti@latest/dist/js-confetti.browser.js"></script> 
        <script src="../Scripts/social.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>
