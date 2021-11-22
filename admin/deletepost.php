<?php
require_once("../include/session.php");
require_once("../include/database.php");

$id = $_GET["id"];
$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
if($position != "Adminstrator"){
    header("location: Admin_panel.php?permission=failed");
}else{
$deletepost = mysqli_query($link, "DELETE FROM posts WHERE pid = $id;");
if($deletepost){
    header("location: Admin_panel.php?deletep=success");
}
else{
    header("location: Admin_panel.php?notdeletep=true");
}
}
?>