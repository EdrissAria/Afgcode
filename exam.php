<?php
session_start(); 
require_once("include/database.php");
require_once("include/datetime.php");
$cat = $_GET["catagory"];
 
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
                        <p>Question <?=$quenum;?> of 5</p>
                    </div>
                    <div class="question">
                        <?=$question;?>
                    </div>
                    <div class="option" id="option"><label for="<?=$option1;?>"><?=$option1;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option1;?>" id="<?=$option1;?>"
                    onclick="save_opt(this.value,<?php echo $id; ?>)"
                    ></div>
                    <div class="option" id="option"><label for="<?=$option2;?>"><?=$option2;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option2;?>" id="<?=$option2;?>"
                    onclick="save_opt(this.value,<?php echo $id; ?>)"
                    ></div>
                    <div class="option" id="option"><label for="<?=$option3;?>"><?=$option3;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option3;?>" id="<?=$option3;?>"
                    onclick="save_opt(this.value,<?php echo $id; ?>)"
                    ></div>
                    <div class="option" id="option"><label for="<?=$option4;?>"><?=$option4;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option4;?>" id="<?=$option4;?>"
                    onclick="save_opt(this.value,<?php echo $id; ?>)"
                    ></div>
                   
                </div>
                <?php
                    }
                ?>
                <center>
                <a href="blog.php" class="logout">&lArr;Log out</a>
                <a href="result.php?catagory=<?php echo $cat ?>" class="finish">Finish &rArr;</a>
                </center>
                           
             </form>  
             <?php echo $_SESSION['score']; ?>
            </div>
          </div>
         </div> 
         <!----- main footer ----->
        <?php include('footer.php') ?>

        <script>
            function save_opt(value, qid){
                alert(<?php echo $_SESSION['score']; ?>)
                
            }     
        </script>
    </body>
</body>
</html>