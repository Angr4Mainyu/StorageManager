<?php
/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-29 20:33:01
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:39:20
 * @Description: file content
 */
    include("../access/session.php");
    include("../db/db_config.php");
    
    function get_item_id($name){
        $sql = "select id from goods where name = '$name';";
        // echo $sql;
        global $db;
        $result = mysqli_query($db,$sql);
        // var_dump($result);
        if($result->num_rows == 0){
            $sql = "select max(id)+1 as id from goods;";
            $result = mysqli_query($db,$sql);
            $row = mysqli_fetch_array($result);
            $id = $row["id"];

            $sql = "insert into goods values('$id','$name');";
            $result = mysqli_query($db,$sql);
            return $id;
        }else{
            $row = mysqli_fetch_array($result);
            return $row["id"];
        }

    }


    if(isset($_POST["token"]) && isset($_POST["action"]) ){
        $token = $_POST["token"];
        $action = $_POST["action"];
        if(isset($_POST["name"])){
            $name = $_POST["name"];
        }
        switch ($action) {
            case 'get_item_id':
                echo get_item_id($name);
                break;
            
            default:
                # code...
                break;
        }
    }
?>