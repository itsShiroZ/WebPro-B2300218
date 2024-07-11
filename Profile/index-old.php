<?php

    require "../conn.php";

    if (isset($_POST["logout"])) {

        $_SESSION['login'] = FALSE;
        header("Location: ../Login");
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <?php 
        if ($_SESSION['login'] == TRUE) {
            echo "Logged in";
        }
        else {
            echo "Logged out";
        }
    ?>
    <form method="post" action="">
        <button type="submit" value="Submit" name="logout">Logout</button>
    </form>
    <a href="../CMS">CMS</a>
</body>
</html>