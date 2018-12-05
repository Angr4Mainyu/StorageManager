<?php
session_start();
if(!$_SESSION['logged']){
    header("Location: /StorageManager/access/login.html");
}
?>