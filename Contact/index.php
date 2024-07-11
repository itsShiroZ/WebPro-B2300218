<?php

//link db
require ("../conn.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link href="aboutus.css" rel="stylesheet">   
    <link rel="stylesheet" href="../nav.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="../icon.png">
</head>    
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="../">PINKMANGO</a>
            </div>
            
            <ul>
                <li><a href="../">Home</a></li>
                <li><a href="../Article">Article</a></li>
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
        <li><a href="../Article">Article</a></li>
        <li><a href="../Contact">Contact Us</a></li> 
        <li><a href="../Profile">Profile</a></li>
        <?php
            if (@$_SESSION["login"] == FALSE){
                echo
                '<button><a href="../Login">Sign In</a></button>';
            }
            
        ?> 
                   
    </div>
    <script src="../navbar.js"></script>
    <div class="container">
        <div class="background">
            <img alt = "background" src="bg.jpg">
        </div>
        <section class="about">
            <h1>About Us</h1>
            <br>
            <i>"As twilight descended over the ancient forest, a gentle mist rose from the moss-covered ground, wreathing the gnarled oak trees in a soft, ethereal glow, while the last rays of sunlight filtered through the canopy, painting the woodland in hues of amber and emerald, and somewhere in the distance, a nightingale began its sweet, melancholic song."<br>   
            </i>
                <ul>  
                    <br>
                    <br>
                    <br>
                    <i class='bx bx-envelope' ></i>
                    <p>sengkhang0112@gmail.com</p>
                    <p>xshiroz2005@gmail.com</p>
                </ul>
        </section>
    </div>
</body>
</html>