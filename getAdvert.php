<?php

echo json_encode(['code'=>200,'msg'=>'广告获取成功', 'advertList'=>[
	['id'=>0, 'title'=>'1广告标语广告标语广告标语广告标语广告标语广告标语', 'src'=>'http://ax.musiyu.wang/banner/20200109164317.jpg']
	,['id'=>1, 'title'=>'2广告标语广告标语广告标语广告标语广告标语广告标语', 'src'=>'http://ax.musiyu.wang/banner/20200109164321.jpg']
	,['id'=>2, 'title'=>'3广告标语广告标语广告标语广告标语广告标语广告标语', 'src'=>'https://ossweb-img.qq.com/images/lol/web201310/skin/big99008.jpg']
	]]);
// advert

/**
 * <swiper-item v-for="(item,index) in 3" :key="index">
	<view class="cu-card case  no-card">
		<view class="cu-item shadow">
			<view class="image">
				<image src="https://ossweb-img.qq.com/images/lol/web201310/skin/big10006.jpg"
				 mode="widthFix"></image>
				<view class="cu-tag bg-blue">广告</view>
				<view class="cu-bar bg-shadeBottom"> <text class="text-cut">{{}}</text></view>
			</view>
		</view>
	</view>
</swiper-item>

*/