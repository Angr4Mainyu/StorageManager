<?php
   session_start();
   
   unset($_SESSION['user']);
   unset($_SESSION['logged']);
   
   header("Location: login.html");
?>