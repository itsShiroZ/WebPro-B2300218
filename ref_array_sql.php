<?php

require ("conn.php");

echo $_SESSION["id"];

//test array
$watcharray = array("attackontitan", "demonslayer");

//print items in array
foreach ($watcharray as $i) {
    echo "$i <br>";
}

//encode array
$watcharray_sr = base64_encode(serialize($watcharray));
echo "$watcharray_sr <br>";

//update array in sql
$sqli = "UPDATE user SET watchlist = '$watcharray_sr' WHERE id = '12'";
$query = $conn->query($sqli);
//testing
if ($query) {
    echo "UPDATED <br>";
}
else {
    echo "NO UPDATE";
}

//read array from sql

$sqli = "SELECT watchlist FROM user WHERE id='12'";
$query = $conn -> query($sqli);

//decode array
$row = $query->fetch_assoc();
$watchlist_encoded = $row["watchlist"];

$watchlist_ar = unserialize(base64_decode($watchlist_encoded));

//print final array output
print_r($watchlist_ar);

$emp = array();
print_r($emp);

$emp_sr = base64_encode(serialize($emp));
echo $emp_sr;

$emp_ar = unserialize(base64_decode($emp_sr));
print_r($emp_ar);


?>





