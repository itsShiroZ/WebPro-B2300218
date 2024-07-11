<?php

require ("../../conn.php");

//get query in url
$urlquery = $_SERVER["QUERY_STRING"];


//get query
$searchtitle = $conn->query("SELECT title FROM article WHERE query = '$urlquery'");
$title = $searchtitle->fetch_assoc()["title"];

//get date
$searchdate = $conn->query("SELECT date FROM article WHERE query = '$urlquery'");
$date = $searchdate->fetch_assoc()["date"];

//get content
$searchcon = $conn->query("SELECT content FROM article WHERE query = '$urlquery'");
$content = $searchcon->fetch_assoc()["content"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../../icon.png">
    <link rel="stylesheet" href="../../nav.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../../scrollbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title><?php echo $title;?></title>
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="../../">PINKMANGO</a>
            </div>
            
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../">Article</a></li>
                <li><a href="../Contact">Contact Us</a></li>
                <div class="profile">
                    <?php
                        if (@$_SESSION["login"] == FALSE){
                            echo
                            '<button><a href="../Login">Sign In</a></button>';
                        }
                        elseif ($_SESSION["login"] == TRUE) {
                            $link = $_SESSION['pfp'];
                            
                            $username = $_SESSION["username"];
                            echo "<a href='../Profile'>Welcome, $username</a>";

                            echo "<img alt='pfp' href='#' src=$link>"; 
                            
                        }

                    ?>
                </div>
            </ul>
            <div class="toggle_btn">
                <i class='bx bx-menu'></i>
            </div>            
        </div>
    </nav>
	<div class="dropdown">
        <li><a href="../">Home</a></li>
        <li><a href="../">Article</a></li>
        <li><a href="../Contact">Contact Us</a></li> 
        <li><a href="../Profile">Profile</a></li>
        <?php
            if (@$_SESSION["login"] == FALSE){
                echo
                '<button><a href="../Login">Sign In</a></button>';
            }
            
        ?> 
                   
    </div>
    <script src="../../navbar.js"></script>
    <div class="container">
        <div class="box">
            <a href="../"><i class='bx bx-arrow-back'></i></a>
            <h1><?php echo $title; ?></h1>
            <p class="date"><?php echo $date; ?></p>
            <p class="content"><?php echo $content; ?></p>
        </div>
    </div>
</body>
</html>
