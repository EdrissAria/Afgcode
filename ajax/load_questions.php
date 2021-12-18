<?php 
session_start(); 
require_once("../include/database.php");
require_once("../include/datetime.php");

$cat = $_GET["catagory"];
$no = $_GET["qno"]; 

$question_no = ""; 
$question = ""; 
$opt1 = ""; 
$opt2 = ""; 
$opt3 = ""; 
$opt4 = "";
$answer = ""; 
$ans = ""; 


