<?php
    include("../access/session.php");
    include("../db/db_config.php");
    include("../db/JSON.php");

    function getTotal($sql){
        global $db;
        $sql = str_replace("*","count(*) as count",$sql);
        $sql = $sql. ";";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result);
        return $row['count'];
    }

    function limit($sql){
        global $total_count;
        $total_count = getTotal($sql);
        if (isset($_POST["page"]) && isset($_POST["limit"])) {
            $page = $_POST["page"];
            $limit = $_POST["limit"];
            $start = $limit * ($page - 1);

            $sql = $sql. " limit $start,$limit";
        }
        return $sql;
    }

    function delete_item($table,$data){
        if($table == "input"){
            $ord_id = "iid";
        }
        else {
            $ord_id = "oid";
        }

        $sql = "delete from $table where $ord_id = '$data[$ord_id]';";
        return $sql;
    }

    function insert_item($table,$data){
        if($table == "input"){
            $ord_id = "iid";
        }
        else {
            $ord_id = "oid";
        }

        $name = $data['name'];
        $id = $data['id'];
        $price = $data['price'];
        $count = $data['count'];
        $manager = $data['manager'];
        $date = date('Y-m-d');
        $time = date('H:i:s');

        $sql = "insert into $table value ('$data[$ord_id]','$id','$name','$count','$price','$manager','$date','$time');";
        return $sql;
    }

    function update_item($table,$data,$field,$value){
        if($table == "input"){
            $ord_id = "iid";
        }
        else {
            $ord_id = "oid";
        }

        $date = date('Y-m-d');
        $time = date('H:i:s');

        $sql = "update $table set $field = '$value',date = '$date',time = '$time' where $ord_id = '$data[$ord_id]';";
        return $sql;
    }

    function select_item($table,$data){
        $sql = "select * from $table";
        if($table == "input"){
            $ord_id = "iid";
        }
        else {
            $ord_id = "oid";
        }

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
        if(isset($_POST["oid"])){
            $oid = $_POST["oid"];
            if($option == 0){
                $sql = $sql. " where oid = $oid";
            }
            else{
                $sql = $sql. " and oid = $oid";
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

        if(isset($_POST["date1"]) && isset($_POST["date2"]) && isset($_POST["time1"]) && isset($_POST["time2"])){
            $date1 = $_POST["date1"];
            $date2 = $_POST["date2"];
            $time1 = $_POST["time1"];
            $time2 = $_POST["time2"];
            if($time2 == "00:00:00"){
                $time2 = "24:00:00";
            }
            if($option == 0){
                $sql = $sql. " where date between '$date1' and '$date2'";
                $sql = $sql. " and time between '$time1' and '$time2'";
            }
            else{
                $sql = $sql. " where date between '$date1' and '$date2'";
                $sql = $sql. " and time between '$time1' and '$time2'";
            }
            $option += 1;
        }

        $sql = limit($sql);
        if($table == "stock"){
            return $sql;
        }
        $sql =   str_replace("*","$ord_id,name,count,price,manager,date,time,count*price as total",$sql);
        $sql = $sql. ";";
        return $sql;
    }

    if(isset($_POST["token"]) && isset($_POST["action"]) ){
        $total_count = 0;
		$token = $_POST['token'];
        $action = $_POST['action'];
        if(isset($_POST['table'])){
            $table = $_POST['table'];
        }
        else{
            $table = 'input';
        }
        if(isset($_POST['data'])){
            $data = json_decode($_POST['data'],TRUE);
        }
        else{
            $data = array('iid' =>-1,'oid' => -1);
        }
        // var_dump($data);

        switch ($action) {
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
            case 'get_ord_id':
                if($table == "input"){
                    $sql = "select max(iid) from $table;";
                }
                else {
                    $sql = "select max(oid) from $table;";
                }
                break;
            default:
                $sql = 'select * from input;';
                break;
        }
        // echo $sql;
        $result = mysqli_query($db,$sql);
        // var_dump($result);
        echo output($result,$total_count);
    }
?>