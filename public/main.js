import Vue from 'vue'
import App from './App'

import cuCustom from './colorui/components/cu-custom.vue'
Vue.component('cu-custom',cuCustom)

Vue.config.productionTip = false

// DEBUG是用地址
Vue.prototype.$debug = false
Vue.prototype.$serverUrl = "http://anxgj.test"

// 全局配置
Vue.prototype.$serverUrl = "http://ax.musiyu.wang"
Vue.prototype.$appName = "安行管家"
Vue.prototype.$token = null

Vue.prototype.$openManage = {
	voice: false,
	face: false
}

App.mpType = 'app'

const app = new Vue({
    ...App
})

app.$mount()
