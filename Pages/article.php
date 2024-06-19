<?php
    // Start the session
    session_start();

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

    //Banner with NavLinks
    include_once 'Includes/header.php'; 

    //Connect to the database and get article number
    if (isset($_GET['id'])) {
        $article_id = $_GET['id'];
        include_once 'Includes/connect.php'; 

        $sql = "SELECT * FROM Articles WHERE article_id = " . $article_id;
        $result = $conn->query($sql);

        $row = array(
            'header' => 'Error: Article not found',
            'author' => 'Error: Article not found',
            'published' => 'Error: Article not found',
            'thumbnail' => 'test.jpg',
            'context' => 'Error: Article not found'
        );
        // Check if result exists and has rows
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            // Handle case where result doesn't exist or no rows returned
            echo "Article not found.";
        }

        // Close database connection
        $conn->close();
    } else {
        // Handle case where ID parameter is not set
        header("Location: news.php?success=0");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to ProLog Books!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../Images/PLBLogo.png">

    <link rel="stylesheet" href="../../Stylesheets/pageTemplate.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../../Stylesheets/articles.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <div id="blurryBackground">
        <div id="centerScrolling">
            <h1 id="Title"><?php echo $row['header']; ?><h1>
            <h2 id="Author">By <?php echo $row['author']; ?></h2>
            <h3 id="Date"><?php echo date("m-d-Y", strtotime($row['published'])); ?></h3>
            <img id="Image" <?php echo 'src="../Images/Articles/' . $row['thumbnail'] . "?v=" . time() . '"' ?>>
            <p id="Content">
                <?php echo $row['content']; ?>
            </p>
        </div>
    </div>
</body>
</html>