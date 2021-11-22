<?php
require_once("include/database.php");
require_once("include/datetime.php");

$id = $_GET["id"];
if(isset($_POST["searchbtn"])){
    $search = $_POST["search"];

    header("location: blog.php?search=$search");
}   
elseif(isset($_POST["username"])){                    
    $username = mysqli_real_escape_string($link, $_POST["username"]);
    $email =  mysqli_real_escape_string($link, $_POST["email"]);
    $comment =  mysqli_real_escape_string($link, $_POST["comment"]);
    $status = "OFF";

if(empty($username) || empty($email) || empty($comment)){
        header("location: fullpost.php?id=$id&fill=false");
    }elseif(filter_var($email,FILTER_VALIDATE_EMAIL)===false){
        header("location: fullpost.php?id=$id&valide=false");
    }
    elseif(strlen($comment)>500){
        header("location: fullpost.php?id=$id&longco=true");
    }else{
        $newComment = "INSERT INTO comments(sendAt,username,email,comment,status,pid) 
        VALUES('$datetime', '$username', '$email', '$comment', '$status',$id);";
        $records = mysqli_query($link,$newComment);
        if($records){
            header("location: fullpost.php?id=$id&addco=success");
        }else{
            header("location: fullpost.php?id=$id&notaddco=true");
        }
    }
}

