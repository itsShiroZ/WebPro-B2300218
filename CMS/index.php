<?php

//link db
require "../conn.php";

if (isset($_POST['submit-btn'])) {
    $type = $_POST['type'];
    $titlequery = $_POST['titlequery'];
    $poster = $_POST['poster'];
    $homeposter = $_POST['homeposter'];
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $genre = $_POST['genre'];
    $description = addslashes($_POST['description']);
    $cast1 = $_POST['cast1'];
    $cast1img = $_POST['cast1img'];
    $cast1role = $_POST['cast1role'];
    $cast2 = $_POST['cast2'];
    $cast2img = $_POST['cast2img'];
    $cast2role = $_POST['cast2role'];
    $cast3 = $_POST['cast3'];
    $cast3img = $_POST['cast3img'];
    $cast3role = $_POST['cast3role'];
    $trailer = $_POST['trailer'];

    $insertQuery="INSERT INTO content(type, titlequery, poster, homeposter, title, rating, genre, description, cast1, cast1img, cast1role, cast2, cast2img, cast2role, cast3, cast3img, cast3role, trailer) VALUES ('$type', '$titlequery', '$poster', '$homeposter', '$title', '$rating', '$genre', '$description', '$cast1','$cast1img', '$cast1role', '$cast2', '$cast2img', '$cast2role', '$cast3', '$cast3img', '$cast3role', '$trailer')";
    $conn -> query($insertQuery);
    header("Location: ../CMS");
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../nav.css">
    <link rel="stylesheet" type="text/css" href="../home.css">
    <link rel="stylesheet" type="text/css" href="../scrollbar.css">
    <link rel="stylesheet" type="text/css" href="cms.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>CMS</title>
    <link rel ="icon" type ="image/x-icon" href ="../icon.png">
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="../">PINKMANGO</a>
            </div>
                <div class="search">
                <div class="icon"></div>
                <div class="input">
            </div>
                <span class="clear" onclick="document.getElementById('mysearch').value = '' "></span>
            </div>
            
            <script>
                const icon = document.querySelector('.icon');
                const search = document.querySelector('.search');
                icon.onclick = function(){
                    search.classList.toggle('active')
                }
            </script>
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
            if ($_SESSION["login"] == FALSE){
                echo
                '<li><a href="../Pinkmango/Login">Sign In</a></li>';
            }
            
        ?> 
                   
    </div>
	<script src="../navbar.js"></script>
    <div class="cmscontainer">
        <h1 style="color:#fff;padding : 20px;">Content Management System</h1>
        <form class = "inputform" action="" method="post">
            <label>Type of Content</label><br>
            <select name="type" required>
                <option value="kdrama">K-Drama</option>
                <option value="anime">Anime</option>
                <option value="film">Film</option>
            </select>
            <label>Title Query (No Spaces, eg. attackontitan)</label><br>
            <input type="text" name="titlequery" required placeholder="Title Query"><br>

            <label>Wide Image shown in Content Page (url)</label><br>
            <input type="text" name="poster" required placeholder="IMG Url"><br>
            
            <label>Poster of content</label><br>
            <input type="text" name="homeposter" required placeholder="IMG Url"><br>

            <label>Title</label><br>
            <input type="text" name="title" required placeholder="Title"> <br>

            <label>Rating (0-5)</label><br>
            <input type="text" name="rating" required placeholder="Rating"><br>

            <label>Genre</label><br>
            <input type="text" name="genre" required placeholder="Genre"><br>

            <label>Description of Content</label><br>
            <input type="text" name="description" required placeholder="Description"><br>

            <label>Cast 1 Name</label><br>
            <input type="text" name="cast1" required placeholder="Cast 1 Name"><br>

            <label>Cast 1 image</label><br>
            <input type="text" name="cast1img" required placeholder="Cast 1 image"><br>

            <label>Cast 1 role</label><br>
            <input type="text" name="cast1role" required placeholder="Cast 1 role"><br>

            <label>Cast 2 Name</label><br>
            <input type="text" name="cast2" required placeholder="Cast 2 Name"><br>

            <label>Cast 2 image</label><br>
            <input type="text" name="cast2img" required placeholder="Cast 2 image"><br>

            <label>Cast 2 role</label><br>
            <input type="text" name="cast2role" required placeholder="Cast 2 role"><br>

            <label>Cast 3 Name</label><br>
            <input type="text" name="cast3" required placeholder="Cast 3 Name"><br>

            <label>Cast 3 image</label><br>
            <input type="text" name="cast3img" required placeholder="Cast 3 image"><br>

            <label>Cast 3 role</label><br>
            <input type="text" name="cast3role" required placeholder="Cast 3 role"><br>

            <label>Trailer (Please copy embed code from youtube)</label><br>
            <input type="text" name="trailer" required placeholder="Embed code for trailer"><br>

            <button type="submit" value="Submit" name="submit-btn">Submit</button>
        </form>
    </div>
</body>
</html>

<style>
    *{
        margin : 0;
        box-sizing : border-box;
    }

    .inputform {
        width: 100vw;
        padding : 10vw;
    }
</style>