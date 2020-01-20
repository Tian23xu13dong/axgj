<template>
	<view>
		<map @markertap="markertop()"  style="width: 100%;height: 100%;" :controls="map.controls" :scale="map.scale" :latitude="map.latitude" :longitude="map.longitude"
		:markers="map.markers" :circles="map.circles" show-location="true"></map>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				map:{
					title: 'map',
					latitude: 27.5555,		// 中心纬度 
					longitude: 105.2222,	// 中心经度
					scale:16,				// 缩放级别，取值范围为5-18
					controls:[{				// 在地图上显示控件，控件不随着地图移动
						position:{},
						iconPath:'',
						clickable: true
					}],
					markers: []				,// 标记点用于在地图上显示标记的位置
					circles:[
						{
							latitude: 27.5555,		// 中心纬度
							longitude: 105.2222,
							radius:1000,
							color:"#0000AA",
							fillColor:"#0000AA"
						},
					]
				}
			}
		},
		onLoad: function(e){
			const map = this.map;
			uni.getLocation({
				type:'gcj02',
				success: function (res) {
					console.log(res.latitude)
					console.log(res.longitude)
					map.latitude = res.latitude;
					map.longitude = res.longitude;
					map.circles.latitude = res.latitude;
					map.circles.longitude = res.longitude;
				},
				fail:function(e){
					console.log("失败了");
					uni.showToast({
						title:e.errMsg,
						icon:'none',
						duration:3000
					})
					console.log(e.errMsg);
					// if(e.errMsg == )
				}
			});
		},
		methods: {
			markertop(e){
				console.log(e)
			}
			
		}
	}
	
</script>
<style>
	
</style>