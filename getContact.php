<?php

$token = $_POST['token'] or false;
$act = $_POST['act'] or false;

require_once 'core/config.php';
// 检查是否提供授权码
if (!$token){
    quit(202, '您的请求是非法的，请先登录');
}

// 获取用户授权信息
$sql = "select id from user_info where token = '{$token}';";
$userId = $mysql->query($sql);
if ($userId->num_rows !== 1){
    quit(202,'您的token已过期，请重新登录后使用');
}
$userId = $userId->fetch_assoc()['id']; // 获取用户唯一ID

// 根据用户请求的操作返回数据，如果没有提供请求参数，则返回紧急联系人列表
switch ($act){
    case 'adduser':
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        if (!checkPhone($phone)){
            quit(203, '您请求的手机号('.$phone.')不合法，请重新添加');
        }
        $checkUserPhone = "select *from contact where fid = '{$userId}' and phone = '{$phone}';";
        $resCheckUserPhone = $mysql->query($checkUserPhone);
        if ($resCheckUserPhone->num_rows > 0){
            quit(204, '手机号已存在，请检查后重新添加');
        }
        $sql = "INSERT INTO `contact`(`name`, `phone`, `fid`, `creater`) VALUES ('{$name}', '{$phone}', '{$userId}', '".time()."');";
        $inUser = $mysql->query($sql);
        if ($inUser){
            echo json_encode(['code'=>200, 'msg'=>'紧急联系人添加成功', 'contactList'=>getContact($mysql, $userId)]);
        }

        break;
    default:

        echo json_encode(['code'=>200, 'msg'=>'紧急联系人列表获取成功', 'contactList'=>getContact($mysql, $userId)]);
        break;
}

$mysql->close();

// 函数

/**
 * @param \mysqli $mysql
 * @param int $userId
 * @return array
 */
function getContact($mysql, $userId){
    $selectContact = "select *from contact where fid = '{$userId}';";
    $resContact = $mysql->query($selectContact);
    $contactList = [];  // 紧急联系人列表
    foreach ($resContact as $item){
        $contactList []= ['id'=>$item['id'], 'name'=>$item['name'], 'phone'=>$item['phone']];
    }
    return $contactList;
}
/**
 * 检查电话号码是否正常
 * @param $phone
 * @return bool
 */
function checkPhone($phone){
    if (is_string($phone) && strlen($phone) === 11)
        return true;
    return false;
}
