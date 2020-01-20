<?php
header("Access-Control-Allow-Origin: *");
require_once 'core/config.php';

$act = @$_GET['act'];
if ($act === 'getMenu')
    echo json_encode(['code'=>200,'msg'=>'菜单获取成功','sys_color'=>'blue','menuList'=>[
        ['cuIcon'=>'phone','color'=>'blue', 'badge'=>0, 'href'=>'#', 'name'=>'camera']
    ]]);

if ($act === 'getSwiper')
    echo json_encode(['code'=>200,'msg'=>'轮播图获取成功','swiperList'=>[
    	["id"=>0,"type"=>"image",'url'=>'http://ax.musiyu.wang/banner/20200109164317.jpg'],
    	["id"=>1,"type"=>"image",'url'=>'http://ax.musiyu.wang/banner/20200109164321.jpg'],
        ["id"=>2,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big39000.jpg']
    ]]);

if($act === 'getWork'){
	 echo json_encode(['code'=>200,'msg'=>'文章获取成功','workList'=>[
	 		['id'=>1, 'title'=>'我校消防安全知识课首次走出课堂', 'src'=>'http://ax.musiyu.wang/images/202001.jpg', 'word'=>'此次演练由副院长池涌任指挥官，过程完全模拟真实场景，演练内容分为“火情警报、应急疏散、指挥协调、现场控制、演习讲评”', 'tags'=>[
		 		['id'=>1, 'color'=>"red", 'key'=>"校园资讯"],
		 		['id'=>3, 'color'=>"orange", 'key'=>"消防安全"]
	 		]],
	 		['id'=>2, 'title'=>'我校消防安全知识课首次走出课堂', 'src'=>'http://ax.musiyu.wang/images/202001.jpg', 'word'=>'此次演练由副院长池涌任指挥官，过程完全模拟真实场景，演练内容分为“火情警报、应急疏散、指挥协调、现场控制、演习讲评”', 'tags'=>[
		 		['id'=>1, 'color'=>"red", 'key'=>"校园资讯"],
		 		['id'=>3, 'color'=>"orange", 'key'=>"消防安全"]
	 		]]
	 ]]);
}

$mysql->close();

// ["id"=>0,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big84000.jpg'],
// ["id"=>1,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big37006.jpg'],
// ["id"=>2,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big39000.jpg'],
// ["id"=>3,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big10001.jpg'],
// ["id"=>4,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big25011.jpg'],
// ["id"=>5,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big21016.jpg'],
// ["id"=>6,"type"=>"image",'url'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big99008.jpg']