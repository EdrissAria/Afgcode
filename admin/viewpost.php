<?php
require_once("../include/session.php");
require_once("../include/database.php");
    $id = $_GET["id"];

    $showPost = mysqli_query($link, "SELECT * FROM posts WHERE pid = $id;");
    $rows = mysqli_fetch_assoc($showPost);
    $image = $rows["image"];
    $title = $rows["title"];
    $post = $rows["post"];
    $author = $rows["author"];
    $datetime = $rows["createAt"];
?>
<!DOCTYPE html> 
<html>
    <head>
    <title>View Post</title>
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
                <div class="view-post">
                    <div class="main-area">
                        <img src="<?='../upload/'.$image;?>">
                            <h2><?=$title;?></h2>
                                <p>
                                    <?=$post;?>
                                </p>  
                            <h5>Author: <?=$author;?></h5>
                        <h6><?=$datetime;?></h6> 
                    </div>
                </div>
            </div>
        </div>
</body>
</html>