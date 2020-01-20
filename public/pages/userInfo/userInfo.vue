<template>
	<view>
		<!-- 头像 -->
		<view class="avatar">
			<view class="cu-avatar round lg xl margin-left bg" :style="[{ backgroundImage:'url(' + avatar + ')' }]">
				<text class="avatar-text" style="margin-top: 210upx;font-size: 32upx;">{{name}}</text>
			</view>
		</view>
		
		<!-- 资料设置列表 -->
		<view class="cu-list menu sm-border card-menu margin-top no-card">
			<!-- 紧急联系人 -->
			<view class="cu-item arrow" @tap="toChild" data-url="../setting/contact">
				<view class="content">
					<text class="cuIcon-addressbook text-red"></text>
					<text class="text-grey">紧急联系人</text>
				</view>
			</view>
			<!-- 常用路线管理 -->
			<view class="cu-item arrow" @tap="toChild" data-url="../setting/man_route">
				<view class="content">
					<text class="cuIcon-location text-orange"></text>
					<text class="text-grey">常用路线管理</text>
				</view>
			</view>
			<!-- 面部识别管理 -->
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-service text-blue"></text>
					<text class="text-grey">面部报警</text>
				</view>
				
				<view class="action">
					<switch @change="SwitchFace" class="blue switch" :class="switchFace?'checked':''" :checked="switchFace?true:false"></switch>
				</view>
			</view>
			<!-- 语音识别管理 -->
			<view class="cu-item">
				<view class="content">
					<text class="cuIcon-service text-blue"></text>
					<text class="text-grey">语音报警</text>
				</view>
				<view class="action">
					<switch @change="SwitchVice" class="blue switch" :class="switchVice?'checked':''" :checked="switchVice?true:false"></switch>
				</view>
			</view>
			
			<!-- 系统设置 -->
			<view class="cu-item arrow" @tap="toChild" data-url="../setting/setting">
				<view class="content">
					<text class="cuIcon-settings text-orange"></text>
					<text class="text-grey">系统设置</text>
				</view>
			</view>
			<!-- 常用路线管理 -->
			<view class="cu-item arrow" @tap="toChild" data-url="../userInfo/member">
				<view class="content">
					<text class="cuIcon-choiceness text-orange"></text>
					<text class="text-grey">安行会员</text>
				</view>
			</view>
			<!-- 反馈 -->
			<view class="cu-item arrow" @tap="toChild" data-url="../about/about">
				<view class="content">
					<text class="cuIcon-service text-orange"></text>
					<text class="text-grey">关于</text>
				</view>
			</view>
			<!-- 反馈 -->
			<view class="cu-item">
				<view class="content">
					<button @click="logout" class="btn-logout">退出</button>
				</view>
			</view>
			
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				switchFace:false,
				switchVice:false,
				name:"username",
				avatar:'https://ossweb-img.qq.com/images/lol/web201310/skin/big10001.jpg'
			}
		},
		onLoad:function(){
			const that = this;
			try{
				const userInfo = uni.getStorageSync('userInfo');
				// console.log(userInfo)
				that.name = userInfo.info.nickname
				that.avatar = userInfo.info.avatar
			}catch(e){
				uni.showToast({
					title:'系统被攻击，请联系管理员',
					icon:'loading',
					duration:3000
				})
			}
		},
		methods: {
			logout(){
				this.$token = null
				uni.setStorageSync("hasUserInfo",false);
				uni.removeStorageSync("userInfo");
				uni.redirectTo({
					url:"../login/login"
				})
			},
			toChild(e) {
				uni.navigateTo({
					url: e.currentTarget.dataset.url
				})
			},
			SwitchVice(e) {
				const that = this;
				console.log("操作语音报警")
				try{
					const userInfo = uni.getStorageSync('userInfo');
					if(!this.switchVice){
						uni.request({
							url:this.$serverUrl+"/userInfo.php",
							data:{
								act:"openVoice",
								token:userInfo.token
							},
							success:function(res){
								console.log(res)
								if(res.data.code === 200){
									this.switchVice = e.detail.value
								}
								uni.showToast({
									title:res.data.msg,
									icon:'none',
									duration:1500
								})
							}
						})
					}else{
						uni.request({
							url:thi.$serverUrl+"/userInfo.php",
							data:{
								act:"closeVoice",
								token:userInfo.token
							},
							success:function(res){
								if(res.data.code === 200){
									this.switchVice = e.detail.value
								}
								uni.showToast({
									title:res.data.msg,
									icon:'none',
									duration:1500
								})
							}
						})
					}
				}catch(e){
					uni.showToast({
						title:'系统被攻击，请联系管理员',
						icon:'loading',
						duration:3000
					})
				}
			},
			SwitchFace(e) {
				if(!this.switchFace){
					uni.showToast({
						title:"面部报警开启",
						icon:'none',
						duration:1500
					})
				}else{
					uni.showToast({
						title:"面部报警关闭",
						icon:'none',
						duration:1500
					})
				}
				
				this.switchFace = e.detail.value
			},
		}
	}
</script>

<style>
.avatar{
	width: 100%;
	background-color: #007AFF;
	height: 345upx;
	line-height: 345upx;
	text-align: center;
}
.bg{
	font-size: 245upx;
}
.btn-logout{
	width: 70%;
	height: 64upx;
	line-height: 64upx;
	border-radius: 32upx;
	background-color: #ec2b2e;
	color: #fff;
	margin: 0 auto;
}
</style>
