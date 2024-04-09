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

            // Redirect the user to sign in if they are logged out
            if (!isset($_SESSION['username']) || empty($_SESSION['username'])) {
                // Redirect the user to the sign-in page
                header("Location: /Pages/signInPage.php");
                exit(); // Make sure to exit after redirection
            }

            //Generate the header
            include_once 'Includes/header.php'; 
            //Connect to db
            include_once 'Includes/connect.php';
        ?>

        <div id="usersContainer">
            <input type="search" placeholder="Search for your username">
            <?php
                //Get all users and their book count and echo it out in a cool format
                $usernames_query = "SELECT DISTINCT username FROM Users";

                // Execute the query
                $usernames_result = mysqli_query($conn, $usernames_query);

                // Loop through each username
                while ($row = mysqli_fetch_assoc($usernames_result)) {
                    $username = $row['username'];

                    // SQL query to count the rows where username field = current username from the loop in the Books table
                    $count_query = "SELECT COUNT(*) AS count FROM Books WHERE username = '$username'";

                    // Execute the count query
                    $count_result = mysqli_query($conn, $count_query);

                    // Fetch the count
                    $count_row = mysqli_fetch_assoc($count_result);
                    $count = $count_row['count'];

                    // Output the result
                    echo "<p class='userBox'>$username: $count</p>";
                }

                // Close the connection
                mysqli_close($conn);
            ?>
        </div>
        
        <!--Temporary Addition Just for Fun for Presentation Remove This Later-->
        <script src="../Scripts/social.js?v=<?php echo time(); ?>"></script>
        <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
    </body>
</html>
