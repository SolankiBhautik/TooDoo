<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "toodoo";

$conn = mysqli_connect($host, $username, $password, $database);

if (mysqli_connect_errno()){
    die("connection error". mysqli_connect_error());
}

?>