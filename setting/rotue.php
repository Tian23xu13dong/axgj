<?php

$token = $_POST['token'] or false;
$act = $_POST['act'] or false;

// 检查是否提供授权码
if (!$token){
    quit(202, '您的请求是非法的，请先登录');
}

require_once '../core/config.php';
// 获取用户授权信息
$sql = "select id from user_info where token = '{$token}';";
$userId = $mysql->query($sql);
if ($userId->num_rows !== 1){
    quit(202,'您的token已过期，请重新登录后使用');
}
$userId = $userId->fetch_assoc()['id']; // 获取用户唯一ID

switch ($act){
    case "getRouteList":
        echo json_encode(['code'=>200, 'msg'=>'常用线路获取成功', 'data'=>getRoute($userId)]);
        break;
    default:
        echo json_encode(['code'=>202, 'msg'=>'您的请求不合法，请联系管理员']);
        break;
}

$mysql->close();

function getRoute($userId){
    $sql = "select *from route where fid = '{$userId}';";
    $re = $GLOBALS['mysql']->query($sql);
    $routeList = [];
    foreach ($re as $item){
        $routeList []= ['id'=>$item['id'], 'start'=>$item['start'], 'end'=>$item['end'], 'more'=>$item['more'], 'more'=>$item['more'],
            's_lat'=>$item['s_lat'], 's_long'=>$item['s_long'], 'e_lat'=>$item['e_lat'], 'e_long'=>$item['e_long']];
    }
    return $routeList;
}