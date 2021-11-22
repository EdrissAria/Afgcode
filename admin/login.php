<?php
session_start();
require_once("../include/database.php");  
     if(isset($_POST["username"])){
         $username = $_POST["username"];
         $password = $_POST["password"];
	     $hash = md5($password);
       if(empty($username) || empty($password)){
           header("location: login.php?fill=false");
       }
        else{
		$query = mysqli_query($link, "SELECT * FROM admins WHERE username = '$username' AND password = '$hash';");
		$result = mysqli_num_rows($query);
			if($result == 1){
				$_SESSION["login"] = $username;
				header("location: Admin_panel.php?login=success");
			}else{
				header("location: login.php?notlogin=true");
			}
		}
	 } 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/queries.css">
	</head>
	<body>
		<div class="row">
				<form method="post" class="login-form <?php if(isset($_GET['notlogin'])){ echo 'animated shake';}?>">
				  <div class="error">
				   <?php if(isset($_GET["login"])){ echo '<div id="danger" class="animated shake">Login is required</div>';}?>
				  </div>
					<label for="name">Username</label>
					<input type="text" name="username" placeholder="username" required style="<?php if(isset($_GET["notlogin"])){echo "outline: 2px solid red;";}?>" >
					<label for="pass">Password</label>
					<input type="password" name="password" placeholder="password" required style="<?php if(isset($_GET["notlogin"])){echo "outline: 2px solid red;";}?>">
					<input type="submit" name="submit" value="Login">
				</form>
		</div>

	</body>
</html>