<?php
require_once("../include/session.php");
require_once("../include/database.php");

$id = $_GET["id"];
$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
if($position != "Adminstrator"){
    header("location: users.php?permission");
}
else{
$deleteUser = mysqli_query($link, "DELETE FROM admins WHERE aid = $id;");
if($deleteUser){
    header("location: users.php?deleteu=success");
}else{
    header("location: users.php?notdeleteu=true");
}
}
?>