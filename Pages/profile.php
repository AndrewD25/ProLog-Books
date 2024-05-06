<!--
Andrew Deal
ProLog Books Settings Page HTML
DUE DATE
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Profile - ProLog Books</title>
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
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
                // Redirect the user to the sign-in page
                header("Location: /Pages/signInPage.php");
                exit(); // Make sure to exit after redirection
            } else {
                include_once 'Includes/connect.php';
                $user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
                $query = "SELECT username FROM Users WHERE user_id = '$user_id'";
                $results = mysqli_query($conn, $query);

                if (mysqli_num_rows($results) > 0) {
                    $row = mysqli_fetch_assoc($results);
                    $username = $row['username'];
                }
            }

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

            //Check for errors
            if (isset($_SESSION["errors"])) {
                $errors = $_SESSION["errors"];
                unset($_SESSION["errors"]);
                echo "<script>
                    addEventListener('load', (event) => {showUserModal()});
                </script>";
            }

            //Create the header
            include_once 'Includes/header.php';
        ?>

        <!--Rest of Page Code-->
        <nav id="leftNavbar">
            <a href="#profileSection">Your Profile</a>
            <a href="#friendsSection">Friend Requests</a>
            <a href="#accountSection">Account Settings</a>
        </nav>

        <main>

            <h1 id="profileSection">Your Profile</h1>
            <section id="profileDisplay">
                
                <?php 
                    $query = $conn->prepare("SELECT * FROM Users WHERE username = ?");
                    $query->bind_param("s", $username);
                    $query->execute();
                    $result = $query->get_result();
                    $row = $result->fetch_assoc();
                    $pfp = $row['pfp'];
                    echo '<img src="../Images/Pfps/' . $pfp . '?v=<?php echo time(); ?>" class="pfp">';
                ?>                
                
                <div>
                    <!--Echo profile info-->
                    <h2 class="username"><?php echo $username;?></h2>
                    <button id="editProfileBtn" type="button" onclick="showUserModal()"><i class="fa-solid fa-pencil"></i></button>
                    <p class="bio"><?php echo $row['bio'];?></p>
                </div>
            </section>

            <div class="modal hidden" id="editProfileModal">
                <h1>Edit Profile</h1>
                <button type="button" onclick="showPfpModal()" id="pfpButton">
                    <?php echo '<img src="../Images/Pfps/' . $pfp . '?v=<?php echo time(); ?>" class="pfp" id="modalPfp">'; ?>
                </button>
                
                <form action="Includes/saveProfile.php" method="post">
                    <input type="hidden" value="<?php echo $row['pfp'] ?>" id="hidden_pfp_input" name="hidden_pfp_input" readonly>
                    <input type="hidden" name="storeUserId" value="<?php echo $user_id ?>" readonly>
                    <p class="errorMsg"><?php if(isset($errors["p"])) echo $errors["p"] ?></p>

                    <label for="newUsername">Username:</label>
                    <input type="text" id="newUsername" name="newUsername" class="username" value='<?php echo $username;?>' maxlength="20">
                    <p class="errorMsg"><?php if(isset($errors["u"])) echo $errors["u"] ?></p>

                    <label for="newBio">Bio:</label>
                    <textarea class="bio" id="newBio" name="newBio" maxlength="150"><?php echo $row['bio'];?></textarea>
                    <p class="errorMsg"><?php if(isset($errors["b"])) echo $errors["b"] ?></p>

                    <div class="flex">
                        <button class="cancel" type="button" onclick="hideAllModal()">Cancel</button>
                        <input type="submit" value="Save Changes">
                    </div>
                </form>
                
            </div>

            <h1 id="friendsSection">Pending Friend Requests</h1>
            <section id="friendRequests">
                
            </section>

            
            <h1 id="accountSection">Account Settings</h1>
            <section id="settings">
                <form>
                    <label for="theme">Dark Mode? </label>
                    <input type="checkbox" name="theme" id="theme" checked>
                    <br>
                    <p>Other settings go here</p>
                    <br>
                    <input type="submit" value="Save Settings">
                </form>
            </section>

            <p><a id="signOutButton" href="/Pages/Includes/signOut.php">Sign Out</a></p> <!--Remove the p and add styling later-->
        </main>


        <!--Modal window for profile picture selection-->
        <div class="modal hidden" id="pfpModal">
            <h1>Change Profile Picture</h1>
            <div id="pictureList">
                <!--Add profile pictures here as new ones come out-->
                <img draggable="false" class="pfpOption" src="../Images/Pfps/default.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp1.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp2.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp3.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp4.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp11.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp5.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp6.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp7.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp8.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp9.jpg">
                <img draggable="false" class="pfpOption" src="../Images/Pfps/pfp10.jpg">
            </div>
            <p>Currently Selected: <span id="selected">None<!--JS adds selected pfp text here--></span></p>
            <button class="cancel" type="button" onclick="hidePfpModal()">Cancel</button>
            <button type="button" class="selector">Select</button>
        </div>

        

        <div class="overlay hidden" id="overlay"></div>

        <script src="../Scripts/profile.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>