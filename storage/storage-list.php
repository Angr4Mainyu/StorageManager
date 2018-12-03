<?php
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