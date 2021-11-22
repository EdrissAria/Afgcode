<?php 
require_once("../include/session.php");
require_once("../include/database.php");
require_once("../include/datetime.php");

$user = $_SESSION["login"];
$showUser = mysqli_query($link, "SELECT * FROM admins WHERE username = '$user'");
$showPrivilage = mysqli_fetch_assoc($showUser);
$position = $showPrivilage["position"];
$aid = $showPrivilage["aid"];
$photo = $showPrivilage["photo"];

if(isset($_POST["question"])){
    $question = nl2br(htmlentities($_POST["question"]));
    $option1 = htmlentities($_POST["option1"]);
    $option2 = htmlentities($_POST["option2"]);
    $option3 = htmlentities($_POST["option3"]);
    $option4 = htmlentities($_POST["option4"]);
    $answer = htmlentities($_POST["answer"]);
    $catagoryname = $_POST["catagory"];
    
    if(empty($question) || empty($answer) || empty($catagoryname) || empty($option1) || empty($option2) || 
    empty($option3) || empty($option4)){
        header("location: addquestion.php?fill=false");
    }else{
    $insertQuestion = mysqli_query($link, "INSERT INTO questions 
        (question, opt1, opt2, opt3, opt4, answer, catagory, author, createAt, aid)
        VALUES('$question', '$option1', '$option2', '$option3', '$option4', '$answer','$catagoryname','$user', '$datetime', '$aid');");
    }if($insertQuestion){
        header("location: addquestion.php?insertq=success");
    }else{
        header("location: addquestion.php?notinsertq=true");
    }
}

?>
<!DOCTYPE html> 
<html>
    <head>
    <title>Add Questions</title>
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
                <nav>
				<div class="col span-3-of-12" id="out">
                <div class="row logo-place">
                        <a href="Front-end/index.php"><img src="../image/logo.png"></a><span class="mobile-nav-icon2" id="slide-out-menu2"><i class="ion-navicon-round"></i></span>
                    </div>
    					<ul class="dashboard">
						<li><a href="manageExams.php">Manage Exams</a></li>
						<li><a href="addquestion.php" class="active">Add Questions</a></li>
						<li><a href="Admin_panel.php">Back</a></li>
					</ul>
                </div>
              </nav><!-- ending of dashboard-->
                <div class="col span-9-of-12" id="wide">
                        <header>
                                <div class="row">
                                    <div class="col span-9-of-12">       
                                    <a class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></a>
                                    <div class="profile"><img src="<?='../upload/'.$photo;?>" alt="profile"><p><?php echo $user;?></p></div>
                                    <h2>Add Question</h2>
                                    </div>
                                </div>
                        </header>

                    <form method="post">
                    <?php if(isset($_GET["insertq"])): ?><div id="success" class="animated pulse">Question is added successfully!</div><?php endif; ?>
                        <?php if(isset($_GET["notinsertq"])): ?><div id="danger" class="animated shake">Failed to add question!</div><?php endif; ?>
                         <?php if(isset($_GET["match"])): ?><div id="danger" class="animated shake">Retype doesn't match!</div><?php endif; ?>
                        <?php if(isset($_GET["fill"])): ?><div id="danger" class="animated shake">All fields are required!</div><?php endif; ?>
                                <div class="form-group">
                                <label for="question">Question</label>
                                <textarea rows="3" name="question" class="form-control" id="question"></textarea>

                                <label for="catagory">Catagory</label>
                                <select name="catagory" id="catagory" class="form-control">
                                <?php 
                                $showCatagory = mysqli_query($link, "SELECT * FROM catagories;");
                               
                                    
                                    while( $row = mysqli_fetch_assoc($showCatagory)){
                                        $catagory = $row["name"];
                                                                        
                                ?>
                                    <option><?= $catagory ;?></option>

                                <?php } ?>
                                </select>
                                </div>
                                <div class="row">
                                <div class="col span-6-of-12">
                                <div class="form-group">
                                <label for="a1">Option 1</label>
                                <input type="text" name="option1" class="form-control" id="a1">
                                </div>
                                <div class="form-group">
                                <label for="a2">Option 2 </label>
                                <input type="text" name="option2" class="form-control" id="a2">
                                </div>
                                </div>
                                <div class="col span-6-of-12">
                                <div class="form-group">
                                <label for="a3">Option 3 </label>
                                <input type="text" name="option3" class="form-control" id="a3">
                                </div>
                                <div class="form-group">
                                <label for="a4">Option 4</label>
                                <input type="text" name="option4" class="form-control" id="a4">
                                </div>
                                </div>
                                </div>
                                <div class="row">
                                <div class="col span-12-of-12">
                                <label for="answer">Answer</label>
                                <input type="text" name="answer" class="form-control" id="answer">
                                </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-success btn-block my-3" value="Add New Question">
                            
                        </form>
                </div>
            </div><!--- ending of row -->
        </div><!--- ending of container -->
        <script type="text/javascript" src="../js/main.js"></script>
    </body>
</html>