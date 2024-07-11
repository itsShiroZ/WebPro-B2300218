<?php

require ("../../conn.php");


//when button clicked
if (isset($_POST["submit"])){

    $title = addslashes($_POST["title"]);
    $query = $_POST["query"];
    $content = addslashes($_POST["content"]);


    $updatedb = "INSERT INTO article(title, content, query) VALUES ('$title', '$content', '$query') ";
    if ($conn->query($updatedb)){
        echo "<script> alert('Success') </script>";
    }else{
        echo "<script>alert('Failed')</script>";
    }

    header("Location: ../Add");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../nav.css">
    <link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="../../scrollbar.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="icon" type="image/x-icon" href="../../icon.png">
    <title>Add an Article</title>
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
            <div class="head" style = "display : flex;">
                <a href="../"><i class='bx bx-arrow-back'></i></a>
                <h1>Add An Article</h1>
            </div>
            
            <form method="post" action="">
                <label>Title of the article</label>
                <input type="text" required placeholder="Title" name="title">

                <label>Query of the article (eg. attackontitan)</label>
                <input type="text" required placeholder="Query" name="query">

                <label>Content</label>
                <textarea type="text" rows = "10" cols = "100" required placeholder="Enter Content here" name="content"></textarea>

                <button name = "submit" value="submit" type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>