<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">安行会员</block>
		</cu-custom>
		
		<!-- 轮播图 -->
		<swiper class="screen-swiper round-dot" :indicator-dots="true" :circular="true" :autoplay="true" interval="5000" duration="500">
			<swiper-item v-for="(item,index) in swiperList" :key="index">
				<image :src="item.url" mode="aspectFill" v-if="item.type=='image'"></image>
				<video :src="item.url" autoplay loop muted :show-play-btn="false" :controls="false" objectFit="cover" v-if="item.type=='video'"></video>
			</swiper-item>
		</swiper>
		<!-- 卡片菜单 -->
		<view class="cu-list grid col-3 no-border">
			<view class="cu-item" v-for="item in cuIconList" :key="item.index">
				<view :class="['cuIcon-' + item.cuIcon,'text-' + item.color]">
					<view class="cu-tag badge" v-if="item.badge!=0">
						<block v-if="item.badge!=1">{{item.badge>99?'99+':item.badge}}</block>
					</view>
				</view>
				<text>{{item.name}}</text>
			</view>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				cuIconList: [{
					cuIcon: 'github',
					color: 'blue',
					badge: 0,
					name: '会员专区'
				}, {
					cuIcon: 'apps',
					color: 'blue',
					badge: 0,
					name: '热门功能'
				}, {
					cuIcon: 'crown',
					color: 'blue',
					badge: 0,
					name: '开通会员'
				}],
				swiperList: []
				
			};
		},
		onLoad:function(){
			this.getSwiper();
		},
		methods: {
			getSwiper(){
				uni.request({
					url:this.$serverUrl+"/index.php?act=getSwiper",
					success:(res)=>{
						if(res.statusCode == 200)
							this.swiperList = res.data.swiperList;
					}
				});
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
