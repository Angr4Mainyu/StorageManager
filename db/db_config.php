<?php
   define('DB_SERVER', 'localhost:3306');
   define('DB_USERNAME', 'zhangzhh');
   define('DB_PASSWORD', 'ss1122366');
   define('DB_DATABASE', 'storage');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   if(!$db){
        die("连接错误：".mysqli_connect_error());
   }
   $db->query("SET NAMES UTF8");
?>