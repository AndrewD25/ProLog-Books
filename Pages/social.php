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
        <?php
            // Start the session
            session_start();

            // Store the current page's URL in a session variable
            $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];

            // Redirect the user to sign in if they are logged out
            if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
                // Redirect the user to the sign-in page
                header("Location: /Pages/signInPage.php");
                exit(); // Make sure to exit after redirection
            }

            //Generate the header
            include_once 'Includes/header.php'; 
            //Connect to db
            include_once 'Includes/connect.php';

            $user_id = $_SESSION['user_id'];
        ?>

        <div id="leftSection" class="sidebar">
            
        </div>

        <div id="middleSection">
            <input type="search" id="search" placeholder="Username Search">

            <div id="usersContainer">
                <?php

                    // Get all users and their book count and echo it out in a cool format
                    $users_query = "SELECT Users.user_id, Users.username, Users.bio, Users.pfp, COUNT(Books.user_id) AS book_count 
                                    FROM Users 
                                    LEFT JOIN Books ON Users.user_id = Books.user_id
                                    WHERE Users.user_id NOT IN (1, 2) 
                                    GROUP BY Users.username 
                                    ORDER BY Users.username";

                    // Execute the query
                    $users_result = mysqli_query($conn, $users_query);
                    $leaderboard = $users_result;
                    

                    // Loop through each username
                    while ($row = mysqli_fetch_assoc($users_result)) {
                        $row_user_id = $row['user_id'];
                        $username = $row['username'];
                        $bio = $row['bio'];
                        $pfp = $row['pfp'];
                        $count = $row['book_count'];

                        // Disable bio if none is set
                        if ($bio == "Add a short bio about yourself!") $bio = "";

                        //Check friend status
                        $check = $conn->prepare("SELECT * FROM Friends WHERE user1 = ? AND user2 = ? OR user1 = ? AND user2 = ?");
                        $check->bind_param("ssss", $user_id, $row_user_id, $row_user_id, $user_id);
                        $check->execute();
                        $result = $check->get_result();
                        
                        $friendship = null;

                        if ($result->num_rows == 1) {

                            $row = $result->fetch_assoc();

                            // Fetch the status
                            $friendship = $row['status'];
                            
                        } /*elseif ($rowCount > 1) {
                            echo "Unexpected number of friendship rows found";
                        } else {
                            echo "No friendship found";
                        }*/
                        
                        if ($user_id == $row_user_id) {
                            $friendship = "doppelganger";
                        }

                        // Output the result
                        echo "<div class='userBox'>
                                <div class='centerBox'>
                                    <span><img class='pfp' src='../Images/Pfps/$pfp'> 
                                    $username - $count books</span>
                                    <form action='Includes/friendRequest.php' method='post'>
                                        <input type='hidden' name='storeUserId' value='$user_id'>
                                        <input type='hidden' name='otherUser' value='$username'>";

                        // Display a friend button or status
                        if (is_null($friendship)) {
                            echo "<button type='submit' class='friendRequest'><i class='fa-solid fa-user-plus'></i> Add Friend</button>";
                        } else if ($friendship == "friended") {
                            echo "<p type='submit' class='friendRequest'><i class='fa-solid fa-people-arrows'></i> Accept Friend Request</p>";
                        } else if ($friendship == "pending") {
                            echo "<p class='friendRequest'><i class='fa-solid fa-person-praying'></i> Pending Request</button>";
                        } else if ($friendship == "friends") {
                            echo "<p class='friendRequest'><i class='fa-solid fa-users'></i> Your Friend</p>";
                        } else if ($friendship == "doppelganger") {
                            echo "";
                        }

                        echo "</form>
                                </div>
                                <p class='bio'> " . ($bio != "" ? $bio : "No Bio") . "</p>
                            </div>";
                    }
                ?>
            </div>
        </div>

        <div id="rightSection" class="sidebar">
            <div class="leaderboard">
                <h3>Leaderboard</h3>
                <p>Featuring the users with the most books logged</p>

                <?php

                    $leader_query = "SELECT Users.user_id, Users.username, Users.pfp, COUNT(Books.user_id) AS book_count 
                                    FROM Users 
                                    LEFT JOIN Books ON Users.user_id = Books.user_id
                                    WHERE Users.user_id NOT IN (1, 2) 
                                    GROUP BY Users.username 
                                    ORDER BY book_count DESC, Users.username
                                    LIMIT 5";
                    // Execute the query
                    $leaderboard = mysqli_query($conn, $leader_query);

                    while ($row = mysqli_fetch_assoc($leaderboard)) {
                        $username = $row['username'];
                        $count = $row['book_count'];
                        $pfp = $row['pfp'];

                        echo "<div class='row'><p class='row'><img class='pfp' src='../Images/Pfps/$pfp'>$username</p><p>$count</p></div>";
                    }

                ?>

            </div>
            <div id="kofi-ad">
                <p>Support ProLog Books</p>
                <p>ProLog Books will always be a free community for book enjoyers to spend time, but 
                we currently operate without receiving any revenue. If you are enjoying ProLog Books and want to help smaller sites like us survive and grow 
                in the modern internet landscape, I would like to offer you a place to support us. Take a look at our Kofi page and see if the current donation
                goal looks interesting to you. Your donation can help us to add new features to the site to make this a better place! Thank you so much! </p>
                <script type='text/javascript' src='https://storage.ko-fi.com/cdn/widget/Widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#29abe0', 'K3K6UOKXY');
                kofiwidget2.draw();</script> 
            </div>
            <!--<img class="test-ad" src="https://i.pinimg.com/236x/e9/e2/66/e9e26659a202d8e19f6d505578b0ceae.jpg">-->
        </div>

        <!--Back to top button-->
        <button onclick="topFunction()" id="scrollBtn" title="Go to top">^</button>
        
        <!--Temporary Addition Just for Fun for Presentation Remove This Later-->
        <script src="../Scripts/social.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>
