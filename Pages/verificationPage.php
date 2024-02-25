<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Verify Your Email</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../Images/PLBLogo.png">
    
    <link rel="stylesheet" href="../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Stylesheets/signUp.css?v=<?php echo time(); ?>"> <!--uses similar enough styling to share a stylesheet-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <?php
    // Ensure that the form is submitted using the POST method
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if all form fields are filled
        if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {
            // Retrieve form data
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Check username length
            if (strlen($username) < 4 || strlen($username) > 20) {
                header("Location: {$_SERVER['HTTP_REFERER']}?success=0&error=username_length");
                exit;
            }

            // Check password length
            if (strlen($password) < 8 || strlen($password) > 30) {
                header("Location: {$_SERVER['HTTP_REFERER']}?success=0&error=password_length");
                exit;
            }

            //Hash the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            //Generate a code and hash it
            function generateVerificationCode($length = 8) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $code = '';
                for ($i = 0; $i < $length; $i++) {
                    $code .= $characters[rand(0, strlen($characters) - 1)];
                }
                return $code;
            }
            $verificationCode = generateVerificationCode();
            $hashedVC = password_hash($verificationCode, PASSWORD_DEFAULT);

            //Send the verification code to the user
            $subject = "Your ProLog Books Verification Code";
            $body = "Your verification code is: " . $verificationCode;
            $headers = "From: andrewsdeal@gmail.com\r\n";
            $headers .= "Reply-To: andrewsdeal@gmail.com\r\n";
            $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

            // Send the email
            if (mail($email, $subject, $body, $headers)) {
                echo "Email sent successfully to $email";
            } else {
                echo "Failed to send email to $email";
            }

            //Generate a date for the code to expire
            $expDate = date('Y-m-d', strtotime('+1 day'));

            //Connect to database and insert email and vc and expiration into codes table 
            include_once 'Includes/connect.php';
            $sql = "INSERT INTO Verification (email, code, expiration) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $email);
            $stmt->bindParam(2, $hashedVC);
            $stmt->bindParam(3, $expDate);
            if ($stmt->execute()) {
                echo "Record inserted successfully";
            } else {
                echo "Error inserting record: " . $stmt->errorInfo();
            }

        } else {
            echo "All form fields are required.";
            header("Location: {$_SERVER['HTTP_REFERER']}?success=0&error=missing_field");
        } 
    } else {
        echo "Invalid request method.";
        header("Location: signUp.php?success=0&error=invalid_method");
    }
    ?>

    <!--Left Side-->
    <div id="logoBox">
        <img src="../Images/ProLogBooksLogo.png">
    </div>

    <!--Right Side-->
    <div id="mainContent">
        <div id="accountBox">
            <p class="icon"><i class="fa-solid fa-user-shield"></i></p>
            <h2>Verify Your Email</h2>
            <p>
                We've sent a code to the email association with your account. Please enter 
                the code to activate your account.
            </p>
            <form action="Includes/accountCreator.php" method="post">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input type="hidden" name="username" value="<?php echo $email; ?>">
                <input type="hidden" name="password" value="<?php echo $email; ?>">
                <input 
                    type="text" 
                    name="code" 
                    placeholder="Enter Code Here" 
                    required 
                    id="code"
                >
            </form>
        </div>
    </div>

    <script src="../Scripts/templateScript.js?v=<?php echo time(); ?>"></script>
</body>
</html>