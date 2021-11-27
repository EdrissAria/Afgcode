<?php
require_once("../include/session.php");
require_once("../include/database.php");
$id = $_GET["id"];
$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];

if($position != "Adminstrator"){
    header("location: comments.php?permission=failed");
}
else{
$aproveComment = mysqli_query($link, "UPDATE comments SET status = 'ON' WHERE cid = $id;");
if($aproveComment){
    header("location: comments.php?aprove=success");
}else{
    header("location: comments.php?notaprove=1");
}
}
?>