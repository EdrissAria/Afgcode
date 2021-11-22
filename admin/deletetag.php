<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$id = $_GET["id"];

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];

$showcatagory = mysqli_query($link, "SELECT * FROM tags WHERE creator = '$user'");
$row = mysqli_fetch_assoc($showcatagory);
$creatorname = $row["creator"];

if($position == "Subscriber" || $position == "Author"){
	header("location: tags.php?permission=failed");
}elseif($position == "Editor"){
	if($creatorname == $user){
		$deletecatagory = mysqli_query($link, "DELETE FROM tags WHERE tid=$id");
		if($deletecatagory){
			header("location: tags.php?deletec=success");
		}else{
			header("location: tags.php?notdeletec=true");
		}
	}else{
		header("location: tags.php?permission=failed");
	}
}else{
$deletecatagory = mysqli_query($link, "DELETE FROM tags WHERE tid=$id");
if($deletecatagory){
	header("location: tags.php?deletec=success");
}else{
	header("location: tags.php?notdeletec=true");
}
}


?>