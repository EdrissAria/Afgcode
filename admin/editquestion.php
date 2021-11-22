<?php
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");


$user = $_SESSION["login"];

    $id = $_GET["id"];
    $command = "SELECT * FROM questions WHERE qid = $id";
    $showinfo = mysqli_query($link,$command);
    while( $row = mysqli_fetch_assoc($showinfo)){
        $question_id = $row["qid"];
        $catagory = $row["catagory"];
        $question = $row["question"];
        $option1 = $row["opt1"];
        $option2 = $row["opt2"];
        $option3 = $row["opt3"];
        $option4 = $row["opt4"];
        $answer = $row["answer"];
        $author = $row["author"];
    }
if(isset($_POST["question"])){
    $question_id = $_POST["question_id"];
    $question = $_POST["question"];
    $catagory = $_POST["catagory"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
    $answer = $_POST["answer"];

    $showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
    $showPrivilage = mysqli_fetch_assoc($showUser);
    $position = $showPrivilage["position"];

    if($position == "Subscriber"){
        header("location: manageExams.php?permission=failed");
    }elseif($position == "Author"){
        if($author == $user){
            $editquestion = mysqli_query($link,"UPDATE questions set question = '$question', catagory = '$catagory', opt1 = '$option1', opt2 = '$option2', opt3 = '$option3', opt4 = '$option4', answer = '$answer' where qid = $id;");
            if($editquestion){
                header("location: manageExams.php?updateq=success");
            }else{
                header("location: editquestion.php?notupdateq=true");
            }
        }else{
            header("location: manageExams.php?permission=failed");
        }
    }elseif($position == "Editor"){
         $editquestion = mysqli_query($link,"UPDATE questions set question = '$question', catagory = '$catagory', opt1 = '$option1', opt2 = '$option2', opt3 = '$option3', opt4 = '$option4', answer = '$answer' where qid = $id;");
            if($editquestion){
                header("location: manageExams.php?updateq=success");
            }else{
                header("location: editquestion.php?notupdateq=true");
            }
    }else{
         $editquestion = mysqli_query($link,"UPDATE questions set question = '$question', catagory = '$catagory', opt1 = '$option1', opt2 = '$option2', opt3 = '$option3', opt4 = '$option4', answer = '$answer' where qid = $id;");
            if($editquestion){
                header("location: manageExams.php?updateq=success");
            }else{
                header("location: editquestion.php?notupdateq=true");
            }
        }
    } 
    
?>
<!DOCTYPE html> 
<html>
    <head>
        <title>Edit Questions</title>
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
            <div class="edit-que">
            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                <label for="q">Question</label>
                                <textarea class="form-control" name="question" rows="4" placeholder="new question..." id="q"><?= $question?></textarea>
                                </div>
                                <div class="form-group">
                                <span>existing catagory: <?php echo $catagory?></span><br><br>
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
                                </div>
                                <div class="row">
                                <div class="col span-6-of-12">
                                <div class="form-group">
                                <label for="o1">Option 1</label>
                                <input type="text" name="option1"  class="form-control" id="o1" value="<?=$option1;?>">
                                </div>
                                <div class="form-group my-2">
                                <label for="o2">Option 2</label>
                                <input type="text" name="option2"  class="form-control" id="o2" value="<?=$option2;?>">
                                </div>
                                </div>
                                <div class="col span-6-of-12">
                                <div class="form-group my-2">
                                <label for="o3">Option 3</label>
                                <input type="text" name="option3"  class="form-control" id="o3" value="<?=$option3;?>">
                                </div>
                                <div class="form-group my-2">
                                <label for="o3">Option 4</span></label>
                                <input type="text" name="option4"  class="form-control" id="a3" value="<?=$option4;?>">
                                </div>
                                </div>
                                <div class="row">
                                <div class="col span-12-of-12">
                                <div class="form-group my-2">
                                <label for="a">Answer</span></label>
                                <input type="text" name="answer"  class="form-control" id="a" value="<?=$answer;?>">
                                </div>
                                </div>
                                </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success btn-block" value="Update">
                    </form>
                </div>
              </div>
            </div>
     
</body>
</html>