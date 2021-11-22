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
    $catagory = ($_POST["catagory"]);
    $image = $_FILES["image"]["name"];
    $admin = $_SESSION["login"];
    $target= "upload/".$_FILES["image"]["name"];
if(empty($catagory)){
    header("location: catagories.php?fill=true");
}elseif(strlen($catagory)>99){
    header("location: catagories.php?longc=true");
}else{
	if($position == "Subscriber"){
		header("location: catagories.php?permission=failed");
	}
    else{
    $record = mysqli_query($link, "INSERT INTO catagories (name,creator,createAt) VALUES ('$catagory','$admin','$datetime');");
    move_uploaded_file($_FILES["image"]["tmp_name"], $target);
    if($record){
        header("location: catagories.php?addc=success");
    }else{
        header("location: catagories.php?notaddc=true");
    }
}
}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Catagories</title>
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
					<li><a href="Admin_panel.php"> Dashboard</a></li>
						<li><a href="addpost.php"> Add New Post</a></li>
						<li><a href="catagories.php" class="active"> Catagories</a></li>
						<li><a href="comments.php"> Comments
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
						<li><a href="link.php">Add Back Link</a></li>
						<li><a href="users.php">Users</a></li>
						<li><a href="manageExams.php">Manage Exams</a></li>
						<li><a href="logout.php"> Log out</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
				<div class="col span-9-of-12">
				        <header>
                                <div class="row">
                                    <div class="col span-9-of-12">       
                                    <span class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></span>
									<div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>
									<h2>Catagories</h2>
                                    </div>
                                </div>
                        </header>
					<form method="post" enctype="multipart/form-data">
					<?php if(isset($_GET["fill"])): ?>
			                    <div id="danger" class="animated shake">All fields are required!</div>
			                <?php endif; ?>
			                <?php if(isset($_GET["Longc"])):  ?>
			                     <div id="danger" class="animated shake">Too long name for catagory!</div>
			                <?php endif; ?>
			                <?php if(isset($_GET["addc"])):  ?>
			                     <div id="success" class="animated pulse">Catagory is added successfully!</div>
			                <?php endif; ?>
			                <?php if(isset($_GET["notaddc"])):  ?>
			                     <div id="danger" class="animated shake">Can not add catagory!</div>
			                <?php endif; ?>
			                <?php if(isset($_GET["deletec"])):  ?>
			                     <div id="success" class="animated pulse">Catagory deleted successfully</div>
			                <?php endif; ?>
			                <?php if(isset($_GET["notdeletec"])):  ?>
			                     <div id="danger" class="animated shake">Can not delete catagory!</div>
			                <?php endif; ?>
							<?php if(isset($_GET["permission"])):  ?>
			                     <div id="danger" class="animated shake">You don't have this privilage!</div>
			                <?php endif; ?>
						<label for="cat">Catagory</label>
						<input type="text" name="catagory" placeholder="Catagory" id="cat">
						<label>Choose an image</label>
						<input type="file" name="image">
						<input type="submit" name="submit" id="button" class="btn btn-block my-4" value="Add New Catagory">
					</form>
					<table>
						<thead>
							<tr>
							<th>No</th>
							<th>Name</th>
							<th>Datetime</th>
							<th>Creator</th>
							<th>Delete</th>
							<tr>
						</thead>
						<tbody>
							<?php 
                             	$showCatagory = mysqli_query($link, "SELECT * FROM catagories ORDER BY createAt;");
                             	$no = 0;
                             	while ($row = mysqli_fetch_assoc($showCatagory)) {
                             		$catagoryId = $row["catid"];
                             		$catagory = $row["name"];
                             		$datetime = $row["createAt"];
                             		$creator = $row["creator"];
                             		$no++;

							?>
						    <tr>
								<td><?=$no;?></td>
								<td><?=$catagory;?></td>
								<td><?=$datetime;?></td>
								<td><?=$creator;?></td>
								<td><a href="deletecatagory.php?id=<?= $catagoryId;?>">Delete</a></td>
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