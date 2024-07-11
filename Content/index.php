<?php

//establish conn with db
require "../conn.php";

//get url query
$query = $_SERVER['QUERY_STRING'];

$result = $conn -> query("SELECT * FROM content WHERE titlequery = '$query'");
if ($result->num_rows > 0){

	//write array to variable row
	$row = $result->fetch_assoc();
	//get data from array
	$title = $row["title"];
	$genre = $row["genre"];
	$rating = $row["rating"];
	$description = $row["description"];
	$poster = $row["poster"];
	//cast 1 data
	$cast1name = $row["cast1"];
	$cast1role = $row["cast1role"];
	$cast1img = $row["cast1img"];
	//cast 2 data
	$cast2name = $row["cast2"];
	$cast2role = $row["cast2role"];
	$cast2img = $row["cast2img"];
	//cast 3 data
	$cast3name = $row["cast3"];
	$cast3role = $row["cast3role"];
	$cast3img = $row["cast3img"];
	//trailer
	$trailer = $row["trailer"];
}
else{
	//redirect to error page
	echo "<script> alert('No content found'); </script>";
	header("Location: ../error.html");
}

function calc($rat) {
	$nodec = intdiv($rat, 1);
	$dec = $rat - $nodec;
	$emptystar = 5 - $nodec;
	for ($i = 1; $i <= $nodec; $i++ ){
		echo "<i class='bx bxs-star'></i>";
	}
	if ($dec >= 0.5){
		echo "<i class='bx bxs-star-half'></i>";
	}
	else{
		echo "<i class='bx bx-star'></i>";
	}
	for ($e = 1;$e < $emptystar; $e++){
		echo "<i class='bx bx-star'></i>";
	}
}

//watchlist
if (isset($_POST["addtowatch"])){
	//create var
	$id = $_SESSION["id"];
	$contentname = $query;
	
	//decode watchlist from sql
	
	$watchlist_sr = $_SESSION["watchlist"];
	
	$watchlist_ar = unserialize(base64_decode($watchlist_sr));
	

	//check if already added to watchlist
	if (!in_array($contentname, $watchlist_ar)) {
		//push current page to the array
		array_push($watchlist_ar, "$contentname");
		

		//encode the array
		$watchlist_sr = base64_encode(serialize($watchlist_ar));
		
		
		//update sql
		$updatesql = "UPDATE user SET watchlist = '$watchlist_sr' WHERE id = '$id'";
		$update = $conn->query($updatesql); 
		if ($update) {
			echo "<script>alert('Successfully added to watchlist')</script>";
		}
	}else{
		echo "<script>alert('Already added to watchlist')</script>";
	}

	//update session var
	$searcharray = $conn->query("SELECT watchlist FROM user WHERE id = '$id'");
    $row = $searcharray->fetch_assoc();
    $_SESSION["watchlist"] = $row["watchlist"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="../nav.css?v=<?php echo time(); ?>">
	<link rel="stylesheet" type="text/css" href="../scrollbar.css?v=<?php echo time(); ?>">
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
	<link rel="icon" type="image/x-icon" href="../icon.png">
	<title>
		<?php 
			echo $title;
		?>
	</title>
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
        <li><a href="abc.com">Home</a></li>
		<li><a href="../Article">Article</a></li>
        <li><a href="#">Contact Us</a></li> 
        <li><a href="../Profile">Profile</a></li>
        <?php
            if (@$_SESSION["login"] == FALSE){
                echo
                '<li><a href="../Login">Sign In</a></li>';
            }
            
        ?> 
                   
    </div>
	<script src="../navbar.js"></script>

	<div class="container">
		<div class="content">
			<div class="image">
				<?php 
					echo "<img href='png' src='$poster'>"
				?>
			</div>
			<div class="info">
				<div class="text">
					<h1><?php echo $title; ?></h1>
					<h2><?php echo $genre; ?></h2>
					<div class="rating">
						<?php calc($rating); ?>
						<p>
							<h3><?php echo $rating; ?></h3> 
							<p> / 5</p>
						</p>
				</div>
				<p><?php echo $description; ?></p>
				<form action = "" method = "post">
					<button type="submit" value="Submit" name= "addtowatch"><i class='bx bx-plus' ></i>Add to watchlist</button>
				</form>
			</div>
			</div>
		</div>
	</div>
	<div class="trailercon">
		<div class="trailer">
			<div class="sect">
				<i class='bx bxs-camera-movie'></i>
				<h1>Trailer</h1>
			</div>
			<?php echo $trailer; ?>
		</div>
	</div>
	<div class="container2">
		<div class="cast">
			<div class="sect">
				<i class='bx bxs-user-rectangle'></i>	
				<h1>Cast</h1>
			</div>
			
			    <div class="cardslot">
				<div class="card">
					<?php
						echo "<img href='cast_pic' src='$cast1img'>";
					?>
					<h2><?php echo $cast1name; ?></h2>
					<p><?php echo $cast1role; ?></p>
				</div>
				<div class="card">
					<?php
						echo "<img href='cast_pic' src='$cast2img'>";
					?>
					<h2><?php echo $cast2name; ?></h2>
					<p><?php echo $cast2role; ?></p>
				</div>
				<div class="card">
					<?php
						echo "<img href='cast_pic' src='$cast3img'>";
					?>
					<h2><?php echo $cast3name; ?></h2>
					<p><?php echo $cast3role; ?></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>