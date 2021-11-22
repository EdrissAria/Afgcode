<?php
if(isset($_POST["searchbtn"])){
    $search = $_POST["search"];
    header("location: blog.php?search=$search");
}
?>
<?php include('header.php'); ?>
            <!----- about area ----->
            <div class="about">
                <h2><a href="#"><span style="color: orangered">&lt;</span><span style="color: rgb(14, 13, 13)">A</span><span style="color: rgb(240, 0, 0)">f</span><span style="color: rgb(90, 200, 0)">g</span>Code<span style="color: orangered">/&gt;</span></a></h2>
                <p>
                    This website is developed by M.Edriss Alokozay for learning web designing and web development from 
                    scratch for those who start to learn web designing and web development.
                </p>
                <img src="image/bishak.jpg">
                <h6>You can contact me from these social media</h6>
                <div class="social-media">
                    <ul>
                        <li><a href="#"><i class="ion-social-facebook"></i></a><li>
                        <li><a href="#"><i class="ion-social-whatsapp"></i></a><li>
                        <li><a href="#"><i class="ion-social-youtube"></i></a><li>
                        <li><a href="#"><i class="ion-social-instagram"></i></a><li>
                        <li><a href="#"><i class="ion-paper-airplane"></i></a><li>
                    </ul>
                </div>
            </div>
            <!----- main footer ----->
            <?php include('footer.php'); ?>
    </body>
</html>