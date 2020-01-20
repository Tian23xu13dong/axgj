<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">声控系统</block>
		</cu-custom>
		<view class="cu-list menu sm-border">
			<!-- 语音报警 -->
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-info text-red"></text>
					<text class="text-grey">分贝报警</text>
				</view>
				<view class="action"><switch @change="switchDecibel" class="blue switch" :class="decibel ? 'checked' : ''" :checked="decibel ? true : false"></switch></view>
			</view>
			<!-- 语音报警 -->
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-warn text-red"></text>
					<text class="text-grey">敏感词报警</text>
				</view>
				<view class="action"><switch @change="switchSensitive" class="blue switch" :class="sensitive ? 'checked' : ''" :checked="sensitive ? true : false"></switch></view>
			</view>
			<!-- 语音报警 -->
			<view class="cu-item">
				<view class="content"><text class="text-grey">敏感词监控</text></view>
			</view>
			<view class="cu-item">
				<view class="content"><text class="text-grey">别碰我</text></view>
				<view class="action"><switch @change="Switch('skinA')" class="blue switch" :class="skinA ? 'checked' : ''" :checked="skinA ? true : false"></switch></view>
			</view>
			<!-- 语音报警 -->
			<view class="cu-item">
				<view class="content"><text class="text-grey">别伤害我</text></view>
				<view class="action"><switch @change="Switch('skinB')" class="blue switch" :class="skinB ? 'checked' : ''" :checked="skinB ? true : false"></switch></view>
			</view>

			<!-- 语音报警 -->
			<view class="cu-item">
				<view class="content"><text class="text-grey">救命啊</text></view>
				<view class="action"><switch @change="Switch('skinC')" class="blue switch" :class="skinC ? 'checked' : ''" :checked="skinC ? true : false"></switch></view>
			</view>
		</view>
	</view>
</template>

<script>
export default {
	data() {
		return {
			decibel: false,
			sensitive: false,
			skinA: false,
			skinB: false,
			skinC: false
		};
	},
	onLoad:function(e){
		console.log(e)
	},
	methods: {
		// 分贝报警开关
		switchDecibel(e) {
			this.decibel = e.detail.value;
		},
		// 敏感词报警开关
		switchSensitive(e) {
			this.sensitive = e.detail.value;
		},
		// 关键字报警开关
		Switch(skin) {
			console.log(skin)
			if(skin === 'skinA')
				this.skinA =!this.skinA
			else if(skin === 'skinB')
				this.skinB =!this.skinB
			else if(skin === 'skinC')
				this.skinC =!this.skinC
		}
	}
};
</script>

<style>
.page {
	height: 100vh;
	width: 100vw;
}
</style>
