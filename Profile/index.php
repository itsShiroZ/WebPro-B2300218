<?php

//db conn
require ("../conn.php");

//detect if logged in
if ($_SESSION["login"] == FALSE){
    header("Location: ../Login");
}

//pfp change

if (isset($_POST["submitpfp"])) {
    $pfpurl = $_POST["pfpurl"];
    $uname = $_SESSION["username"];
    $pfpquery = $conn -> query("UPDATE user SET link ='$pfpurl' WHERE username = '$uname'");
}

//detect pfp changes and update
$username = $_SESSION['username'];
$pfp = $conn -> query("SELECT * FROM user WHERE username = '$username'");
if ($pfp->num_rows > 0) {
    $link = $pfp->fetch_assoc()["link"];
}else{
    $link = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1024px-Default_pfp.svg.png";
}
$_SESSION['pfp'] = $link;

//username change
if (isset($_POST["submitname"])) {
    $newname = $_POST["newuser"];
    $currentname = $_SESSION["username"];
    $conn -> query("UPDATE user SET username = '$newname' WHERE username = '$currentname'");
}



//get id
$uname = $_SESSION["username"];
$searchid = $conn->query("SELECT * FROM user WHERE username = '$uname'");
if ($searchid->num_rows > 0){
    $id = $searchid->fetch_assoc()['id'];
    $_SESSION["id"] = $id;
}

//update username
$id = $_SESSION["id"];
$userquery = "SELECT * FROM user WHERE id = '$id'";
$searchuser = $conn->query($userquery);
if ($searchuser->num_rows > 0){
    $username = $searchuser->fetch_assoc()["username"];
    $_SESSION["username"] = $username;
}


//watchlist
//create var
$id = $_SESSION["id"];

//decode watchlist from sql

$watchlist_sr = $_SESSION["watchlist"];

$watchlist_ar = unserialize(base64_decode($watchlist_sr));

if ($watchlist_ar != NULL){
    $watchlist_ar = array_unique($watchlist_ar);
}


//logout button
if (isset($_POST["logoutbtn"])) {
    $_SESSION["login"] = FALSE;
    $_SESSION["username"] = NULL;
    $_SESSION["pfp"] = NULL;
    $_SESSION["id"] = NULL;
    header("Location: ../Login");
}


//check if admin
$lookupprev = $conn->query("SELECT prev FROM user WHERE id = '$id'");
$prev = $lookupprev->fetch_assoc();
$prev = $prev["prev"];

?>




<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="profile.css">
        <link rel="stylesheet" href="../nav.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons"rel="stylesheet">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="profile.js" defer></script>
        <link rel="icon" type="image/x-icon" href="../icon.png">
        <title>Profile</title>

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
                <img alt = "background" src="https://wallpapercave.com/wp/wp8148977.png">
            </div>
            <div class="pfcon">
                <div class="pro">
                    <h1>Profile</h1>
                    <div class="pfpimage">
                        <i class='bx bx-edit-alt' id="editpfp"></i>
                        <img id="pfpimage" src="<?php echo $_SESSION["pfp"];?>" alt="Profile Image" class="profile__image" onmouseover = "show('editpfp', 'block')" onmouseout = "show('editpfp','none')" onclick = "show('pfpform', 'block')">
                    </div>
                    <form id = "pfpform" class="pfpform" action="" method="post">
                        <div class="formcon">
                            <label>Please enter new profile image link</label>
                            <i class='bx bx-x' onclick="show('pfpform', 'none')"></i>
                        </div>
                        <input type="text" placeholder="Image URL" name="pfpurl" required autocomplete="off">
                        <button type="submit" style="display : none;" name="submitpfp"></button>
                    </form>
                    <div class="profile__name">
                        <p style="font-size:1.5rem;" id="uname" ondblclick = "show('userform', 'flex'), show('uname', 'none')"><?php echo "$username<br>";?></p>
                        <form id= "userform" class="userform" action="" method="post">
                            <input type="text" placeholder="New username" name="newuser" required autocomplete="off">
                            <i class='bx bx-x' onclick="show('userform', 'none'), show('uname', 'flex')"></i>
                            <button type="submit" style="display : none;" name="submitname"></button>
                        </form>
                        
                        <p style ="font-weight:light; opacity : 0.7; font-size:1rem;"><?php echo "#$id"; ?></p>
                        <?php
                            if ($prev == 1){
                                $stat = '<p style ="font-weight:light; opacity : 0.7; font-size:1rem;">admin</p>';
                                echo $stat;
                            }else {
                                $stat = '<p style ="font-weight:light; opacity : 0.7; font-size:1rem;">user</p>';
                                echo $stat;
                            }
                        ?>
                        
                    </div>
                    <?php
                        if ($prev == 1){
                            $btn = '<a class="CMS" href="../CMS"><button>CMS</button></a>';
                            echo $btn;
                        }

                    ?>
                    <form class="logout" method="post" action= ""><button name="logoutbtn" type="submit">LOGOUT</button></form>
              
                </div>
            </div>
                <div class="pfedcon">
                    <div class="pfed">
                        <h1>Watchlist</h1>
                        <hr>
                        <div class="flex-container">
                            <?php
                                if ($watchlist_ar != NULL) {
                                    foreach ($watchlist_ar as $i){
                                        //get title from db
                                        $searchtitle = $conn->query("SELECT title FROM content WHERE titlequery = '$i'");
                                        $title = $searchtitle->fetch_assoc();
                                        //store title into var title
                                        $title = $title["title"];
                            
                                        //get poster from db
                                        $searchposter = $conn->query("SELECT homeposter FROM content WHERE titlequery = '$i'");
                                        $poster = $searchposter->fetch_assoc();
                                        //store poster link into var poster
                                        $poster = $poster["homeposter"];

                                        echo 
                                        '<div class="flexbox">
                                            <img src="'.$poster.'" alt="" class="watchlist_image">
                                            <a href="../Content?'.$i.'">'.$title.'</a>
                                        </div>
                                        <hr>';
                                    }
                                }else {
                                    echo "<p style='color : white;text-align:center;font-size : 1.5rem;'>No watchlist item found</p>";
                                }
                            ?>
                            
                        </div>
                        
                        
                    </div>
                </div>
        </div>
</body>
</html>