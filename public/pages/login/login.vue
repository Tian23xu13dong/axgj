<template>
	<view >
		<view class="login">
			<view class="logo">
				<image class="logo-img" src="../../static/icon/logo.png" mode="scaleToFill"></image>
				<text class="login-text">安行管家</text>
			</view>
			<text class="more-text">为您的出行安全保驾护航</text>
		</view>
		 
		 <form class="form">
		 	<input @blur="setPhone" class="in-phone" type="text" value="" placeholder="请输入手机号"/>
		 	<input @blur="setPasswd" class="in-yzm" type="text" value="" placeholder="请输入密码"/>
		 	<button @click="login" class="btn-submit" hover-class="btn" form-type="submit">登录</button>
		 </form>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				phone:"",
				passwd:"",
				isCheck:false,
				isPhone:false,
				isPassword:false
			}
		},
		
		onLoad:function(e){
			try{
				const hasUserInfo = uni.getStorageSync("hasUserInfo")
				const user = uni.getStorageSync("userInfo")
				if(user){
					this.isPhone = true
					this.isPassword = true
					this.phone = user.phone
					this.passwd = user.passwd
				}
				
				if(hasUserInfo){
					if(this.$debug)
						this.submit('18785618024', '123456') // DEBUG 专用
					else
						this.submit(user.phone, user.passwd)
					
				}
				// console.log('登录检查完毕')
			}catch(e){
				console.log('登录检查异常')
				console.log(e)
			}
		
		},
		
		methods: {
			submit(phone,passwd){
				uni.setStorageSync('hasUserInfo', false);
				let that = this;
				uni.request({
					url:this.$serverUrl+"/login.php",
					header:{
					'Content-type':'application/x-www-form-urlencoded'
					},
					method:"POST",
					data:{
						phone:phone,
						passwd:passwd
					},
					success: (request) => {
						request = request.data
						console.log(request)
						if(request.code == 200){
							try {
								// console.log(request)
							    uni.setStorageSync('hasUserInfo', true);
							    uni.setStorageSync('userInfo', {
									phone: that.phone,
									passwd: that.passwd,
									token: request.token,
									info:request.info
								});
								
								// 设置全局 token
								this.$token = request.token
								
								uni.showToast({
									title:request.msg,
									icon:"success",
									duration:1000,
								})
								uni.switchTab({
									url:"../map/map"
								})
							} catch (e) {
							    // error
							}
						}else{
							uni.showToast({
								icon:'loading',
								title:request.code+request.msg
							})
						}
					}
				});
			},
			login(e){
				if(this.isPhone && this.isPassword){
					// console.log("账号："+this.phone,"密码："+this.passwd)
					this.submit(this.phone, this.passwd)
				}else{
					uni.showToast({
						title:"您输入的账号或密码长度不正确",
						icon:"none"
					})
				}
				
			},
			setPhone(e){
				var p = e.detail.value
				if(p.length == 11){
					this.isPhone = true
					this.phone = e.detail.value
				}else{
					this.isPhone = false
				}
			},
			setPasswd(e){
				var p = e.detail.value
				if(p.length >= 6 && p.length <= 12){
					this.isPassword = true
					this.passwd = e.detail.value
				}else{
					this.isPassword = false
				}
			}
			
		}
	}
</script>

<style>
	text{
		color: #007AFF;
	}
	.login{
		width: 100%;
		height: 100%;
		display: flex;;
		flex-direction: column;
		padding: 62upx;
	}
	
	.logo{
		height: 128upx;
		line-height: 128upx;
		display: flex;
		flex-direction: row;
	}
	.logo-img {
		width: 128upx;
		height: 128upx;
	}
	.login-text{
		margin-left: 24upx;
		font-size: 42upx;
		font-weight: bold;
	}
	.more-text{
		margin-top: 24upx;;
		font-size: 32upx;;
	}
	
	.form{
		background-color: #007AFF;
		margin-top: 240upx;
	}
	
	input{
		margin: 0 auto;
		width: 80%;
		margin-top: 34upx;
		height: 64upx;
		line-height: 64upx;
		padding-left: 32upx;
		border-bottom: 2upx solid #c7c7c7;
	}
	.in-phone{
		margin-top: 120upx;
	}
	
	.btn-submit{
		background-color: #0081FF;
		color: #fff;
		width: 80%;
		margin: 0 auto;
		margin-top: 64upx;
		border-radius: 64upx;
	}
	.btn{
		background-color: #007AFF;
	}
</style>
