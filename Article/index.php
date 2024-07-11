<?php

//link db
require ("../conn.php");


//read data from db
$searchid = $conn->query("SELECT id FROM article");
$id_ar = array();

//save all id into array
if($searchid->num_rows > 0) {
	while ($row = $searchid->fetch_assoc()) {
		array_push($id_ar, $row["id"]);
	}
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="forum.css">
	<link rel="stylesheet" href="../nav.css">
	<link rel="stylesheet" href="../scrollbar.css">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="icon" type="image/x-icon" href="../icon.png">
	<title>Articles</title>
</head>
<body>
	<nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="../">PINKMANGO</a>
            </div>
            
            <ul>
                <li><a href="../">Home</a></li>
				<li><a href="">Article</a></li>
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
		<li><a href="">Article</a></li>
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
		<div class="head" style="display:flex;align-items:center;">
			<h2>Articles</h2>
			<a href="Add/" style="color : #fff; font-size:2rem;margin:1rem 0 0 0;"><i class='bx bx-plus' ></i></a>

		</div>
		<div class="flexbox">
			<?php
				foreach($id_ar as $id) {
					//search for title
					$searchtitle = $conn->query("SELECT title FROM article WHERE id = '$id'");
					$title = $searchtitle->fetch_assoc()["title"];

					//get date
					$searchdate = $conn->query("SELECT date FROM article WHERE id = '$id'");
					$date = $searchdate->fetch_assoc()["date"];
					
					//get content
					$searchcon = $conn->query("SELECT content FROM article WHERE id = '$id'");
					$content = $searchcon->fetch_assoc()["content"];
					if (strlen($content) > 100){
						$content = substr($content, 0, 100) . "...";
					}

					//get query
					$searchquery = $conn->query("SELECT query FROM article WHERE id = '$id'");
					$query = $searchquery->fetch_assoc()["query"];
					
					//echo out the content
					echo
					'<div class="box">
						<a href="Content?'.$query.'"><h1>'.$title.'</h1></a>
						<p class="date">'.$date.'</p>
						<p class="preview">'.$content.'</p>
					</div>';

				}

			?>
		</div>
	</div>
</body>
</html>