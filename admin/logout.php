<?php
     require_once("../include/session.php");

     if(isset($_SESSION["login"])){
         $_SESSION["login"] = null;
         unset($_SESSION["login"]);
         header("location: login.php");
     }



?>