<?php

//establish conn with db
require "../conn.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../nav.css?v=<?php echo time(); ?>">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<title>Test</title>
</head>
<body>
	<nav class="navbar">
        <div class="navdiv">
            <div class="logo">
                <a href="#">PINKMANGO</a>
            </div>
            
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Search</a></li>
                <li><a href="#">Contact Us</a></li>
                <div class="profile">
                    <?php
                        if ($_SESSION["login"] == FALSE){
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
        <li><a href="abc.com">Home</a></li>
        <li><a href="abc.com">Search</a></li>
        <li><a href="#">Contact Us</a></li> 
        <li><a href="../Profile">Profile</a></li>
        <?php
            if ($_SESSION["login"] == FALSE){
                echo
                '<button><a href="../Login">Sign In</a></button>';
            }
            
        ?> 
                   
    </div>
	<script src="../navbar.js"></script>

	<div class="container">
		<div class="content">
			<div class="image">
				<img href="png" src="https://goinswriter.com/wp-content/uploads/2013/10/breaking-bad.png">
			</div>
			<div class="info">
				<div class="text">
					<h1>Breaking Bad</h1>
					<h2>Crime | Thriller</h2>
					<div class="rating">
						<i class='bx bxs-star'></i>
						<i class='bx bxs-star'></i>
						<i class='bx bxs-star'></i>
						<i class='bx bxs-star'></i>
						<i class='bx bxs-star-half'></i>
						<p>
							<h3>4.75</h3> 
							<p> / 5</p>
						</p>
				</div>
				<p>A chemistry teacher diagnosed with inoperable lung cancer turns to manufacturing and selling methamphetamine with a former student in order to secure his family's future.</p>
				<button type="submit" value="Submit"><i class='bx bx-plus' ></i>Add to watchlist</button>
			</div>
			</div>
		</div>
	</div>
	<div class="container2">
		<div class="cast">
			<h1>Cast</h1>
			    <div class="cardslot">
				<div class="card">
					<img href="cast_pic" src="https://m.media-amazon.com/images/M/MV5BMTA2NjEyMTY4MTVeQTJeQWpwZ15BbWU3MDQ5NDAzNDc@._V1_.jpg">
					<h2>Bryan Cranston</h2>
					<p>Walter White</p>
				</div>
				<div class="card">
					<img href="cast_pic" src="https://m.media-amazon.com/images/M/MV5BMTU0NTk3MDQ3OV5BMl5BanBnXkFtZTcwNDY3NzQ4Mg@@._V1_.jpg">
					<h2>Anna Gunn</h2>
					<p>Skyler White</p>
				</div>
				<div class="card">
					<img href="cast_pic" src="https://m.media-amazon.com/images/M/MV5BMTA2NjEyMTY4MTVeQTJeQWpwZ15BbWU3MDQ5NDAzNDc@._V1_.jpg">
					<h2>Bryan Cranston</h2>
					<p>Walter White</p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>