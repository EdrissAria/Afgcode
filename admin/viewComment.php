<?php
require_once("../include/session.php");
require_once("../include/database.php");

$postId = $_GET["id"];
$viewPost = mysqli_query($link, 
    "SELECT * FROM posts INNER JOIN comments ON posts.pid = comments.pid WHERE posts.pid = $postId;");
$row = mysqli_fetch_assoc($viewPost);
     // $postId = $row["pid"];
     // $image = $row["image"];
     // $title = $row["title"];
     // $post = $row["post"];
     // $author = $row["author"];
     // $datetime = $row["createAt"];
    echo $row['comment'];
 
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
                <div class="view-post">
                    <div class="main-area">
                            <img src="<?php echo '../upload/'.$image;?>">
                                <h2><?php echo $title;?></h2>
                                    <p>
                                        <?php echo $post;?>
                                    </p>  
                            <h5>Author: <?php echo $author;?></h5>
                        <h6><?php echo $datetime;?></h6> 
                    </div>
                    </div>
                    <div class="comment-view">
                    <h5><span><img src="../image/users.png" style="width: 100px;"></span><?php echo $username; ?><br><?= $email;?></h5>
                    <p><?php echo $comment; ?></p><br>
                    <h6>Date:<br><?php echo $datetime; ?></h6>
                    </div>
                </div>
            </div>
    </body>
</html>