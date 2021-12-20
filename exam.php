<?php
session_start();
require_once("include/database.php");
require_once("include/datetime.php");
$cat = $_GET["catagory"];
$_SESSION['score'] = 0;

$total_que = mysqli_query($link, "SELECT * FROM questions WHERE catagory = '$cat'");
$total = mysqli_num_rows($total_que);
?>
<!DOCTYPE html> 
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">   
        <link rel="stylesheet" type="text/css" href="vendors/css/normalize.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/grid.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="vendors/css/animate.css">
        <link rel="stylesheet" type="text/css" href="resources/css/style.css">
        <link rel="stylesheet" type="text/css" href="resources/css/queries.css">
    </head>
    <body style="background-color: #009688;;">
    <!----- question bar ----->
    <div class="container">
       <div class="row">
            <div class="col-sm-8">
            <form method="post">
                <?php
                    $query = "select * from questions where catagory = '$cat'";
                    $showQue = mysqli_query($link,$query);
                    $quenum = 0;
                    while ($row = mysqli_fetch_assoc($showQue)) {
                        $id = $row["qid"];
                        $question = $row["question"];
                        $option1 = $row["opt1"];
                        $option2 = $row["opt2"];
                        $option3 = $row["opt3"];
                        $option4 = $row["opt4"];
                        $answer = $row["answer"];
                        $quenum++;
                ?>
                <div class="question-field">
                    <div class="question-title">
                        <p>Question <?=$quenum;?> of <?php echo $total; ?></p>
                    </div>
                    <div class="question">
                        <?=$question;?>
                    </div>
                    <div class="option" id="option"><label for="<?=$option1;?>"><?=$option1;?></label>
                    <input type="radio" name="<?php echo $id;?>" value="<?=$option1;?>" id="<?=$option1;?>"></div>
                    <div class="option" id="option"><label for="<?=$option2;?>"><?=$option2;?></label>
                    <input type="radio" name="<?php echo $id;?>" value="<?=$option2;?>" id="<?=$option2;?>"></div>
                    <div class="option" id="option"><label for="<?=$option3;?>"><?=$option3;?></label>
                    <input type="radio" name="<?php echo $id;?>" value="<?=$option3;?>" id="<?=$option3;?>"></div>
                    <div class="option" id="option"><label for="<?=$option4;?>"><?=$option4;?></label>
                    <input type="radio" name="<?php echo $id;?>" value="<?=$option4;?>" id="<?=$option4;?>"></div>
                    <?php
                    if(isset($_POST[$id])){
                        if($_POST[$id] === $answer){
                            $_SESSION['score'] ++; 
                        }
                    }
                    ?>
                </div>
                <?php
                    }
                ?>
                <div class="buttons_group">
                <a href="blog.php" class="logout">&lArr;Log out</a>
                <input type="submit" name="submit" value="Finish &rArr;" class="finish">
                </div>
                <?php
                    if(isset($_POST["submit"])){
                        header("location:result.php?catagory=$cat");
                    }

                ?>            
                        
             </form>  
            </div>
          </div>
         </div> 
         <!----- main footer ----->
         <?php include('footer.php'); ?>
    </body>
</body>
</html>