<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">常用路线管理</block>
			<block slot="right">
				<text @click="addRoute" class="cuIcon-roundadd text-lg margin-right-lg"></text>
			</block>
		</cu-custom>
		
		<!-- <view class="cu-list menu-avatar"> -->
		<view class="cu-list menu sm-border margin-top">
			<view class="cu-item" :class="modalName=='move-box-'+ index?'move-cur':''" v-for="(item,index) in routeList" :key="index"
			 @touchstart="ListTouchStart" @touchmove="ListTouchMove" @touchend="ListTouchEnd" :data-target="'move-box-' + index">
				<!-- <view class="cu-avatar round lg" :style="[{backgroundImage:'url(https://ossweb-img.qq.com/images/lol/web201310/skin/big2100'+ (index+2) +'.jpg)'}]"></view> -->
				<view class="content">
					<view>
						<text class="cuIcon-location text-blue  margin-right-xs"></text>{{item.start}}
					</view>
					<view class="text-gray text-sm">
						<text class="cuIcon-infofill text-orange  margin-right-xs"></text> {{item.more}}</view>
				</view>
				<view class="action">
					<text class="cuIcon-locationfill text-blue margin-right-xs"></text>{{item.end}}
				</view>
				<view class="move">
					<view @click="delRotue(item)" class="bg-red">删除</view>
				</view>
			</view>
		</view>
	</view>
</template>

<script>
export default {
	data() {
		return {
			routeList:[],
			modalName: null,
			listTouchStart: 0,
			listTouchDirection: null,
		};
	},
	onLoad:function(e){
		try{
			let user = uni.getStorageSync("userInfo")
			this.getRouteList(user.token, this);
		}catch(e){
			uni.showToast({
				title:'系统被攻击，请联系管理员',
				icon:'loading',
				duration:3000
			})
		}
	},
	methods: {
		getRouteList(token, that){
			uni.request({
				url:that.$serverUrl+"/setting/rotue.php",
				header:{
				'Content-type':'application/x-www-form-urlencoded'
				},
				method:"POST",
				data:{
					act:'getRouteList',
					token:token
				},
				success:function(res){
					console.log(res)
					if(res.data.code === 200)
						that.routeList = res.data.data
					else {
						uni.showToast({
							title:res.data.msg,
							icon:'none',
							duration:2000
						})
						if(res.data.code === 202){
							uni.navigateTo({
								url:'../login/login'
							})
						}
					}
				}
			})
		},
		// 添加新路线
		addRoute(){
			uni.showToast({
				title:"添加新路线功能正在开发中，请耐心等待哦",
				icon:'none',
				duration:2000
			})
			
		},
		// 删除线路
		delRotue(r){
			uni.showToast({
				title:"正在删除路线："+r.id,
				icon:'none'
			})
		},
		// ListTouch触摸开始
		ListTouchStart(e) {
			this.listTouchStart = e.touches[0].pageX
		},
		
		// ListTouch计算方向
		ListTouchMove(e) {
			this.listTouchDirection = e.touches[0].pageX - this.listTouchStart > 0 ? 'right' : 'left'
		},
		
		// ListTouch计算滚动
		ListTouchEnd(e) {
			if (this.listTouchDirection == 'left') {
				this.modalName = e.currentTarget.dataset.target
			} else {
				this.modalName = null
			}
			this.listTouchDirection = null
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
