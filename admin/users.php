<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
$photo = $showPrivilage["photo"];

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $hashpassword = md5($password);
    $confirm = $_POST["confirmp"];
    $image = $_FILES["image"]["name"];
    $target = "upload/".$_FILES["image"]["name"];
    $privilage = $_POST["position"];
    $datetime;
    $admin = $_SESSION["login"];
if(empty($username) || empty($password) || empty($email) || empty($confirm) || empty($privilage) || empty($image)){
    header("location: users.php?fill=false");
}elseif(strlen($password)<4){
    header("location: users.php?smallp=true");
}elseif($password !== $confirm){
    header("location: users.php?match=false");
}else{
    /*if($position != "Adminstrator"){
        header("location: users.php?permission=failed");
    }
    else{
        */
    $record = mysqli_query($link, "INSERT INTO admins (username, email, password, createAt, photo, position) 
    VALUES('$username','$email','$hashpassword','$datetime','$image', '$privilage');");
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    if($record){
        header("location: users.php?addu=success");
    }else{
        header("location: users.php?notaddu=true");
    }
}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Users</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/queries.css">
	</head>
	<body>
    <div class="container">
			<div class="row">
              <nav>
				<div class="col span-3-of-12" id="out">
                <div class="row logo-place">
                        <a href="Front-end/index.php"><img src="../image/logo.png"></a><span class="mobile-nav-icon2" id="slide-out-menu2"><i class="ion-navicon-round"></i></span>
                    </div>
					<ul class="dashboard">
                    <li><a href="Admin_panel.php">Dashboard</a></li>
						<li><a href="addpost.php">Add New Post</a></li>
						<li><a href="catagories.php">Catagories</a></li>
						<li><a href="comments.php">Comments
                        <?php
                            $QueryTotal="SELECT COUNT(*) FROM comments WHERE status='OFF'";
                            $ExecuteTotal=mysqli_query($link,$QueryTotal);
                            $RowsTotal=mysqli_fetch_array($ExecuteTotal);
                            $Total=array_shift($RowsTotal);
                            if($Total>0){
                            ?>
                            <span class="badge">
                            <?php echo $Total;?>
                            </span>
                                    
                            <?php } ?>
                        </a></li>
						<li><a href="tags.php">Add New Tag</a></li>
						<li><a href="link.php">Add back Link</a></li>
						<li><a href="users.php" class="active">Users</a></li>
						<li><a href="manageExams.php">Manage Exams</a></li>
						<li><a href="logout.php">Log out</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
				<div class="col span-9-of-12" id="wide">
                        <header>
                                <div class="row">
                                    <div class="col span-9-of-12" id="wide">       
                                    <a class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></a>
                                    <div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>
                                    <h2>Manage Users</h2>
                                    </div>
                                </div>
                        </header>
					       
                            <form method="post" enctype="multipart/form-data">
                            <?php if(isset($_GET["fill"])): ?><div id="danger" class="animated shake">All field must be filled!</div><?php endif; ?>
                            <?php if(isset($_GET["smallp"])): ?><div id="danger" class="animated shake">password shoud have at least 4 characters!</div><?php endif; ?>
                            <?php if(isset($_GET["addu"])): ?><div id="success" class="animated pulse">User created successfully</div><?php endif; ?>
                            <?php if(isset($_GET["notaddu"])): ?><div id="danger" class="animated shake">User failed to add!</div><?php endif; ?>
                            <?php if(isset($_GET["deleteu"])): ?><div id="success" class="animated pulse">User deleted successfully!</div><?php endif; ?>
                            <?php if(isset($_GET["notdeleteu"])): ?><div id="danger" class="animated shake">User failed to delete!</div><?php endif; ?>
                            <?php if(isset($_GET["match"])): ?><div id="danger" class="animated shake">Retype doesn't match!</div><?php endif; ?>
                            <?php if(isset($_GET["permission"])): ?><div id="danger" class="animated shake">You don't have this permission!</div><?php endif; ?>
                            	<div class="row">
                                <div class="col span-6-of-12">
                                <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" name="username" placeholder="username" class="form-control" id="name">
                                </div>
                                <div class="form-group">
                                <label for="pass">Password</label>
                                <input type="password" name="password" placeholder="password" class="form-control" id="pass">
                                </div>
                                <label for="role">Role</label>
                                        <select name="position" id="role">
                                            <option>Subscriber</option>
                                            <option>Author</option>
                                            <option>Editor</option>
                                            <option>Adminstrator</option>
                                        </select>
                                </div>
                                <div class="col span-6-of-12">
                                <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="text" name="email" placeholder="email" class="form-control" id="email">
                                </div>
                                <div class="form-group">
                                <label for="passc">Confirm</label>
                                <input type="password" name="confirmp" class="form-control" n placeholder="retype">
                                </div>
                                    <label for="image">Choose an image</label>
                                    <input type="file" name="image">
                                </div>
                                </div>
                                       
                                    <input type="submit" name="submit" value="Add User">
                                    
                        </form>

                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $command ="SELECT * FROM admins;";
                            $viewUsers = mysqli_query($link,$command);
                            $SrNo = 0;
                            while($rows = mysqli_fetch_assoc($viewUsers)){
                                $id = $rows["aid"];
                                $role = $rows["position"];
                                $DateTime = $rows["createAt"];
                                $username = $rows["username"];
                                $email = $rows["email"];
                                $SrNo++;
                                ?>
                                <tr>
                                    <td><?= $SrNo; ?></td>
                                    <td><?= $username; ?></td>
                                    <td><?= $email; ?></td>
                                    <td><?= $role; ?></td>
                                    <td><?= $DateTime?></td>                     
                                    <td><a href="deleteUser.php?id=<?php echo $id;?>" id="delete">Delete</a></td>                                    
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
			</div><!-- ending of row-->
        </div><!-- ending of container-->
        <script type="text/javascript" src="../js/main.js"></script>
	</body>
</html>