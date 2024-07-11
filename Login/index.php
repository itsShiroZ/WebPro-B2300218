<?php

//establish connection with db
require "../conn.php";

if(isset($_POST["login"])) {
    $uname = $_POST["username"];
    $pass = $_POST["password"];
    $pass = SHA1($pass);
    $mysqli = "SELECT * FROM user WHERE username = '$uname'";
    $result = $conn -> query($mysqli);
    if($result->num_rows > 0) {
        if($pass == $result->fetch_assoc()["password"]) {
            $_SESSION["login"] = TRUE;
            $_SESSION["username"] = $uname;
            header("Location: ../");

            //search for pfp
            $searchresult = $conn -> query("SELECT * FROM user WHERE username = '$uname'");

            if ($searchresult->num_rows > 0) {
                $link = $searchresult->fetch_assoc()["link"];
            }else{
                $link = "https://upload.wikimedia.org/wikipedia/commons/thumb/2/2c/Default_pfp.svg/1024px-Default_pfp.svg.png";
            }
            
            
            $_SESSION["pfp"] = $link;


            $uname = $_SESSION["username"];
            $searchid = $conn->query("SELECT id FROM user WHERE username = '$uname'");
            if ($searchid->num_rows > 0){
                $id = $searchid->fetch_assoc()['id'];

                $_SESSION['id'] = $id;
            }

            $searcharray = $conn->query("SELECT watchlist FROM user WHERE id = '$id'");
            $row = $searcharray->fetch_assoc();
            $_SESSION["watchlist"] = $row["watchlist"];

        }
        else {
            echo "<script> alert('Wrong password, try again'); </script>";
        }
    }
    else {
        echo "<script> alert('User not registered'); </script>";
    }
}

/*
if($_SESSION['login'] == TRUE){
    header("Location: ../");
}
*/
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Login to PinkMango</title>
    
</head>
<body>
    <div class="icon"><a href="../"><i class='bx bx-home-alt-2'></i></a><a href="../">Home</a></div>
    <div class = "container">
        <div class="logo">PINKMANGO</div>
        <div class = "signup">
            <form method = "post" action ="">
                <div class="items">
                    <h2>LOGIN</h2>
                    <div class="inputbox">
                        <input type="text" name="username" placeholder="Username" required>
                        <i class='bx bx-user' ></i>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class='bx bx-lock-alt' ></i>
                    </div>
                    <button type="submit" value="Submit" name="login">LOGIN</button>
                    <div class="login">
                        <p>Dont have an account? <a href="../SignUp">Sign Up</a></p>
                    </div>
                </div>
            </form>
        </div>

        <div class="deco">
        </div>
    </div>
</body>
</html>