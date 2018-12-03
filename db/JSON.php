<?php
    function output($result){
        if($result->num_rows == 0){
            $code = 1;
            $msg = "Empty Set";
            $n_rows = 0;
            $data = [];
        }else{
            $code = 0;
            $msg = "Query success";
            $n_rows = $result->num_rows;

            $arr = array();
            while($row = mysqli_fetch_array($result)) {
                $count=count($row);
                for($i=0;$i<$count;$i++){
                    unset($row[$i]);
                }
                array_push($arr,$row);
            }
        }

        $out = array(
            "code" => $code, 
            "msg" => $msg,
            "count" => $n_rows,
            "data" => $arr
            );
        return json_encode($out,JSON_UNESCAPED_UNICODE);
    }
?>