/* eslint-disable */ 
import Vue from 'vue'
import Router from 'vue-router'
import VueResource from 'vue-resource'


import HelloWorld from '../components/HelloWorld.vue'

/*shop*/
import Shop from "../pages/shop/Shop.vue"

/*chat*/
import Chat from "../pages/chat/Chat.vue"


var routes = [
	{path:"/", name: 'HelloWorld',component:HelloWorld},
	{path:"/shop",name: 'Shop',component:Shop},
	{path:"/chat",name: 'Chat',component:Chat},
];

Vue.use(Router)
Vue.use(VueResource);

export default new Router({
  routes
})