?>
<?php include('header.php'); ?>
       <!----- full post section ----->
        <section>
            <div class="row">
                <div class="col span-8-of-12 side">
                    <div class="main-area">
                        <div class="row">
                        <?php
                            $query ="SELECT * FROM posts WHERE pid = $id";
                            $showPost = mysqli_query($link, $query);
                            $row = mysqli_fetch_assoc($showPost);
                                $postid = $row["pid"];
                                $title = $row["title"];
                                $post = $row["post"];
                                $image = $row["image"];
                                $catagory = $row["catagory"];
                                $author = $row["author"];
                        ?>
                            <img src="<?='upload/'.$image;?>">
                                <h2><?=$title;?></h2>
                                    <p>
                                        <?=$post;?>
                                    </p>  
                                <div class="description">
                                  <h5>Author: <?=$author;?></h5>
                                <h6><?=$datetime;?></h6>
                                </div> 
                        </div>
                    </div>
                    <!----- tags bar ----->
                    <div class="row">
                       <div class="col span-12-of-12">
                            <div class="comment">
                            <?php 
                                $showtags = mysqli_query($link, "SELECT * FROM tags;");
                                while($rowtag = mysqli_fetch_assoc($showtags)){
                                    $tag = $rowtag["tag"];
                                   ?> 
                                        <a href="blog.php?tag=<?php echo $tag ;?>" class="tag"><span><i class='ion-ios-pricetag-outline'></i></span>&nbsp;<?php echo $tag ;?>
                                        </a>
                                   
                                <?php }?>
                            </div>
                       </div>
                    </div>
                    <!----- comment bar ----->
                    <div class="row">
                            <div class="col span-12-of-12">
                            <?php
                            if(isset($_GET["id"])){
                                $ShowComment = mysqli_query($link,"SELECT * FROM comments WHERE pid = $id and status = 'ON';");
                                while($rows = mysqli_fetch_assoc($ShowComment)){
                                $DateTime = $rows["sendAt"];
                                $username = $rows["username"];
                                $comment = $rows["comment"];
                            ?>
                                <div class="comment">
                                    <h5><span><img src="image/users.png"></span><?= $username;?></h5>
                                    <p><?php echo $comment; ?></p>
                                    <br>
                                    <form method="post">
                                    <button name="reply">Reply&nbsp;<span><i class="ion-reply"></span></i></button>
                                    </form><br>
                                    <h6><?echo echo $DateTime; ?></h6>
                                </div>
                                <?php }
                               }?>
                            </div> 
                            <div class="comment-form">
                                <h2 class="title">We well be happy if you share your comment about this post</h2>
                                <?php if(isset($_GET["notaddco"])):  ?>
                                        <div id="danger" class="animated bounce">Can't send comment please try again!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["addco"])):  ?>
                                        <div id="success" class="animated pulse">Comment is sent successfully!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["fill"])):  ?>
                                        <div id="danger" class="animated bounce">All fields are require!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["valide"])):  ?>
                                        <div id="danger" class="animated bounce">Your email format is not valid!</div>
                                    <?php endif; ?>
                                    <?php if(isset($_GET["longco"])):  ?>
                                        <div id="danger" class="animated bounce">Your comment should'nt be more than 500 characters!</div>
                                    <?php endif; ?>
                                <form method="post">
                                    <div class="row">
                                        <label for="name">Username</label>
                                        <input type="text" name="username" placeholder="Your name" id="name">
                                    
                                        <label for="email">E-mail</label>
                                        <input type="text" name="email" placeholder="Your email" id="email">
                                    </div>
                                    <div class="row">
                                        <label for="comment">Comment</label>
                                        <textarea rows="8" placeholder="Your comment" id="comment" name="comment"></textarea>
                                    </div>
                                    <input type="submit" value="Send it!" name="submit">
                                </form>
								</div>
                            </div>
                        </div>
                        <!----- main side ----->
                        <div class="col span-4-of-12 side">
                            <!----- biography ----->
                                <div class="biography">
                                    <img src="image/bishak.jpg">
                                    <p>I'm M.Edriss Alokozay I love Computer Scince major, I'm intersted in programming and web developing.</p>
                                </div>
                                 <!----- quizes ----->
                                 <div class="quiz-bar">
                                        <div class="header"><h3>AfgCode Quizes</h3></div>
                                        <ul>
                                            <li><a href="#">HTML</a></li>
                                            <li><a href="#">CSS</a></li>
                                            <li><a href="#">JavaScript</a></li>
                                            <li><a href="#">PHP</a></li>
                                        </ul>
                                    </div>
                                    <!----- cources ----->
                                    <div class="sidebar">
                                        <div class="header"><h3>AfgCode Courses</h3></div>
                                        <ul>
                                            <li><a href="#">Learn HTML</a></li>
                                            <li><a href="#">Learn CSS</a></li>
                                            <li><a href="#">Learn Bootstrap</a></li>
                                            <li><a href="#">Learn JavaScript</a></li>
                                            <li><a href="#">Learn JQuery</a></li>
                                            <li><a href="#">Learn Ajax</a></li>
                                            <li><a href="#">Learn Node.js</a></li>
                                            <li><a href="#">Learn PHP</a></li>
                                            <li><a href="#">Learn Laravel</a></li>
                                            <li><a href="#">Learn Mysql</a></li>
                                            <li><a href="#">Learn Sql</a></li>
                                            <li><a href="#">Learn Asp.net</a></li>
                                            <li><a href="#">Learn XML</a></li>
                                        </ul>
                                    </div>
                                    <!----- recent ----->
                                    <div class="recent-posts">
                                        <div class="header"><h3>Recent Posts</h3></div>
                                        <ul>
                                        <?php
                                        $command = "SELECT * FROM posts order by createAt desc limit 5;";
                                        $showRPosts = mysqli_query($link, $command);
                                        while($rows = mysqli_fetch_assoc($showRPosts)){
                                            $postid = $rows["pid"];
                                            $title = $rows["title"];
                                            $post = $rows["post"];
                                            $image = $rows["image"];
                                        ?>
                                            <li>
                                                <span><img src="<?='upload/'.$image;?>">
                                                <a href="fullpost.php?id=<?=$postid;?>"><?=$title;?></a></span>
                                                <p><?=$datetime;?></p>
                                            </li>
                                        <?php }?>
                                        </ul>
                                    </div>
                                    <div class="extra-courses">
                                        <div class="header"><h3>Extra Courses</h3></div>
                                        <ul>
                                            <li><a href="#">Java</a></li>
                                            <li><a href="#">Python</a></li>
                                            <li><a href="#">C#</a></li>
                                            <li><a href="#">C++</a></li>
                                        </ul>
                                    </div>
                                </div>
                </div><!--ending of row-->
        </section>
        <!----- footer ----->
        <?php include('footer.php'); ?>
    </body>
</html>