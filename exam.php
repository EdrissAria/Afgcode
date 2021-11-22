 <?php
session_start();
require_once("include/database.php");
require_once("include/datetime.php");
$cat = $_GET["catagory"];
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
                    <input type="radio" name="<?=$id;?>" value="<?=$option1;?>" id="<?=$option1;?>"></div>
                    <div class="option" id="option"><label for="<?=$option2;?>"><?=$option2;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option2;?>" id="<?=$option2;?>"></div>
                    <div class="option" id="option"><label for="<?=$option3;?>"><?=$option3;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option3;?>" id="<?=$option3;?>"></div>
                    <div class="option" id="option"><label for="<?=$option4;?>"><?=$option4;?></label>
                    <input type="radio" name="<?=$id;?>" value="<?=$option4;?>" id="<?=$option4;?>"></div>
                    <?php
                    if(isset($_POST["$id"])){
                        if($_POST["$id"] === $answer){
                            $_SESSION["quiz_result"] = $_SESSION["quiz_result"] + 1;
                        }
                    }
                    ?>
                </div>
                <?php
                    }
                ?>
                <center>
                <a href="blog.php" class="logout">&lArr;Log out</a>
                <input type="submit" name="submit" value="Finish &rArr;" class="finish">
                </center>
                <?php
                    if(isset($_POST["submit"])){
                        ?>
                            <script type="text/javascript">
                                window.location = "result.php?catagory=<?php echo $catagoryQuestions;?>";
                            </script>
                        <?php
                    }

                ?>            
                        
             </form>  
            </div>
          </div>
         </div> 
         <!----- main footer ----->
         <footer>
            <div class="row">
                <div class="col span-1-of-2">
                    <ul class="footer-nav">
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="#">Privacy</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
                <div class="col span-1-of-2">
                    <ul class="social-footer">
                        <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                        <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                        <li><a href="#"><i class="ion-social-whatsapp"></i></a></li>
                        <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <p>Copyright &copy; 2021 by AfgCode</p>
            </div>
        </footer>
    </body>
</body>
</html>