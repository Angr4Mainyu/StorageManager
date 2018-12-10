<?php
    include("../access/session.php");
    include("../db/db_config.php");
    include("../db/JSON.php");

    function delete_item($table,$data){
        $iid= $data['iid'];
        $sql = "delete from $table where iid = '$iid';";
        return $sql;
    }

    function insert_item($table,$data){
        $iid = $data['iid'];
        $name = $data['name'];
        $id = $data['id'];
        $price = $data['price'];
        $count = $data['count'];
        $manager = $data['manager'];
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $sql = "insert into $table value ('$iid','$id','$name','$count','$price','$manager','$date','$time');";
        return $sql;
    }

    function update_item($table,$data,$field,$value){
        $iid= $data['iid'];
        
        $sql = "update $table set $field = '$value' where iid = '$iid';";
        return $sql;
    }

    function select_item($table,$data){
        $sql = "select * from $table";
        if(isset($_POST["iid"])){
            $iid = $_POST["iid"];
            if($option == 0){
                $sql = $sql. " where iid = $iid";
            }
            else{
                $sql = $sql. " and iid = $iid";
            }
            $option += 1;
        }
        if(isset($_POST["name"])){
            $name = $_POST["name"];
            if($option == 0){
                $sql = $sql. " where name = '$name'";
            }
            else{
                $sql = $sql. " and name = '$name'";
            }
            $option += 1;
        }
        if(isset($_POST["manager"])){
            $manager = $_POST["manager"];
            if($option == 0){
                $sql = $sql. " where manager = '$manager'";
            }
            else{
                $sql = $sql. " and manager = '$manager'";
            }
            $option += 1;
        }
        $sql = $sql. ";";
        return $sql;
    }

    if(isset($_POST["token"]) && isset($_POST["action"]) ){
		$token = $_POST['token'];
        $action = $_POST['action'];
        if(isset($_POST['table'])){
            $table = $_POST['table'];
        }
        else{
            $table = 'output';
        }
        if(isset($_POST['data'])){
            $data = json_decode($_POST['data'],TRUE);
        }
        else{
            $data = array('iid' =>-1);
        }
        // var_dump($data);
        switch ($action) {
            case 'list':
                $sql = "select * from $table;";
                // echo $sql;
                break;
            case 'delete':
                $sql = delete_item($table,$data);
                break;
            case 'update':
                $field = $_POST['field'];
                $value = $_POST['value'];
                $sql = update_item($table,$data,$field,$value);
                break;
            case 'select':
                $sql = select_item($table,$data);
                break;
            case 'insert':
                $sql = insert_item($table,$data);
                // echo $sql;
                break;
            case 'getiid':
                $sql = "select max(iid) from output;";
                break;
            default:
                $sql = 'select * from output;';
                break;
        }
        // echo $sql;
        $result = mysqli_query($db,$sql);
        // var_dump($result);
        echo output($result);
    }
?>