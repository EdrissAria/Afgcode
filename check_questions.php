<?php
session_start(); 
require_once("include/database.php");
require_once("include/datetime.php");

 
$option_value = $_GET['value']; 
$question_id = $_GET['qid']; 
 
$query = "select * from questions where qid = $question_id"; 

$result = mysqli_query($link, $query); 
$row = mysqli_fetch_assoc($result);

if(isset($qid_session)){ 
    if($option_value === $row['answer']){
        $_SESSION['score'] += 1;  
    } 
}else{
    $qid_session = $_SESSION[$question_id];
    if($option_value === $row['answer']){
        $_SESSION['score'] = 1;  
    } 
}



