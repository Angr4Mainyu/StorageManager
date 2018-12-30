<?php
/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-04 01:19:11
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:40:54
 * @Description: file content
 */
session_start();
if(!$_SESSION['logged']){
    header("Location: /StorageManager/access/login.html");
}
?>