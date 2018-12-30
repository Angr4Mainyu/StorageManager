<?php
/*
 * @Author: Angra Mainyu
 * @Date: 2018-12-10 20:44:17
 * @LastEditors: Angra Mainyu
 * @LastEditTime: 2018-12-30 21:40:38
 * @Description: file content
 */
include("../db/db_config.php");
include("session.php");

$data = array(
    '系统版本' => '1.0',
    '服务器地址' => 'https://www.github.com/Angr4Mainyu',
    '操作系统' => php_uname(),
    '运行环境' => $_SERVER["SERVER_SOFTWARE"],
    'PHP版本' => PHP_VERSION,
    'PHP运行方式' => php_sapi_name(),
    'MYSQL版本' => mysqli_get_server_info(),
    'ThinkPHP' => THINK_VERSION,
    '上传附件限制' => ini_get('upload_max_filesize'),
    '执行时间限制' => ini_get('max_execution_time').'秒', 
    '剩余空间' => round((disk_free_space(".")/(1024*1024)),2).'M',
);
echo json_encode($data);
?>