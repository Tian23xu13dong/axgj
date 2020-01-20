<?php
// 允许请求
header("Access-Control-Allow-Origin: *");

// 检查请求参数
if(empty($_POST['phone']) || empty($_POST['passwd'])){
	exit('请求参数错误，任务结束');
}
require_once 'core/config.php';

$phone = $_POST['phone'];
$passwd = md5($_POST['passwd']);

$sql = "select * from user_info where phone = '{$phone}' and passwd = '{$passwd}';";
$res = $mysql->query($sql);

if ($res->num_rows === 1){
    $lastTime = time();
    $token = md5($phone.$passwd.$lastTime);
    // 登录成功
    $sql = "UPDATE `user_info` SET `token` = '{$token}', `last` = '{$lastTime}' WHERE phone = '{$phone}' and passwd = '{$passwd}';";
    $r = $mysql->query($sql);

    if ($r){
        // 登陆成功且数据更新成功
        echo json_encode(['code'=>200, 'msg'=>'登录成功', 'token'=>$token, 'info'=>$res->fetch_assoc()]);
    }else{
        // 登录成功但数据更新失败
        echo json_encode(['code'=>201, 'msg'=>'登录成功但数据更新失败']);
    }
}else{
    // 登录失败
    echo json_encode(['code'=>202, 'msg'=>'账号或密码错误']);
}

// 关闭数据库链接
$mysql->close();
