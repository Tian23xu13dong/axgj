<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">系统设置</block>
		</cu-custom>
		<!-- 资料设置列表 -->
		<!-- <view class="cu-list menu sm-border card-menu margin-top"> -->
		<view class="cu-list menu sm-border">
			<!-- 账号管理 -->
			<view class="cu-item arrow" @tap="toChild" data-url="./account">
				<view class="content">
					<text class="cuIcon-friend text-orange"></text>
					<text class="text-grey">账号管理</text>
				</view>
			</view>
			<!-- 面部信息录入 -->
			<view class="cu-item arrow" @tap="toChild" data-url="./man_face">
				<view class="content">
					<text class="cuIcon-camera text-red"></text>
					<text class="text-grey">信息录入</text>
				</view>
			</view>
			<!-- 声控系统 -->
			<view class="cu-item arrow" @tap="toChild" data-url="./alarm_voice">
				<view class="content">
					<text class="cuIcon-voice text-orange"></text>
					<text class="text-grey">声控系统</text>
				</view>
			</view>
			<!-- 蓝牙 -->
			<view class="cu-item arrow" @tap="toChild" data-url="./alarm_voice">
				<view class="content">
					<image src="/static/icon/Bluetooth.png" class="png" mode="aspectFit"></image>
					<text class="text-grey">蓝牙</text>
				</view>
			</view>
			
			<!-- 应用设置 -->
			<view class="cu-item arrow" @tap="toChild" data-url="./apps">
				<view class="content">
					<text class="cuIcon-apps text-orange"></text>
					<text class="text-grey">应用设置</text>
				</view>
			</view>
			
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				
			};
		},
		methods: {
				toChild(e) {
					uni.navigateTo({
						url: e.currentTarget.dataset.url
					})
				},
		}
	}
</script>

<style>
	.page {
		height: 100Vh;
		width: 100vw;
	}

</style>
