<?php
    include("../access/session.php");
    include("../db/db_config.php");
    include("../db/JSON.php");

    function delete_item($table,$data){
        $iid= $data['iid'];
        $sql = "delete from $table where iid = '$iid'";
        return $sql;
    }

    function insert_item($table,$data){
        $iid = $data['iid'];
        $name = $data['name'];
        $id = $data['id'];
        $price = $data['price'];
        $count = $data['count'];
        $total = $data['total'];
        $manager = $data['manager'];
    
        $sql = "insert into $table value ('$iid','$name','$id','$price','$count','$total','$manager')";
        // echo $sql;
        return $sql;
    }

    function update_item($table,$data1,$data2){
        $iid1= $data1['iid1'];
        $iid2= $data2['iid2'];
        
        $sql = "update $table set iid1 = '$iid1' where iid2 = '$iid2'";
        echo $sql;
    }

    function select_item($table,$data){
        $sql = "select * from input;";
        
    }

    if(isset($_POST["token"]) && isset($_POST["action"]) ){
		$token = $_POST['token'];
        $action = $_POST['action'];
        if(isset($_POST['table'])){
            $table = $_POST['table'];
        }
        else{
            $table = 'input';
        }
        $data = $_POST['data'];


        switch ($action) {
            case 'list':
                $sql = 'select * from $table';
                $result = mysqli_query($db,$sql);
                break;
            case 'delete':
                $sql = delete_item($table,$data);
                $result = mysqli_query($db,$sql);
                break;
            case 'update':
                $sql = update_item($table,$data);
                $result = mysqli_query($db,$sql);
                break;
            case 'select':
                $sql = select_item($table,$data);
                $result = mysqli_query($db,$sql);
                break;
            case 'insert':
                $sql = insert_item($table,$data);
                $result = mysqli_query($db,$sql);
                break;
            default:
                $sql = 'select * from input';
                $result = mysqli_query($db,$sql);
                break;
        }
        output($result);
	}
?>