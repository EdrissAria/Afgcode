<?php
require_once("include/database.php");
require_once("include/datetime.php");
?>
<?php include('header.php'); ?>
        <!----- main section ----->
        <section>
            <div class="row">
                <div class="col span-8-of-12 side">
                <!----- php code for posts ----->
                <?php
                    if(isset($_GET["search"])){
                          $search = $_GET["search"];
                          if($search != ""){
                          $query = "SELECT * FROM posts where createAt LIKE '%$search%' OR title LIKE '%$search%' OR post LIKE '%$search%' OR catagory LIKE '%$search%' ORDER BY pid desc;";
                          $showPosts = mysqli_query($link, $query);
                         }
                    }else{
                        $query = "SELECT * FROM posts order by pid desc;";
                        $showPosts = mysqli_query($link, $query);
                    }
                        while($row = mysqli_fetch_assoc($showPosts)){
                            $postid = $row["pid"];
                            $title = $row["title"];
                            $post = $row["post"];
                            $image = $row["image"];
                        ?>
                        <!----- main area ----->
                    <div class="main-area">
                        <div class="row">
                            <img src="<?php echo "upload/".$image;?>">
                                <h2><?=$title;?></h2>
                                    <p>
                                     <?php if(strlen($post)>180){ echo substr($post,0, 180)."...";}else{ echo $post;}?>
                                   </p>
                            <a href="fullpost.php?id=<?=$postid;?>" class="read-more">READ MORE &rArr;</a>
                        </div>     
                    </div>
                    <?php }
                        ?>
                </div><!---ending of main area--->
                <!----- main side ----->
                <div class="col span-4-of-12 side">
                    <!----- biography ----->
                        <div class="biography">
                            <img src="image/bishak.jpg">
                            <p>I'm M.Edriss Alokozay I love Computer Scince major, I'm intersted in programming and web developing.</p>
                        </div>
                        <!----- Quiz bar ----->
                        <div class="quiz-bar">
                                <div class="header"><h3>AfgCode Exams</h3></div>
                                <ul>
                                    <?php
                                    $show = mysqli_query($link, "select * from catagories;");
                                    while($row = mysqli_fetch_assoc($show)){
                                        $catagory = $row["name"];
                                    ?>
                                    <li><a href="exam.php?catagory=<?php echo $catagory;?>"><?=$catagory;?></a></li>
                                    <?php }?>
                                </ul>
                            </div>
                        <!----- courses ----->
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
                            <!----- recent posts ----->
                            <div class="recent-posts">
                                <div class="header"><h3>Recent Posts</h3></div>
                                <ul>
                                <?php
                                $command = "SELECT * FROM posts order by createAt desc limit 5;";
                                $showRPosts = mysqli_query($link, $command);
                                while($row = mysqli_fetch_assoc($showRPosts)){
                                    $postid = $row["pid"];
                                    $title = $row["title"];
                                    $post = $row["post"];
                                    $image = $row["image"];
                                ?>
                                    <li>
                                        <span><img src="<?php echo 'upload/'.$image;?>">
                                        <a href="fullpost.php?id=<?=$postid;?>"><?=$title;?></a></span>
                                        <p><?php echo $datetime;?></p>
                                    </li>
                                <?php }?>
                                </ul>
                            </div>
                            <!----- extra courses ----->
                            <div class="recent-posts">
                                <div class="header"><h3>Maybe You intersted in</h3></div>
                                <ul>
                                <?php
                                $command = "SELECT * FROM links order by createAt desc";
                                $showRPosts = mysqli_query($link, $command);
                                while($row = mysqli_fetch_assoc($showRPosts)){
                                    $linkid = $row["lid"];
                                    $linkName = $row["linkName"];
                                    $linkUrl = $row["linkUrl"];
                                    $image = $row["linkImage"];
                                ?>
                                    <li>
                                        <span><img src="<?php echo 'upload/'.$image;?>">
                                        <a href="<?php echo $linkUrl;?>"><?php echo $linkName;?></a></span>
                                        
                                    </li>
                                <?php }?>  
                                </ul>
                            </div>
                        </div>
            </div><!---ending of row --->
        </section>
        <!----- main footer ----->
        <?php include('footer.php'); ?>
    </body>
</html>