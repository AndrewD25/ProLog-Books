<?php
session_start(); // Start the session to manage user login state

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connect to the database
        include_once "connect.php";

        // Check if username is a real account
        $stmt = $conn->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) { // Username exists
            $user = $result->fetch_assoc();
            
            // $newPass = password_hash($password, PASSWORD_DEFAULT) . "<br>";

            // echo $user['username'] . "<br>";
            // echo $user['pass'] . "<br>";
            // echo $newPass. "<br>";
            // echo "User matches newHash" . password_verify($password, $newPass) . "<br>";
            // echo "User matches db" . password_verify($password, $user['pass']) . "<br>";


            // Verify the password
            if (password_verify($password, $user['pass'])) {
                echo "Successful Login";
                // Password is correct, set session variables to mark user as logged in
                $_SESSION['username'] = $username;
                // Redirect the user to a dashboard or a welcome page
                header("Location: index.php");
                $stmt->close();
                $conn->close();
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Username not found.";
        }

        // Close the database connection
        $stmt->close();
        $conn->close();
        
    } else {
        echo "All form fields are required.";
    }
} else {
    echo "Invalid request method.";
}