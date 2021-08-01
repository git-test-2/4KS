<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname= "4sk_new";


// Create connection
$connect = mysqli_connect($servername, $username, $password, $dbname);
//mysqli_set_charset ( $connect , "utf8");


// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

