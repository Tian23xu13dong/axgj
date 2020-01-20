<?php
header("Access-Control-Allow-Origin: *");
// 数据库主机
define('DB_HOST', '127.0.0.1');

// 数据库用户名
define('DB_USER', 'ax');

// 数据库密码
define('DB_PWD', 'Tfc6bmaEkyAWyARy');

// 数据库名称
define('DB_DATABASE','ax');

// 开启DEBUG
define("DEBUG", false);
global  $mysql;
$mysql = mysqli_connect('114.55.144.236', DB_USER, DB_PWD, DB_DATABASE);
if (!DEBUG){
    $mysql = @mysqli_connect(DB_HOST, DB_USER, DB_PWD, DB_DATABASE) or die('数据库连接失败，操作取消，请联系管理员');
}



/**
 * 错误执行，退出程序
 * @param $code
 * @param $msg
 */
function quit($code, $msg){
    $GLOBALS['mysql']->close();
    echo json_encode(['code'=>$code, 'msg'=>$msg]);
    exit(0);
}