<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ProLog Books - Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/PLBLogo.png">
    
    <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Stylesheets/signUp.css?v=<?php echo time(); ?>"> <!--uses similar enough styling to share a stylesheet-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!--Connect to Database-->
    <?php
        //include_once 'Includes/connect.php';
    ?>

    <!--Left Side-->
    <div id="mainContent">
        <div id="accountBox">
            <p class="icon"><i class="fa-solid fa-users-rectangle"></i></p>
            <h2>Sign In</h2>
            <form action="Includes/signIn.php" method="post">
                <div class="input-container">
                    <input 
                        type="text" 
                        name="username" 
                        placeholder="Username" 
                        pattern=".{4,20}" 
                        required 
                        id="username"
                    >
                    <!-- <div class="tooltip hidden">Invalid Username</div> -->
                </div>
                <div class="input-container">
                    <input 
                        type="password" 
                        name="password" 
                        placeholder="Password" 
                        pattern="^(?=.*[A-Z])(?=.*[\d!@#$%^&*()-_=+`~])[A-Za-z\d!@#$%^&*()-_=+`~]{8,30}$"
                        required 
                        id="password"
                    >
                    <!-- <div class="tooltip hidden">Invalid Password</div> -->
                </div>
                <input type="submit" value="Sign In">
            </form>
            <div class="inlineContents">
                <p>Don't have an account yet? </p>
                <a href="signUp.php">Sign up</a>
            </div>
        </div>
    </div>

    <!--Right Side-->
    <div id="logoBox">
        <img src="../Images/ProLogBooksLogo.png">
    </div>
    

    <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
</body>
</html>
