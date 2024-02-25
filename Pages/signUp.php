<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ProLog Books - Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/PLBLogo.png">
    
    <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Stylesheets/signUp.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <!--Connect to Database-->
    <?php
        //include_once 'Includes/connect.php';
    ?>

    <!--Left Side-->
    <div id="logoBox">
        <img src="../Images/ProLogBooksLogo.png">
    </div>

    <!--Right Side-->
    <div id="mainContent">
        <div id="accountBox">
            <p class="icon"><i class="fa-solid fa-user-pen"></i></p>
            <h2>Sign Up</h2>
            <form action="verificationPage.php" method="post">
                <div class="input-container">
                    <input 
                        type="email" 
                        name="email" 
                        placeholder="Email" 
                        required 
                        id="email"
                    >
                    <!-- <div class="tooltip hidden">Invalid Email</div> -->
                </div>
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
                <input type="submit" value="Sign Up">
            </form>
            <div class="inlineContents">
                <p>Have an account already? </p>
                <a href="signInPage.php">Sign in</a>
            </div>
        </div>
    </div>

    <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
</body>
</html>
