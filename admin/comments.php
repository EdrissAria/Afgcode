<?php
require_once("../include/session.php");
require_once("../include/database.php");

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
$photo = $showPrivilage["photo"];

?>
<!DOCTYPE html> 
<html>
    <head>
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
						<li><a href="comments.php" class="active">Comments</a></li>
						<li><a href="tags.php">Add New Tag</a></li>
						<li><a href="link.php">Add Back Link</a></li>
						<li><a href="users.php">Users</a></li>
						<li><a href="manageExams.php">Manage Exams</a></li>
						<li><a href="logout.php">Log out</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
                <div class="col span-9-of-12">
                        <header>
                                <div class="row">
                                    <div class="col span-9-of-12" id="wide">       
                                    <a class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></a>
                                    <div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>
                                    <h2>Comments</h2>
                                    </div>
                                </div>
                        </header>
                 <h1 class="comment-header">Unaprove Comments</h1>
                <?php if(isset($_GET["aprove"])): ?> <div id="success" class="animated pulse">Comment aprove successfully!</div><?php endif; ?>
                <?php if(isset($_GET["permission"])): ?> <div id="danger" class="animated shake">You don't have this privilage</div><?php endif; ?>
                <?php if(isset($_GET["notdisaprove"])): ?> <div id="danger" class="animated shake">Can't disaprove comment! please try again</div><?php endif; ?>
                <?php if(isset($_GET["deleteco"])): ?> <div id="success" class="animated pulse">Comment deleted successfully!</div><?php endif; ?>
                <?php if(isset($_GET["notdeleteco"])): ?> <div id="danger" class="animated shake">Can't delete comment! please try again</div><?php endif; ?>
                <?php if(isset($_GET["notviewco"])): ?> <div id="danger" class="animated shake">Can't display the comment! please try again</div><?php endif; ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Comment</th>
                                    <th>Post title</th>
                                    <th>Date</th>
                                    <th>Disapprove</th>
                                    <th>Delete</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $command ="SELECT * FROM posts inner join comments on posts.pid = comments.pid where status = 'ON' order by comments.cid desc;";
                            $viewComment = mysqli_query($link,$command);
                            $SrNo = 0;
                            while($rows = mysqli_fetch_assoc($viewComment)){
                                $id = $rows["pid"];
                                $title = $rows["title"];
                                $postId = $rows["cid"];
                                $DateTime = $rows["createAt"];
                                $username = $rows["username"];
                                $email = $rows["email"];
                                $comment = $rows["comment"];

                                $SrNo++;
                                ?>
                                <tr>
                                    <td><?= $SrNo; ?></td>
                                    <td><?= $username; ?></td>
                                    <td><?php if(strlen($comment)> 7){ echo substr($comment,0,7)."...";}else{ echo $comment;} ?></td>
                                    <td><?= $title ?></td>
                                    <td><?php if(strlen($DateTime)> 7){ echo substr($DateTime,0,7)."...";}else{ echo $DateTime;} ?></td>
                    

                                    <td><a href="disapproveComment.php?id=<?php echo $id;?>" id="disapprove">Disapprove</a></td>

                                    <td><a href="DeleteComment.php?id=<?php echo $id;?>" id="delete">Delete</a></td>
                                     
                                    <td><a href="viewComment.php?id=<?php echo $postId ;?>" id="view">View</a></td>
                                    
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                       <h1 class="comment-header">Aprove Comments</h1>
                       <?php if(isset($_GET["disaprove"])): ?> <div id="success" class="animated pulse">Comment disaprove successfully!</div><?php endif; ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Username</th>
                                    <th>Comment</th>
                                    <th>Post title</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Delete</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                        <tbody>
                        <?php 
                        $query = "SELECT * FROM posts inner join comments on posts.pid = comments.pid where status = 'OFF' order by comments.cid desc;";
                        $viewComment = mysqli_query($link,$query);
                            $SrNo = 0;
                            while($rows = mysqli_fetch_assoc($viewComment)){
                                $id = $rows["pid"];
                                $title = $rows["title"];
                                $postId = $rows["cid"];
                                $DateTime = $rows["createAt"];
                                $username = $rows["username"];
                                $email = $rows["email"];
                                $comment = $rows["comment"];

                                $SrNo++;
                                ?>
                                <tr>
                                    <td><?php echo $SrNo; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td><?php if(strlen($comment)> 7){ echo substr($comment,0,7)."...";}else{ echo $comment;} ?></td>
                                     <td><?php echo $title ?></td>
                                    <td><?php if(strlen($DateTime)> 7){ echo substr($DateTime,0,7)."...";}else{ echo $DateTime;} ?></td>
                    

                                    <td><a href="approveComment.php?id=<?php echo $id;?>" id="edit">Approve</a></td>
                                     

                                    <td><a href="deleteComment.php?id=<?php echo $id;?>" id="delete">Delete</a></td>
                                     

                                    <td><a href="viewComment.php?id=<?php echo $postId ;?>" id="view">Veiw</a></td>
                                     
                                </tr>
                            <?php }?>
                            </tbody>
                        </table>
                    </div>
                  </div>
                </div><!-- ending of main area-->
            </div><!--- ending of row-->
        </div><!--- ending of container-->
        <script type="text/javascript" src="../js/main.js"></script>
    </body>
</html>