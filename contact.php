<?php
require_once("include/database.php");
require_once("include/datetime.php");

if(isset($_POST["searchbtn"])){
    $search = $_POST["search"];
    header("location: blog.php?search=$search");
}
elseif(isset($_POST["submit"])){
    $firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
    $email = mysqli_real_escape_string($link, $_POST["email"]);
    $subject = mysqli_real_escape_string($link, $_POST["subject"]);
    $message = mysqli_real_escape_string($link, $_POST["message"]);

    $to = "edrissalokozay77@gmail.com";
    if(empty($firstname) || empty($email) || empty($subject) || empty($message)){
        header("location: contact.php?fill=false");
    }
    elseif(mail($to, $subject, $message, $email)){
        header("location: contact.php?send=success");
    }else{
        header("location: contact.php?notsend=true");
    }
}
?>
<?php include('header.php'); ?>
        <!----- contuct form ----->
        <section class="map">
            <div class="row">
                <div class="contact-card">
                    <p>You can contact us with this form<p>
                    <form method="post">
                        <label for="name">First name</label>
                        <input type="text" name="firstname" placeholder="Your name" required>
                        <label for="email">E-mail</label>
                        <input type="text" name="email" placeholder="Your email" required>
                        <label for="sub">Subject</label>
                        <input type="text" name="subject" placeholder="Subject" required>
                        <label for="msg">Message</label>
                        <textarea rows="8" name="message" placeholder="Your name" required></textarea>
                        <input type="submit" name="submit" value="Send it!">
                    </form> 
                </div>
            </div>
        </section>
        <!----- main footer ----->
        <?php include('footer.php'); ?>
    </body>
</html>