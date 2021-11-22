<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$id = $_GET["id"];
$user = $_SESSION["login"];

$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
if($position != "Adminstrator"){
    header("location: manageExams.php?permission=failed");
}else{
    $deleteQuestion = mysqli_query($link, "DELETE FROM questions WHERE qid = $id;");
if($deleteQuestion){
    header("location: manageExams.php?deleteq=success");
}else{
    header("location: manageExams.php?notdeleteq=true");
}
}
?>
