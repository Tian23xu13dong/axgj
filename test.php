<?php
//require_once 'core/config.php';
echo '<pre>';
$lastTime = time();
$token = md5('18785618024123456'.$lastTime);
echo $passwd = md5('123456');
//// 登录成功
//$sql = "UPDATE `user_info` SET `token` = '{$token}', `last` = '{$lastTime}' WHERE phone = '18785618024' and passwd = '{$passwd}';";
//echo $sql;
//$r = $mysql->query($sql);
//var_dump($r);