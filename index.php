<?php
if(isset($_POST["searchbtn"])){
    $search = $_POST["search"];
    header("location: blog.php?search=$search");
}
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
    <body>     
        <!----- main header ----->
        <header>
           <nav>
               <div class="row">
               <a href="index.php"><div class="logo"><img src="image/logo.png" alt="afgcode logo"></div></a>
                    <ul class="main-nav">
                       <li><a href="index.php" id="active">Home</a></li>
                       <li><a href="blog.php">Blog</a></li>
                       <li><a href="Contact.php">Contact</a></li>
                       <li><a href="about.php">About</a></li>
                   </ul>
                   <a class="mobile-nav-icon" id="slide-out-menu"><i class="ion-navicon-round"></i></a>
               </div>
           </nav>
        </header>
        <!----- slide out menue ----->
        <div class="slide-out-menu" id="out">
            <ul class="slide-menu">
                <li><a href="index.php" id="active">Home</a></li>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="Contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <li> 
                <form method="post">
                    <input type="text" name="search" placeholder="Search here" required><button name="searchbtn"><i class="ion-search"></i></button>
                </form>
                </li>
            </ul>
        </div>
        <!----- banner ------------>
        <div class="row">
            <div class="banner">
                <h1><span style="color: orangered">&lt;</span>AfgCode<span style="color: orangered">/&gt;</span></h1>
                <div class="form">
                <form method="post">
                <input type="text" name="search" placeholder="Search here" required><button name="searchbtn"><i class="ion-search"></i></button>
                </form>
                </div>
            </div>
        </div>
        <!----- main ------------->
        <main>
            <section>
                <div class="row">
                    <h2 class="title">START YOUR LEARNING FROM THESE COURSES</h2>
                </div>
                <div class="row">
                    <div class="col span-1-of-2">
                        <a href="#"><div class="card first">
                             <h1>HTML</h1>
                        </div></a>
                    </div>
                    <div class="col span-1-of-2">
                        <a href="#"><div class="card second">
                             <h1>CSS</h1>
                        </div></a>
                    </div>
                </div>
                <div class="row">
                        <div class="col span-1-of-2">
                            <a href="#"><div class="card third">
                                 <h1>JavaScript</h1>
                            </div></a>
                        </div>
                        <div class="col span-1-of-2">
                            <a href="#"><div class="card fourth">
                                <h1>PHP</h1>
                            </div></a>
                        </div>
                    </div>
            </section>
        </main>
        <!----- main footer ----->
        <?php include('footer.php'); ?>
    </body>
</html>
