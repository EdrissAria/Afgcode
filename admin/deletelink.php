<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$id = $_GET["id"];

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];

$showcatagory = mysqli_query($link, "SELECT * FROM links WHERE creator = '$user'");
$row = mysqli_fetch_assoc($showcatagory);
$creatorname = $row["creator"];

if($position == "Subscriber" || $position == "Author"){
	header("location: link.php?permission=failed");
}elseif($position == "Editor"){
	if($creatorname == $user){
		$deletecatagory = mysqli_query($link, "DELETE FROM links WHERE lid=$id");
		if($deletecatagory){
			header("location: link.php?deletec=success");
		}else{
			header("location: link.php?notdeletec=true");
		}
	}else{
		header("location: link.php?permission=failed");
	}
}else{
$deletecatagory = mysqli_query($link, "DELETE FROM links WHERE lid=$id");
if($deletecatagory){
	header("location: link.php?deletec=success");
}else{
	header("location: link.php?notdeletec=true");
}
}


?>