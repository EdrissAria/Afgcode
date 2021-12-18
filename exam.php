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
                        <p>Question <span id="current_que">0<span>/</span><span id="total_que">0</span></p>
                    </div>
                    <div id="load_questions">
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
                </div>
                <div class="buttons_group">
                    <button class="previous" onclick="load_previous()">Previous</button>
                    <button class="next" onclick="load_next()">Next</button>
                </div>
                <?php
                    }
                ?>  
           
            </div>
          </div>
         </div> 
         <!----- main footer ----->
        <?php include('footer.php') ?>

        <script>
            function load_total_que(){
                let xmlhttp = new XMLHttpRequest(); 
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        document.getElementById('total_que').innerHTML = xmlhttp.responseText; 
                    }
                }
                xmlhttp.open('GET', 'ajax/load_total_que.php?catagory=<?php echo $cat ?>', true); 
                xmlhttp.send(null); 
            }     
            
            var questionNo = '1'; 
            load_questions(questionNo); 
            function load_questions(questionNo){
                document.getElementById('current_que').innerHTML = questionNo;
                let total_que = document.getElementById('total_que').innerHTML; 

                let xmlhttp = new XMLHttpRequest(); 
                xmlhttp.onreadystatechange = function(){
                    if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
                        if(xmlhttp.responseText == "over"){
                            window.location = 'result.php';
                        }else{
                            document.getElementById('total_que').innerHTML = xmlhttp.responseText; 
                            load_total_que(); 
                        }
                    }
                }
                xmlhttp.open('GET', 'ajax/load_questions.php?catagory=<?php echo $cat ?>&qno='+questionNo, true); 
                xmlhttp.send(null);
            }

            function load_previous(){
                if(questionNo == '1'){
                    load_questions(questionNo); 
                }else{
                    questionNo.parseInt(questionNo) - 1; 
                }
            }
            function load_next(){
                questionNo.parseInt(questionNo) + 1; 
                load_questions(questionNo); 
            }
        </script>
    </body>
</body>
</html>