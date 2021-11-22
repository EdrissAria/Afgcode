<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
$photo = $showPrivilage["photo"];

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
						<li><a href="manageExams.php" class="active">Manage Exams</a></li>
						<li><a href="addquestion.php">Add Questions</a></li>
						<li><a href="Admin_panel.php">Back</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
				<div class="col span-9-of-12" id="wide">
                        <header>
                                <div class="row">
                                    <div class="col span-9-of-12">       
                                    <a class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></a>
                                    <div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>                                    
                                    <h2>Manage Exams</h2>
                                    </div>
                                </div>
                        </header>
				    <table class="dashboard-table">
                    <caption>
                    <?php if(isset($_GET["updateq"])){ echo '<div id="success" class="animated pulse">Question is updated successfully!</div>';}?>
                    <?php if(isset($_GET["deleteq"])){ echo '<div id="success" class="animated pulse">Question is deleted successfully!</div>';}?>
                    <?php if(isset($_GET["permission"])){ echo '<div id="danger" class="animated shake">You con\'t change anything!</div>';}?>
                    </caption>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Questions</th>
                                    <th>Author</th>
                                    <th>Catagory</th>
                                    <th>Date</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $viewQuestion = mysqli_query($link,"SELECT * FROM questions ORDER BY qid desc;");
                            $SrNo = 0;
                            while($rows = mysqli_fetch_assoc($viewQuestion)){
                                $id = $rows["qid"];
                                $DateTime = $rows["createAt"];
                                $catagory = $rows["catagory"];
                                $question = $rows["question"];
                                $author = $rows["author"];
                                $SrNo++;
                                ?>
                                <tr>
                                    <td><?= $SrNo; ?></td>
                                    <td><?= $question; ?></td>
                                    <td><?= $author;?></td>
                                    <td><?= $catagory; ?></td>
                                    <td><?php if(strlen($DateTime)>11){echo substr($DateTime,0,11)."..";}else{ echo $DateTime;} ?></td>
                
                                    <td><a id = "edit" href="editquestion.php?id=<?php echo $id;?>">Edit</a>

                                    <td><a id = "delete" href="deletequestion.php?id=<?php echo $id;?>">Delete</a>

                                    <td><a id = "view" href="viewquestion.php?id=<?php echo $id;?>">View</a>
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