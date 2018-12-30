<?php
/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-04 01:19:16
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:40:23
 * @Description: file content
 */
    include("../access/session.php");
    include("../db/db_config.php");
    include("../db/JSON.php");

    if(isset($_POST["token"]) && isset($_POST["action"]) ){
		$token = $_POST['token'];
        $action = $_POST['action'];

        if($action === "list"){
            $sql = "select * from input;";
        }
        else{
            $sql = "";
        }

        $result = mysqli_query($db, $sql);
        echo output($result);
	}
?>