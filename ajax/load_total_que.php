<?php 
session_start(); 
require_once("../include/database.php");
require_once("../include/datetime.php");

$cat = $_GET["catagory"];
$total_que = 0; 

$total = mysqli_query($link, "SELECT * FROM questions WHERE catagory = '$cat' "); 
$res = mysqli_num_rows($total);

$total_que = $res; 

echo $total_que; 


