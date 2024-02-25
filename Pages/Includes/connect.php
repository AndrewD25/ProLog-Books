<!--Php query to connect to server-->
<?php

$servername = "sql206.infinityfree.com";
$username = "if0_35976622";
$password = "zapQRFX30UgJNU";
$database = "if0_35976622_project_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "<script>console.log('Successfully Connected')</script>";