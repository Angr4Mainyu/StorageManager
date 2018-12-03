<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: access/login.html");
}
?>