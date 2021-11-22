<?php 
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$id = $_GET["id"];
 
$command = "SELECT * FROM questions WHERE qid = $id";
$show = mysqli_query($link, $command);
while($row = mysqli_fetch_assoc($show)){
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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
        <link rel="stylesheet" type="text/css" href="css/grid.css">
        <link rel="stylesheet" type="text/css" href="css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="css/animate.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/queries.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col span-12-of-12">
                    <div class="quebar">ID: <span class="id"><?php echo $question_id;?></span><br>
                    Catagory: <span class="cat"><?php echo $catagory;?></span>
                    <p><?php echo $question;?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col span-6-of-12">
                        <p class="label">Option 1</p>
                        <div class="option">
                            <?php echo $option1;?>
                        </div>
                    </div>
                    <div class="col span-6-of-12">
                        <p class="label">Option 2</p>
                        <div class="option">
                            <?php echo $option2;?>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col span-6-of-12">
                        <p class="label">Option 3</p>
                        <div class="option">
                            <?php echo $option3;?>
                        </div>
                    </div>
                    <div class="col span-6-of-12">
                        <p class="label">Option 4</p>
                        <div class="option">
                            <?php echo $option4;?>
                        </div>
                    </div>
                    </div>
                    <div class="row">
                        <div class="option">
                            <?php echo $answer;?>
                        </div>
                    </div>
                </div>
            </div> 
	</div>
</body>
</html>