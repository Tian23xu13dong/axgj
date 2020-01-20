<template>
	<view>
		<view class="cu-bar bg-blue"><view class="content text-bold">安行管家</view></view>
		<mescroll-uni :down="downOption" @down="downCallback" :up="upOption" @up="upCallback">
			<!-- 轮播图 -->
			<swiper class="screen-swiper round-dot" :indicator-dots="true" :circular="true" :autoplay="true" interval="5000" duration="500">
				<swiper-item v-for="(item, index) in swiperList" :key="index">
					<image :src="item.url" mode="aspectFill" v-if="item.type == 'image'"></image>
					<video :src="item.url" autoplay loop muted :show-play-btn="false" :controls="false" objectFit="cover" v-if="item.type == 'video'"></video>
				</swiper-item>
			</swiper>

			<!-- 卡片菜单 -->
			<view class="cu-list grid col-4 no-border">
				<view class="cu-item" v-for="(item, index) in cuIconList" :key="index">
					<view :class="['cuIcon-' + item.cuIcon, 'text-' + item.color]" @click="toMenu" data-url="{{item.href}}">
						<view class="cu-tag badge" v-if="item.badge != 0">
							<block v-if="item.badge != 1">{{ item.badge > 99 ? '99+' : item.badge }}</block>
						</view>
					</view>
					<text>{{ item.name }}</text>
				</view>
			</view>

			<!-- 系统广告占位 -->
			<swiper style="margin-bottom: 12upx;" class="screen-swiper round-dot" :indicator-dots="true" :circular="true" :autoplay="true" interval="5000" duration="500">
				<swiper-item v-for="item in advertList" :key="item.id">
					<view class="cu-card case  no-card">
						<view class="cu-item shadow">
							<view class="image">
								<image :src="item.src" mode="widthFix"></image>
								<view class="cu-tag bg-blue">广告</view>
								<view class="cu-bar bg-shadeBottom">
									<text class="text-cut">{{ item.title }}</text>
								</view>
							</view>
						</view>
					</view>
				</swiper-item>
			</swiper>

			<view style="margin-top: 12upx;height: 64upx;line-height: 64upx;background-color: #fff;display: flex;flex-direction: row;">
				<view style="font-size: 42upx;" class="cuIcon-safe text-blue"></view>
				<text style="margin-left: 12upx;font-size: 32upx;font-weight: bold;">安行课堂</text>
			</view>
			<block v-for="(item, index) in workList" :key="index">
				<!-- 文章列表 使用 no-card 样式全屏 -->
				<view class="cu-card article" @tap="toChild" data-url="../detail/detail">
					<view class="cu-item shadow">
						<view class="title">
							<view class="text-cut">{{ item.title }}</view>
						</view>
						<view class="content">
							<image :src="item.src" mode="aspectFill"></image>
							<view class="desc">
								<view class="text-content">{{ item.word }}</view>
								<view>
									<view v-for="tag in item.tags" :key="tag.id" :class="'bg-' + tag.color" class="cu-tag light sm round">{{ tag.key }}</view>
								</view>
							</view>
						</view>
					</view>
				</view>
			</block>
		</mescroll-uni>
	</view>
</template>

<script>
// 引入mescroll-uni组件
import MescrollUni from '@/components/mescroll-uni/mescroll-uni.vue'; // 注意.vue后缀不能省
export default {
	components: {
		MescrollUni
	},
	data() {
		return {
			// 下拉刷新的常用配置
			downOption: {
				use: true, // 是否启用下拉刷新; 默认true
				auto: true // 是否在初始化完毕之后自动执行下拉刷新的回调; 默认true
			},
			// 上拉加载的常用配置
			upOption: {
				use: true, // 是否启用上拉加载; 默认true
				auto: true, // 是否在初始化完毕之后自动执行上拉加载的回调; 默认true
				
			},
			cuIconList: [
				{
					cuIcon: 'phone',
					color: 'blue',
					badge: 0,
					href: '/pages/more/come_call',
					name: '伪装来电'
				},
				{
					cuIcon: 'voice',
					color: 'blue',
					badge: 0,
					href: '/pages/more/chat',
					name: '伪装语音'
				},
				{
					cuIcon: 'share',
					color: 'blue',
					badge: 0,
					href: '/pages/more/chat',
					name: '位置分享'
				},
				{
					cuIcon: 'shop',
					color: 'blue',
					badge: 0,
					href: '/pages/more/shop',
					name: '安行商城'
				}
			],
			swiperList: [],
			advertList: [],
			workList: []
		};
	},
	onLoad: function() {
		this.getSwiper();
		this.getMenu();
		this.getADList();
		this.getWork();
	},
	methods: {
		/*下拉刷新的回调, 有三种处理方式: */
		downCallback(mescroll) {
			// console.log(mescroll)
			this.getADList();
			this.getSwiper();
			this.getWork();
			mescroll.endSuccess();
		},
		/*上拉加载的回调*/
		upCallback(mescroll) {
			this.getWork();
			mescroll.endSuccess();
		},
		toMenu(e) {
			// console.log(e);
			uni.navigateTo({
				url: e.currentTarget.dataset.url
			});
		},
		toChild(e) {
			// console.log(e);
			uni.navigateTo({
				url: e.currentTarget.dataset.url
			});
		},
		getSwiper() {
			let that = this;
			uni.request({
				url: this.$serverUrl + '/index.php?act=getSwiper',
				success: res => {
					if (res.statusCode == 200) {
						that.swiperList = res.data.swiperList;
					}
				}
			});
		},
		getADList() {
			let that = this;
			uni.request({
				url: this.$serverUrl + '/getAdvert.php',
				success(res) {
					if (res.statusCode == 200) {
						// console.log(res.data);
						that.advertList = res.data.advertList;
					}
				}
			});
		},
		getMenu() {
			let that = this;
			uni.request({
				url: this.$serverUrl + '/index.php?act=getMenu',
				success: res => {
					if (res.statusCode == 200) that.cuIconList = that.cuIconList.concat(res.data.menuList);
				}
			});
		},
		getWork() {
			let that = this;
			uni.request({
				url: this.$serverUrl + '/index.php?act=getWork',
				success: res => {
					// console.log('打印work:', res);
					if (res.statusCode == 200) that.workList = res.data.workList;
				}
			});
		}
	}
};
</script>

<style>
.loadMore {
	font-size: 30upx;
	color: #555;
	margin-bottom: 20upx;
}
</style>
