<?php
session_start();
require_once("include/database.php");
require_once("include/datetime.php");

 
$_SESSION["quiz_result"] = 0;
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
                    $query = "SELECT * FROM questions INNER JOIN answers ON questions.qid = answers.queid
                     where catagory = 'CSS';
                    ";
                    $showquestion = mysqli_query($link, $query);
                    $quenum = 0;
                    while($row = mysqli_fetch_assoc($showquestion)){
                        $question_id = $row["qid"];
                        $answer_id = $row["queid"];
                        $catagory = $row["catagory"];
                        $question = $row["question"];
                        $option1 = $row["opt1"];
                        $option2 = $row["opt2"];
                        $option3 = $row["opt3"];
                        $option4 = $row["opt4"];
                        $answer = $row["correctOpt"];
                        $quenum++;
                    
                ?>
                <div class="question-field">
                    <div class="question-title">
                        <p>Question <?=$quenum;?> of 5</p>
                    </div>
                    <div class="question">
                        <?=$question;?>
                    </div>
                    <div class="option" id="option"><label for="<?php echo $option1;?>"><?php echo $option1;?></label>
                    <input type="radio" name="<?php echo $question_id;?>" value="<?php echo $option1;?>" id="<?php echo $option1;?>"></div>
                    <div class="option" id="option"><label for="<?php echo $option2;?>"><?php echo $option2;?></label>
                    <input type="radio" name="<?php echo $question_id;?>" value="<?php echo $option2;?>" id="<?php echo $option2;?>"></div>
                    <div class="option" id="option"><label for="<?php echo $option3;?>"><?php echo $option3;?></label>
                    <input type="radio" name="<?php echo $question_id;?>" value="<?php echo $option3;?>" id="<?php echo $option3;?>"></div>
                    <div class="option" id="option"><label for="<?php echo $option4;?>"><?php echo $option4;?></label>
                    <input type="radio" name="<?php echo $question_id;?>" value="<?php echo $option4;?>" id="<?php echo $option4;?>"></div>
                    <?php
                    if(isset($_POST["submit"])){
                        $queid = $_POST["$question_id"];
                        echo $queid;
                    }
                    ?>
                </div>
                <?php
                    }
                ?>
                <center>
                <a href="blog.php" class="logout">&lArr;Log out</a>
                <a href="tes.php" class="finish"><input type="submit" name="submit" value="Finish &rArr;"></a>
                </center>
             </form>  
            </div>
          </div>
         </div> 
          