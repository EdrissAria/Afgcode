<?php
require_once("../include/session.php");
require_once("../include/database.php");

$cid = $_GET["id"];
$viewPost = mysqli_query($link, 
    "SELECT * FROM comments WHERE cid = $cid;");
$row = mysqli_fetch_assoc($viewPost);
     $pid = $row["pid"];
     $username = $row["username"];
     $email = $row["email"];
     $comment = $row["comment"];
     $datetime = $row["sendAt"]; 
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="resources/css/queries.css">
    </head>
    <body>

        <div class="container">
            <div class="row">
                    <div class="comment-view">
                    <h5><span><img src="../image/users.png" style="width: 100px;"></span><?php echo $username; ?><br><?= $email;?></h5>
                    <p><?php echo $comment; ?></p><br>
                    <h6>Date:<br><?php echo $datetime; ?></h6>
                    <a href="viewpost.php?id=<?php echo $pid;?>">View Post</a>
                    </div>
                </div>
            </div>
    </body>
</html>