// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'

import iView from 'iview';
//import 'iview/dist/styles/iview.css';
import './assets/less/index.less';

Vue.use(iView);

//全局配置
import './global.js'

Vue.config.productionTip = false

//使用一个空的Vue实例作为中央事件总线
window.eventHub = new Vue();

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  components: { App },
  template: '<App/>'
})
