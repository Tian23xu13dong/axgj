<template>
	<view>
		<cu-custom bgColor="bg-gradual-blue" :isBack="true">
			<block slot="backText">返回</block>
			<block slot="content">{{title}}</block>
		</cu-custom>
		<image :src="src" mode="widthFix" style="width: 100%;"></image>
		
	</view>
</template>

<script>
	export default {
		data() {
			return {
				title:"详情页面",
				type:"video",
				src:"http://ax.musiyu.wang/images/20200109162232.jpg"
			}
		},
		onLoad() {
			
		},
		methods: {
			
		}
	}
</script>

<style>

</style>
