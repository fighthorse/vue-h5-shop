import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'


import HelloWorld from '@/components/HelloWorld'

var shop = require("../pages/shop.vue")

var routes = [
	{path:"/", name: 'HelloWorld',component:HelloWorld},
	{path:"/shop/",component:shop},
];

Vue.use(Router)
Vue.use(VueResource);

export default new Router({
  routes
})

