<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">应用管理</block>
		</cu-custom>
		<view class="cu-list menu sm-border">
			<!-- 语音报警 -->
			<view class="cu-item" @tap="toChild" data-url="./account">
				<view class="content">
					<text class="cuIcon-friend text-orange"></text>
					<text class="text-grey">语音报警</text>
				</view>
				<view class="action">
					<switch @change="Switch" class="blue switch" :class="skin?'checked':''" :checked="skin?true:false"></switch>
				</view>
			</view>
			
			<!-- 语音报警 -->
			<view class="cu-item" @tap="toChild" data-url="./account">
				<view class="content">
					<text class="cuIcon-friend text-orange"></text>
					<text class="text-grey">语音报警</text>
				</view>
				<view class="action">
					<switch @change="Switch" class="blue switch" :class="skin?'checked':''" :checked="skin?true:false"></switch>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				skin:true
			};
		},
		methods: {
			Switch(e) {
				this.skin = e.detail.value
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
