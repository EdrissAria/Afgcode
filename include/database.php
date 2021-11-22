<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "afgcode";

$link = mysqli_connect($server, $username, $password)
or die("Can not connect to the database!");
$db = mysqli_select_db($link, $database);

       
?>