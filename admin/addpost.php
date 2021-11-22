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
    $catagory = $_POST["catagory"];
    $title = $_POST["title"];
    $tag = $_POST["tag"];
    $image = $_FILES["image"]["name"];
    $post = nl2br($_POST["post"]);
    $author = $_SESSION["login"];
    $target= "upload/".$_FILES["image"]["name"];
if(empty($catagory) || empty($title) || empty($image) || empty($post)){
    header("location: addpost.php?fill=false");
}elseif(strlen($catagory)>99 && strlen($title)>99){
    header("location: AddNewPost.php?longt=true");
}else{
    if($position == "Subscriber"){
        header("location: addpost.php?permission=failed");
    }else{
        $newPost = "INSERT INTO posts(createAt,title,catagory,author,image,post, tag, aid) 
        VALUES('$datetime', '$title', '$catagory', '$author', '$image', '$post', '$tag', $aid);";
        $records = mysqli_query($link,$newPost);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target);
        if($records){
            header("location: addpost.php?addp=success");
        }else{
            header("location: addpost.php?notaddp=true");
        }
}
}
}
?> 
<!DOCTYPE html>
<html>
	<head>
		<title>Posts</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	
  
        <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/queries.css">
		<script src="../ckeditor/ckeditor.js"></script>
	 
	<link rel="stylesheet" href="css/samples.css">
	<link rel="stylesheet" href="css/neo.css">
<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="description" content="Try the latest sample of CKEditor 4 and learn more about customizing your WYSIWYG editor with endless possibilities.">
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
						<li><a href="addpost.php" class="active">Add New Post</a></li>
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
                                    <?php if(isset($_GET["Longt"])):  ?>
                                        <div id="danger" class="animated shake">Too long name for title!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["addp"])):  ?>
                                        <div id="success" class="animated pulse">Post is added successfully!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["notaddp"])):  ?>
                                        <div id="danger" class="animated shake">Can not add post!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["permission"])):  ?>
                                        <div id="danger" class="animated shake">You don't have this privilage!</div>
                                    <?php endif; ?>
                            	<div class="row">
                            	    <div class="col span-6-of-12">
                                        <label for="title">Title</label><br>
                                        <input type="text" name="title" placeholder="title" id="title">
                                    </div>
                                    <div class="col span-6-of-12">
                                        <label for="cat">Catagory Name</label><br>
                                        <select name="catagory"class="form-control" id="cat">
                                        <?php 
                                            $viewCatagory = mysqli_query($link,"SELECT * FROM catagories ORDER BY catid desc;");
                                            while($rows = mysqli_fetch_assoc($viewCatagory)){
                                                $id = $rows["id"];
                                                $CatagoryName = $rows["name"];?>
                                            <option><?php echo $CatagoryName;?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col span-12-of-12">
                                            
                                        <label for="tag">Tag</label><br>
                                        <select name="tag"class="form-control" id="tag">
                                        <?php 
                                            $viewtags = mysqli_query($link,"SELECT * FROM tags ORDER BY tid desc;");
                                            while($rows = mysqli_fetch_assoc($viewtags)){
                                                $id = $rows["tid"];
                                                $tagName = $rows["tag"];?>
                                            <option><?php echo $tagName;?></option>
                                            <?php } ?>
                                            <label for="img">Post Image</label><br>
                                            <input type="file" name="image" id="img">
                                            <label for="post">Post</label><br>
                                            <textarea class="form-control" id="editor" name="post" rows="10" placeholder="new post..."></textarea><br>
                                            <input type="submit" name="submit" id="button" value="Add New Post">
                                        </div>
                                   </div>
                            </div>
                      </form>   
				</div>
			</div><!-- ending of row-->
        </div><!-- ending of container-->
	<script>
	initSample();
	</script>
        <script type="text/javascript" src="../js/main.js"></script>
	<script>
		CKEDITOR.replace('editor');
	</script>
	</body>
</html>