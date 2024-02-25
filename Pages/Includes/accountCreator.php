<?php
// Ensure that the form is submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are filled
    if (isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['code]'])) {
        // Retrieve form data
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $code = $_POST['code'];

        // Database connection
        include_once 'connect.php';

        //Check for email verification
        $stmt = $conn->prepare("SELECT * FROM Verification WHERE email = ? AND expiration > CURDATE()");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $match = false;
        while ($row = $result->fetch_assoc()) {
            // Verify the code using password_verify
            if (password_verify($code, $row['code'])) {
                // If the verification code matches, set match to true and break the loop
                $match = true;
                break;
            }
        }

        //Insert user data to database
        if($match) {
            $sql = "INSERT INTO Users (email, username, pass) VALUES (?, ?, ?)";

            // Prepare the SQL statement
            $stmt = $conn->prepare($sql);

            // Bind parameters
            $stmt->bind_param("sss", $email, $username, $password);

            // Execute the statement
            if ($stmt->execute()) {
                // Close the statement and database connection
                $stmt->close();
                $conn->close();

                // Redirect back to the previous page with success message
                header("Location: ../../index.php?success=1");
                exit;
            } else {
                echo "Error: " . $conn->error;
            }
        }

        // Close the statement and database connection
        $stmt->close();
        $conn->close();
    } else {
        echo "All form fields are required.";
        header("Location: {$_SERVER['HTTP_REFERER']}?success=0&error=missing_field");
    }
} else {
    echo "Invalid request method.";
    header("Location: {$_SERVER['HTTP_REFERER']}?success=0&error=invalid_method");
}