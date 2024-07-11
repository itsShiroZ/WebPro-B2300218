<?php
//start session
session_start();

//define host, user, pass and db name
$host = "localhost";
$user = "root";
$password = "";
$db = "PinkMango";

//error handling when connection failed
try {
    $conn = new mysqli($host, $user, $password, $db);
}
catch(Exception $e){
    //open an error html when connection failed
    header('Location: http://localhost/PinkMango/error.html');
    die();
}

