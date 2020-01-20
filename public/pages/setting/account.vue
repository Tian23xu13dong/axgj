<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">编辑资料</block>
		</cu-custom>
		<form>
			<view class="cu-list menu-avatar margin-top">
				<view @tap="ChooseImage" class="cu-item">
					<image @tap="ViewImage" :data-url="avatar" class="cu-avatar radius lg" :src="avatar"><image>
					<view class="content">头像</view>
					<view class="action">
						<view class="cu-tag bg-red" @tap.stop="DelImg">
							<text class='cuIcon-close'></text>
						</view>
					</view>
				</view>
			</view>
			
			<view class="cu-form-group align-start">
				<view class="title">签名</view>
				<textarea maxlength="-1" @blur="setAutograph" :value="textareaValue" name="autograph" placeholder="个性签名"></textarea>
			</view>
			<view class="cu-form-group margin-top">
				<view class="title">姓名</view>
				<input placeholder="真实姓名" @blur="setName" :value="name" name="name"></input>
			</view>
			<view class="cu-form-group">
				<view class="title">昵称</view>
				<input placeholder="昵称" @blur="setNickName" :value="nickname" name="nickname"></input>
			</view>
			<view class="cu-form-group margin-top">
				<view class="title">性别</view>
				<picker @change="PickerChange" :value="sex" :range="picker">
					<view class="picker">
						{{sex>-1?picker[sex]:'请选择'}}
					</view>
				</picker>
			</view>
			<view class="cu-form-group">
				<view class="title">生日</view>
				<picker mode="date" :value="date" start="1990-01-01" end="2020-12-01" @change="DateChange">
					<view class="picker">
						{{date}}
					</view>
				</picker>
			</view>
			
			<view class="cu-form-group margin-top">
				<view class="title">手机号码</view>
				<input placeholder="请输入手机号码" @blur="setPhone" :value="phone" name="phone"></input>
				<view class="cu-capsule radius">
					<view class='cu-tag bg-blue '>
						+86
					</view>
					<view class="cu-tag line-blue">
						中国大陆
					</view>
				</view>
			</view>
			<view class="cu-form-group">
				<view class="title">验证码</view>
				<input @focus="setCode" placeholder="请输入验证码" name="code"></input>
				<button class='cu-btn bg-green shadow'>验证码</button>
			</view>
			
			<view class="cu-form-group">
				<button class="button-hover" :loading="subload" size="mini" form-type="submit" @click="submit" type="primary" >保存</button>
			</view>
		</form>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				subload:false,
				sex: -1,
				picker: ['女', '男', '保密'],
				date: '2020-01-01',
				avatar:null,
				name:null,
				nickname:null,
				phone:null,
				code:null,
				textareaValue: ''
			};
		},
		onLoad:function(){
			try{
				let user = uni.getStorageSync("userInfo");
				console.log(user)
				this.phone = user.phone;
				this.avatar = user.info.avatar;
				this.date = user.info.birthday;
				this.name = user.info.name;
				this.nickname = user.info.nickname;
				this.textareaValue = user.info.autograph;
				this.sex = user.info.sex;
			}catch(e){
				console.log(e.getMessage())
			}
		},
		methods: {
			submit(e){
				console.log(this.$data)
				if(this.phone != null && this.phone.length === 11){
					try{
						let user = uni.getStorageSync('userInfo');
						uni.request({
							url:this.$serverUrl+"/userInfo.php",
							data:{
								act: 'upUserInfo',
								token: user.token,
								data:JSON.stringify(this.$data)
							},
							header:{
							'Content-type':'application/x-www-form-urlencoded'
							},
							method:'POST',
							success:function(res){
								console.log(res)
							}
						})
					}catch(e){
						console.log(e)
					}
				}
			},
			setAutograph(e){
				this.textareaValue = e.detail.value
			},
			setName(e){
				this.name = e.detail.value
			},
			setNickName(e){
				this.nickname = e.detail.value
			},
			setPhone(e){
				if(e.detail.length === 11){
					this.phone = e.detail.value
				}
			},
			setCode(e){
				uni.showToast({
					title:"验证码功能还在开发中。。。",
					icon:'none',
					duration:1500
				})
				this.code = e.detail.value
			},
			PickerChange(e) {
				this.sex = e.detail.value
			},
			DateChange(e) {
				this.date = e.detail.value
			},
			ChooseImage() {
				uni.chooseImage({
					count: 1, //默认9
					sizeType: ['original', 'compressed'], //可以指定是原图还是压缩图，默认二者都有
					sourceType: ['album','camera'], //从相册选择
					success: (res) => {
						this.avatar = res.tempFilePaths
					}
				});
			},
			ViewImage(e) {
				uni.previewImage({
					urls: [this.avatar],
					current: this.avatar
				});
			},
			DelImg(e) {
				uni.showModal({
					title: '亲爱的用户',
					content: '确定要换一张美照吗？',
					cancelText: '再看看',
					confirmText: '再见',
					success: res => {
						if (res.confirm) {
							this.avatar = null
						}
					}
				})
			},
			textareaInput(e) {
				this.textareaValue = e.detail.value
			}
		}
	}
</script>

<style>
	page{
		width: 100vw;
		height: 100vh;
	}
	.cu-form-group .title {
		min-width: calc(4em + 15px);
	}
</style>
