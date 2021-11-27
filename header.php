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
                       <li><a href="index.php">Home</a></li>
                       <li><a href="blog.php">Blog</a></li>
                       <li><a href="contact.php">Contact</a></li>
                       <li><a href="about.php">About</a></li>
                       <li>
                            <form method="post">
                                <input type="text" name="search" placeholder="Search here" class="blog-search" required><button name="searchbtn"><i class="ion-search"></i></button>
                            </form>
                       </li>
                   </ul>
                   <a class="mobile-nav-icon " id="slide-out-menu"><i class="ion-navicon-round"></i></a>
               </div>
           </nav>
        </header>
        <!----- slide out menu ----->
        <div class="slide-out-menu" id="out">
                <ul class="slide-menu">
                    <li><a href="index.php">Home</a></li>
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