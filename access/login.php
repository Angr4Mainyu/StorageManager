<?php
/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-04 01:19:11
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:40:46
 * @Description: file content
 */
	// phpinfo();
	include("../db/db_config.php");
	session_start();

	if(isset($_POST['username']) && isset($_POST["password"] )){
		$username = $_POST['username'];
		$passwd = $_POST['password'];

		$sql = "select passwd from user where manager = '$username' ;";
		$result = mysqli_query($db, $sql);
		if($result->num_rows == 0){
			echo "1";
		}
		else {
			$row = mysqli_fetch_array($result);
			if($row['passwd'] == $passwd){
				$_SESSION['user'] = $username;
				$_SESSION['logged'] = true;
				echo '0';
			}
			else{
				echo "2";
			}
		}
	}
	else{
		header("Location: login.html");
	}
	
?>