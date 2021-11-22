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
$deleteComment = mysqli_query($link, "DELETE FROM comments WHERE pid = $id;");
if($deleteComment){
    header("location: comments.php?deleteco=success");
}else{
    header("location: comments.php?notdeleteco=true");
}
}

?>