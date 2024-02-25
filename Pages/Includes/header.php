<?php
echo '<header id="pageTop">
            <a href="index.php"><img id="mainLogo" src="Images/ProLogBooksLogo.png"></a>

            <!--Navigation Links-->
            <nav> <!--Home uses different links than other pages-->
                <li><a href="index.php"><i class="fas fa-home" title="Home"></i> <span>Home</span></a></li>
                <li><a href="Pages/construction.php"><i class="fa-solid fa-book" title="Collection"></i> <span>Collection</span></a></li>
                <li><a href="Pages/construction.php"><i class="fa-solid fa-people-arrows" title="Social"></i> <span>Social</span></a></li>
                <li><a href="Pages/construction.php"><i class="fa-solid fa-newspaper" title="News"></i> <span>News</span></a></li>
                <li><a href="Pages/puzzle.php"><i class="fa-solid fa-puzzle-piece" title="Play Comicle"></i> <span>Play Comicle</span></a></li>
                <li id="accountLi"><a><i class="fa-solid fa-user"></i> <span>Sign In</span></a>
                    <div id="accountMenu" class="hidden dropdown">
                        <ul>
                            <li><a href="Pages/signUp.php">Sign Up</a></li>
                            <li><a href="Pages/signInPage.php">Sign In</a></li>
                            <li><a href="Pages/profile.php">Profile</a></li>
                            <li><a href="Pages/Includes/signOut.php">Sign Out</a></li>
                        </ul>
                    </div>
                </li>
            </nav>
        </header>';
