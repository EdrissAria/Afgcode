<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$show = mysqli_fetch_assoc($showUser);
$position = $show["position"];
$photo = $show["photo"];
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Catagories</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../font/css/all.css">   
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
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
                        <a href="Front-end/index.php"><img src="../image/logo.png"></a>
                        <span class="mobile-nav-icon2" id="slide-out-menu2"><i class="fab fa-facebook"></i>
                        </span>
                    </div>
  					<ul class="dashboard">
						<li><a href="Admin_panel.php" class="active">Dashboard</a></li>
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
                        <li><a href="link.php">Add Back Link</a></li>
						<li><a href="users.php">Users</a></li>
						<li><a href="manageExams.php">Manage Exams</a></li>
						<li><a href="logout.php">Log out</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
				<div class="col span-9-of-12" id="wide">
                        <header>
                                <div class="row">
                                    <div class="col span-9-of-12">       
                                    <a class="mobile-nav-icon" id="slide-out-menu"><i class="fab fa-facebook"></i></a>
                                    <div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>
                                    <h2>Admin Dashboard</h2>
                                    </div>
                                </div>
                        </header>
                    <table class="dashboard-table">
                            <caption><?php if(isset($_GET["updatep"])){echo '<div id="success" class="animated pulse">Post is updated successfully!</div>';}?>
                                <?php if(isset($_GET["deletep"])){echo '<div id="success" class="animated pulse">Post is deleted successfully!</div>';}?>
                                <?php if(isset($_GET["permission"])){echo '<div id="danger" class="animated shake">You can\'t delete any thing!</div>';}?>
                                <?php if(isset($_GET["permissionu"])){echo '<div id="danger" class="animated shake">You can\'t edit any thing!</div>';}?></caption>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Date</th>
                                    <th>Catagory</th>
                                    <th>Banner</th>
                                    <th>Comments</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>view</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                             
                            $viewPosts = mysqli_query($link,"SELECT * FROM posts ORDER BY pid desc;");
                            $SrNo = 0;
                            while($rows = mysqli_fetch_assoc($viewPosts)){
                                $id = $rows["pid"];
                                $DateTime = $rows["createAt"];
                                $catagory = $rows["catagory"];
                                $Author = $rows["author"];
                                $title = $rows["title"];
                                $image = $rows["image"];
                                $SrNo++;
                                ?>
                                <tr>
                                    <td><?= $SrNo; ?></td>
                                    <td><?= $title; ?></td>
                                    <td><?= $Author; ?></td>
                                    <td><?php if(strlen($DateTime)>11){echo substr($DateTime,0,11)."..";}else{ echo $DateTime;} ?></td>
                                    <td><?= $catagory; ?></td>
                                    <td><img src="<?= "../upload/".$image ;?>"></td>
                                    <td><?php 
                                    $approveComment = mysqli_query($link,"SELECT COUNT(*) FROM comments WHERE 
                                    pid = $id AND status = 'ON'");
                                    $rowApprove = mysqli_fetch_assoc($approveComment);
                                    $totalApprove = array_shift($rowApprove);
                                    if($totalApprove>0){
                                    ?>
                                    <span class="badge-approve"><?= $totalApprove;?></span>
                                    <?php }?>

                                    <?php
                                    $unapproveComment = mysqli_query($link, "SELECT COUNT(*) FROM comments 
                                    WHERE pid=$id AND status = 'OFF' ");
                                    $rowUnpprove = mysqli_fetch_assoc($unapproveComment);
                                    $totalUnapprove = array_shift($rowUnpprove);
                                    if($totalUnapprove>0){
                                    ?>
                                    <span class="badge-unapprove"><?=$totalUnapprove;?></span>
                                    <?php } ?>
                                    <td><a href="editpost.php?id=<?php echo $id;?>">Edit</a>

                                    <td><a href="deletepost.php?id=<?php echo $id;?>">Delete</a>

                                    <td><a href="viewpost.php?id=<?php echo $id;?>">View</a>
                                </tr>
                            <?php }?>
                            </tbody>
                    </table>
			</div><!-- ending of row-->
        </div><!-- ending of container-->
        <script type="text/javascript" src="../js/main.js"></script>
	</body>
</html>