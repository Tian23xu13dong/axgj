<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">面部信息管理</block>
		</cu-custom>
		<view class="cu-list menu sm-border">
			<!-- 语音报警 -->
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-emoji text-blue"></text>
					<text class="text-grey">刷脸登录</text>
				</view>
				<view class="action"><switch @change="SwitchFace" class="blue switch" :class="switchFace ? 'checked' : ''" :checked="switchFace ? true : false"></switch></view>
			</view>

			<view class="cu-item">
				<view class="content">
					{{ faceUrl }}
					<image style="width: 100%;" mode="widthFix" :src="faceUrl"></image>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
export default {
	data() {
		return {
			switchFace: false,
			faceUrl: null
		};
	},
	methods: {
		SwitchFace(e) {
			const user = uni.getStorageSync('userInfo');
			const that = this;
			if (!this.switchFace) {
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['camera'], //从相册选择
					success: function(res) {
						that.faceUrl = res.tempFilePaths;
						uni.uploadFile({
							url: this.$serverUrl + '/setting/openFace.php',
							filePath: res.tempFilePaths,
							name: 'faceFile',
							formData: {
								token: user.token
							},
							success: res => {
								console.log(res);
								this.switchFace = e.detail.value;
								uni.showToast({
									title: res.data.msg,
									icon: 'none',
									duration: 1500
								});
							}
						});
					}
				});
			} else {
				uni.request({
					url: this.$serverUrl + '/setting/colseFace.php',
					data: {
						token: user.token
					},
					success: function(res) {
						this.switchFace = e.detail.value;
						uni.showToast({
							title: res.data.msg,
							icon: 'none',
							duration: 1500
						});
					}
				});
			}
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
