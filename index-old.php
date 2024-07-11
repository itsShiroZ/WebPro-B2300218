<?php

//link db
require "conn.php";

//search
$querydetail = "";

if (isset($_GET["submit"])) {
    $querydetail = $_GET["mysearch"];

}


//read all anime from db
$resultanime = $conn->query("SELECT * FROM content WHERE type = 'anime' AND title = '$querydetail'");


$anime = array();
$animerow = $resultanime->fetch_assoc()["homeposter"];

while (@$animerow = $resultanime->fetch_assoc()["homeposter"]) {
    $anime[] = $animerow;
}

//film
$resultfilm = $conn->query("SELECT * FROM content WHERE type = 'film'");

$film = array();
$filmrow = $resultfilm->fetch_assoc()["homeposter"];


while (@$filmrow = $resultfilm->fetch_assoc()["homeposter"]) {
    $film[] = $filmrow;
}

//k drama
$resultkdrama = $conn->query("SELECT * FROM content WHERE type = 'kdrama'");

$kdrama = array();
$kdramarow = $resultkdrama->fetch_assoc()["homeposter"];

while (@$kdramarow = $resultkdrama->fetch_assoc()["homeposter"]) {
    $kdrama[] = $kdramarow;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="home.css">
    <link rel="stylesheet" type="text/css" href="scrollbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"> 
    <title>Home</title>
    <link rel ="icon" type ="image/x-icon" href ="icon.png">
    <script src="home.js" defer></script>
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="../">PINKMANGO</a>
            </div>
            
            <ul>
                <li><a href="../Pinkmango">Home</a></li>
                <li><a href="../Pinkmango/Search">Search</a></li>
                <li><a href="../Pinkmango/Contact">Contact Us</a></li>
                <div class="profile">
                    <?php
                        if (@$_SESSION["login"] == FALSE){
                            echo
                            '<button><a href="../Pinkmango/Login">Sign In</a></button>';
                        }
                        elseif ($_SESSION["login"] == TRUE) {
                            $link = $_SESSION['pfp'];
                            
                            $username = $_SESSION["username"];
                            echo "<a href='../Pinkmango/Profile'>Welcome, $username</a>";

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
        <li><a href="../Pinkmango">Home</a></li>
        <li><a href="../Pinkmango/Search">Search</a></li>
        <li><a href="../Pinkmango/Contact">Contact Us</a></li> 
        <li><a href="../Pinkmango/Profile">Profile</a></li>
        
        <?php
            if ($_SESSION["login"] == FALSE){
                echo
                '<li><a href="../Pinkmango/Login">Sign In</a></li>';
            }
            
        ?> 
                   
    </div>
	<script src="navbar.js"></script>
    <div class="content">
        <div class="kdrama">
            <h1>K Drama</h1>
            <div class="posters-container">
                <div class = "slider-wrapper">
                    <button id = "prev-slide" class="slide-button material-symbols-rounded">chevron_left</button>
                    <div class="image-list">
                        <?php
                            foreach ($kdrama as $i){
                                $querysearch = $conn->query("SELECT * FROM content WHERE homeposter = '$i'");
                                $href = $querysearch->fetch_assoc()["titlequery"];


                                echo "<a href='/PinkMango/Content/?$href'><img src='$i' alt='' class='image-item'></a>";
                            }
                        
                        ?>
                    </div>
                    <button id="next-slide" class="slide-button material-symbols-rounded">chevron_right</button>
                </div>
            </div>
        </div>
    </div>
    <div class = "content2">
        <div class="anime">
            <h1>Anime</h1>
            <div class="posters-container2">
                <div class = "slider-wrapper2">
                    <button id = "prev-slide2" class="slide-button2 material-symbols-rounded">chevron_left</button>
                    <div class="image-list2">
                        <?php
                            foreach ($anime as $x){
                                $querysearch = $conn->query("SELECT * FROM content WHERE homeposter = '$x'");
                                $href = $querysearch->fetch_assoc()["titlequery"];


                                echo "<a href='/PinkMango/Content/?$href'><img src='$x' alt='' class='image-item2'></a>";
                            }
                            
                        ?>
                    </div>
                    <button id="next-slide2" class="slide-button2 material-symbols-rounded">chevron_right</button>
                </div>
            </div>
        </div>
    </div>
    <div class = "content3">
        <div class="film">
            <h1>Film</h1>
            <div class="posters-container3">
                <div class = "slider-wrapper3">
                    <button id = "prev-slide3" class="slide-button3 material-symbols-rounded">chevron_left</button>
                    <div class="image-list3">
                        <?php
                            foreach ($film as $x){
                                $querysearch = $conn->query("SELECT * FROM content WHERE homeposter = '$x'");
                                $href = $querysearch->fetch_assoc()["titlequery"];


                                echo "<a href='/PinkMango/Content/?$href'><img src='$x' alt='' class='image-item3'></a>";
                            }
                        
                        ?>
                    </div>
                    <button id="next-slide3" class="slide-button3 material-symbols-rounded">chevron_right</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>