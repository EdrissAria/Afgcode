<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
$aid = $showPrivilage["aid"];
$photo = $showPrivilage["photo"];

if(isset($_POST["submit"])){
    $linkName = $_POST["lname"];
    $linkOwner = $_POST["lowner"];
    $linkUrl = $_POST["lurl"];
    $image = $_FILES["image"]["name"];
    $author = $_SESSION["login"];
    $target= "../upload/".$_FILES["image"]["name"];
if(empty($linkName) || empty($linkUrl) || empty($image) || empty($linkOwner)){
    header("location: link.php?fill=false");
}elseif(strlen($linkName)>50 && strlen($linkOwner)>50){
    header("location: link.php?longt=true");
}else{
    if($position == "Subscriber"){
        header("location: link.php?permission=failed");
    }else{
        $newlink = "INSERT INTO links(createAt,linkName,linkOwner,creator,linkImage,linkUrl) 
        VALUES('$datetime', '$linkName', '$linkOwner', '$author', '$image', '$linkUrl');";
        $records = mysqli_query($link,$newlink);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        if($records){
            header("location: link.php?addp=success");
        }else{
            header("location: link.php?notaddp=true");
        }
}
}
}
?> 
<!DOCTYPE html>
<html>
	<head>
		<title>Links</title>
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
            <!----- main navigation ----->
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
                        <li><a href="tags.php" class="active">Add Back Link</a></li>
						<li><a href="users.php">Users</a></li>
						<li><a href="manageExams.php">Manage Exams</a></li>
						<li><a href="logout.php">Log out</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
                  <!----- main area ----->
			  <div class="col span-9-of-12" id="wide">
                        <header>
                                <div class="row">
                                    <div class="col span-9-of-12">       
                                    <a class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></a>
                                    <div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>
                                    <h2>Add Post</h2>
                                    </div>
                                </div>
                        </header>
                                    <form method="post" enctype="multipart/form-data">
                                    <?php if(isset($_GET["fill"])): ?>
                                        <div id="danger" class="animated shake">All fields are required!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["Longt"])): ?>
                                        <div id="danger" class="animated shake">Too long name for a link name!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["addp"])):  ?>
                                        <div id="success" class="animated pulse">link is added successfully!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["deletec"])):  ?>
                                        <div id="success" class="animated pulse">link deleted successfully!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["notaddp"])):  ?>
                                        <div id="danger" class="animated shake">Can not add link!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["permission"])):  ?>
                                        <div id="danger" class="animated shake">You don't have this permision!</div>
                                    <?php endif; ?>
                            	<div class="row">
                            	    <div class="col span-6-of-12">
                                        <label for="lo">Link Owner</label><br>
                                        <input type="text" name="lowner" placeholder="link owner" id="lo">
                                    </div>
                                    <div class="col span-6-of-12">
                                        <label for="lu">Link Url</label><br>
                                        <input type="text" name="lurl" placeholder="link url" id="lu">
                                    </div>
                                    <div class="row">
                                        <div class="col span-12-of-12">
                                            <label for="img">Post Image for link</label><br>
                                            <input type="file" name="image" id="img">
                                            <label for="ln">Link name</label><br>
                                            <input type="text" name="lname" placeholder="link name" id="ln">
                                            <input type="submit" name="submit" id="button" value="Add New Post">
                                        </div>
                                   </div>
                            </div>
                      </form>   
                      <table>
						<thead>
							<tr>
							<th>No</th>
							<th>Link Name</th>
							<th>Link Owner</th>
							<th>Link Url</th>
							<th>Delete</th>
							<tr>
						</thead>
						<tbody>
							<?php 
                             	$showCatagory = mysqli_query($link, "SELECT * FROM links ORDER BY createAt;");
                             	$no = 0;
                             	while ($row = mysqli_fetch_assoc($showCatagory)) {
                             		$linkid = $row["lid"];
                             		$linkname = $row["linkName"];
                             		$linkowner = $row["linkOwner"];
                             		$linkurl = $row["linkUrl"];
                             		$no++;
							?>
						    <tr>
								<td><?=$no;?></td>
								<td><?=$linkname;?></td>
								<td><?=$linkowner;?></td>
								<td><?=$linkurl;?></td>
								<td><a href="deletelink.php?id=<?= $linkid;?>">Delete</a></td>
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