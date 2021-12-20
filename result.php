<?php
session_start();
require_once("include/database.php");
require_once("include/datetime.php");
$cat = $_GET["catagory"];
$score = $_SESSION['score'];

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
                <div class="result">
                    <h1 class="result_header">Exam Result</h1>
                    <div class="table_con">
                        <table class="result_table">
                            <tr>
                                <td>Total Que</td>
                                <td><?php echo $total; ?></td>
                            </tr>
                            <tr>
                                <td>Correct</td>
                                <td><?php echo $score; ?></td>
                            </tr>
                            <tr>
                                <td>Incorrect</td>
                                <td><?php echo $total - $score; ?></td>
                            </tr>
                            <tr>
                                <td>Your score</td>
                                <td><?php echo ($score * 10) . ' %'; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="buttons_group">
                <a href="exam.php?catagory=<?php echo $cat ?>" class="logout">&lArr;Try again</a>
                <a href="/afgcode" class="finish">Go home &rArr;</a>
                </div>

            </div>
        </div>
    </div>
</body>
</body>

</html>