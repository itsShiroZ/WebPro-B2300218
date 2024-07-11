<?php

//establish connection with sql database
require '../conn.php';

if (isset($_POST['signUp'])) {
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    $pass = SHA1($pass);

        $checkName="SELECT * FROM user WHERE username = '$uname'";
        $result=$conn->query($checkName);
        if ($result->num_rows>0){
            echo "<script>alert('Username already exist.')</script>";
        }
        else {
            $insertQuery="INSERT INTO user(username, password) VALUES ('$uname','$pass')";

                if($conn->query($insertQuery)==TRUE){
                    header("location: success.html");
                    
                }
                else{
                    echo "Error: " .$conn-> error;
                }
        }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Signup for PinkMango</title>
</head>
<body>
    <div class="icon"><a href="../"><i class='bx bx-home-alt-2'></i></a><a href="../">Home</a></div>
    <div class = "container">
        <div class="logo">PINKMANGO</div>
        <div class = "signup">
            <form method = "post" action ="" autocomplete ="off">
                <div class="items">
                    <h2>SIGN UP</h2>
                    <div class="inputbox">
                        <input type="text" name="username" placeholder="Username" required>
                        <i class='bx bx-user' ></i>
                    </div>
                    <div class="inputbox">
                        <input type="password" name="password" placeholder="Password" required>
                        <i class='bx bx-lock-alt' ></i>
                    </div>
                    <button type="submit" value="Submit" name="signUp">SIGN UP</button>
                    <div class="login">
                        <p>Already have an account? <a href="../Login">Login</a></p>
                    </div>
                </div>
            </form>
        </div>

        <div class="deco">
        </div>
    </div>
</body>
</html>