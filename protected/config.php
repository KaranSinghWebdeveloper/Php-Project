<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "newphpwebsite";

$conn = mysqli_connect($servername, $username, $password, $db);

if(!$conn){
    die("Not Connect".mysqli_connect_error());
}










