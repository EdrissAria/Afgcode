<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");


$id = $_GET["id"];
$user = $_SESSION["login"];
$selectPost = mysqli_query($link, "SELECT * FROM posts WHERE pid = $id;");
$row = mysqli_fetch_assoc($selectPost);
$author = $row["author"];

if(isset($_POST["submit"])){
    $title = $_POST["title"];
    $catagory = $_POST["catagory"];
    $image = $_FILES["image"]["name"];
    $post = $_POST["post"];
    
    $showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
    $showPrivilage = mysqli_fetch_assoc($showUser);
    $position = $showPrivilage["position"];

    if($position == "Subscriber"){
        header("location: Admin_panel.php?permissionu=failed");
    }
    elseif($position == "Author"){
        if($author == $user){
            $editPost = mysqli_query($link,"UPDATE posts SET title = '$title', catagory = '$catagory', createAt = '$datetime', 
            image = '$image', post = '$post' WHERE pid = $id");
            $target = "Upload/".$_FILES["image"]["name"];
            if($editPost){
                move_uploaded_file($_FILES["image"]["tmp_name"], $target);
                header("location: Admin_panel.php?updatep=success");
            }
            else{
                header("location: editpost.php?notupdatep=true");
            }
        }else{
            header("location: Admin_panel.php?permission=failed");
        }
    }
    elseif($position == "Editor"){
            $editPost = mysqli_query($link,"UPDATE posts SET title = '$title', catagory = '$catagory', createAt = '$datetime', 
            image = '$image', post = '$post' WHERE pid = $id");
            $target = "Upload/".$_FILES["image"]["name"];
            if($editPost){
                move_uploaded_file($_FILES["image"]["tmp_name"], $target);
                header("location: Admin_panel.php?updatep=success");
            }
            else{
                header("location: editpost.php?notupdatep=true");
            }
        } 
    else{
        $editPost = mysqli_query($link,"UPDATE posts SET title = '$title', catagory = '$catagory', createAt = '$datetime', 
        image = '$image', post = '$post' WHERE pid = $id");
        $target = "Upload/".$_FILES["image"]["name"];
        if($editPost){
            move_uploaded_file($_FILES["image"]["tmp_name"], $target);
            header("location: Admin_panel.php?updatep=success");
        }
        else{
            header("location: editpost.php?notupdatep=true");
        }
    } 



}


 

?>

<!DOCTYPE html> 
<html>
    <head>
    <title>Edit Post</title>
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
       <?php if(isset($_GET["notupdatep"])){ echo '<div id="danger" class="animated bounce">Post can not be updated!</div>';}?>
       <?php if(isset($_GET["editor"])){ echo '<div id="danger" class="animated bounce">You don\'t have this privilage editor!</div>';}?>
       <?php if(isset($_GET["admin"])){ echo '<div id="danger" class="animated bounce">You don\'t have this privilage admin!</div>';}?>
       <div class="edit-post">
                <form method="post" enctype="multipart/form-data">
                <div class="image-header"><img src="<?php echo "../Upload/".$row["image"];?>"></div>
                                <label for="title">Title</label>
                                <input type="text" name="title" placeholder="title" class="form-control" id="title" value="<?= $row["title"];?>"><br><br>
                                <span>existing catagory: <?php echo $row["catagory"]?></span><br><br>
                                <label for="cat">Catagory Name</label>
                                <select name="catagory"class="form-control" id="cat">
                                <?php 
                                    $viewCatagory = mysqli_query($link,"SELECT * FROM catagories ORDER BY catid desc;");
                                    while($rows = mysqli_fetch_assoc($viewCatagory)){
                                        $id = $rows["catid"];
                                        $CatagoryName = $rows["name"];?>
                                    <option><?php echo $CatagoryName;?></option>
                                    <?php } ?>
                                </select>
                                <label for="img">Post Image</label>
                                <input type="file" name="image" class="form-control" id="img">
                                <label for="post">Post</label>
                                <textarea class="form-control" name="post" rows="4" placeholder="new post..."><?= $row["post"];?></textarea><br>
                                <input type="submit" name="submit" id="button" class="btn btn-block" value="Change Post"><br>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>