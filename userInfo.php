<?php
$token = $_POST['token'] or false;
$act = $_POST['act'] or false;

// 检查是否提供授权码
if (!$token){
    quit(202, '您的请求是非法的，请先登录');
}

require_once 'core/config.php';
// 获取用户授权信息
$sql = "select id from user_info where token = '{$token}';";
$userId = $mysql->query($sql);
if ($userId->num_rows !== 1){
    quit(202,'您的token已过期，请重新登录后使用');
}
$userId = $userId->fetch_assoc()['id']; // 获取用户唯一ID
echo '<pre>';
switch ($act){
    case "upUserInfo":
        $data = $_POST['data'];
        $user = json_decode($data);
        var_dump(user);
        $sex = $user->sex;
        $date = $user->date;
        $avatar = $user->avatar;
        $name = $user->name;
        $nickname = $user->nickname;
        $phone = $user->phone;
        $textareaValue = $user->textareaValue;
        $sql = "UPDATE `user_info` SET `name` = '{$name}', `nickname` = '{$nickname}', `autograph` = '{$textareaValue}', `avatar` = 'http://ax.musiyu.wang/avatar/default.png', `birthday` = '{$date}', `sex` = '{$sex}' WHERE `id` = '{$userId}';";

        $up = $mysql->query($sql);
        if ($up){
            echo json_encode(['code'=>200, 'msg'=>'信息更新成功','data'=>$sql]);
        }
        //
        break;
    case 'openFace':
        $sql = "";
        $re = $mysql->query($sql);
        if ($re){
            echo json_encode(['code'=>200, 'msg'=>'面部报警开启成功']);
        }else
            echo json_encode(['code'=>201, 'msg'=>'面部报警开启失败']);
        break;
    case 'closeFace':
        $sql = "UPDATE `sys_user` SET `value` = 'false' WHERE `fid` = '{$userId}' and `key` = 'face_alarm';";
        $re = $mysql->query($sql);
        if ($re){
            echo json_encode(['code'=>200, 'msg'=>'面部报警关闭成功']);
        }else
            echo json_encode(['code'=>201, 'msg'=>'面部报警关闭失败']);
        break;
    case 'openVoice':
        $sql = "UPDATE `sys_user` SET `value` = 'true' WHERE `fid` = '{$userId}' and `key` = 'voice_alarm';";
        $re = $mysql->query($sql);
        if ($re){
            echo json_encode(['code'=>200, 'msg'=>'语音报警开启成功']);
        }else
            echo json_encode(['code'=>201, 'msg'=>'语音报警开启失败']);
        break;
    case 'closeVoice':
        $sql = "UPDATE `sys_user` SET `value` = 'false' WHERE `fid` = '{$userId}' and `key` = 'voice_alarm';";
        $re = $mysql->query($sql);
        if ($re){
            echo json_encode(['code'=>200, 'msg'=>'语音报警关闭成功']);
        }else
            echo json_encode(['code'=>201, 'msg'=>'语音报警关闭失败']);
        break;
    default:
        echo json_encode(['code'=>202, 'msg'=>'您的请求不合法，请联系管理员']);
        break;
}

$mysql->close();
