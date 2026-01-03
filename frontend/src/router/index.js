import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '@/stores/user'
import config from '../config'
import Home from '../views/Index.vue';
const routes = [{
		path: '/',
		name: 'home',
		component: Home
	},
	{
		path: '/trade',
		name: 'trade',
		component: () => import('../views/Trade.vue')
	},
	{
		path: '/list',
		name: 'list',
		component: () => import('../views/List.vue')
	},
	{
		path: '/user',
		name: 'user',
		component: () => import('../views/User.vue')
	},
	{
		path: '/withdraw',
		name: 'withdraw',
		component: () => import('../views/Withdraw.vue')
	},
	//登陆
	{
		path: '/login',
		name: 'login',
		component: () => import('../views/Login.vue')
	},
	//注册 
	{
		path: '/signup',
		name: 'signup',
		component: () => import('../views/Signup.vue')
	},
	//多语言选择
	{
		path: '/lang',
		name: 'lang',
		component: () => import('../views/Lang.vue')
	},
	//修改密码
	{
		path: '/password',
		name: 'password',
		component: () => import('../views/Password.vue')
	},
	//修改交易密码
	{
		path: '/securitypin',
		name: 'securitypin',
		component: () => import('../views/Securitypin.vue')
	},
	//帮助
	{
		path: '/faq',
		name: 'faq',
		component: () => import('../views/Faq.vue')
	},
	//team
	{
		path: '/team',
		name: 'team',
		component: () => import('../views/Team.vue')
	},
	//team
	{
		path: '/teamDetail',
		name: 'teamDetail',
		component: () => import('../views/TeamDetail.vue')
	},
	//谷歌验证
	{
		path: '/authenticator',
		name: 'authenticator',
		component: () => import('../views/Authenticator.vue')
	},
	//账户记录
	{
		path: '/records',
		name: 'records',
		component: () => import('../views/Records.vue')
	},
	//充值
	{
		path: '/recharge',
		name: 'recharge',
		component: () => import('../views/Recharge.vue')
	},
	//邀请
	{
		path: '/invite',
		name: 'invite',
		component: () => import('../views/Invite.vue')
	},
	//客服
	{
		path: '/customer-service',
		name: 'customer-service',
		component: () => import('../views/CustomerService.vue')
	},
	//忘记密码客服
	{
		path: '/forgot-password-kf',
		name: 'forgot-password-kf',
		component: () => import('../views/ForgotPasswordKf.vue')
	},
	//公告列表
	{
		path: '/notice-list',
		name: 'notice-list',
		component: () => import('../views/NoticeList.vue')
	},
	//公告详情
	{
		path: '/notice-detail',
		name: 'notice-detail',
		component: () => import('../views/NoticeDetail.vue')
	}
]
const router = createRouter({
	history: createWebHistory(config.basePath),
	routes
})
// 路由进入的时候判断用户token
// 白名单路由
const pulicRouterList = ['login', 'signup', 'lang', 'forgot-password-kf']

router.beforeEach(async (to, from, next) => {
	const { path: fromPath } = from;
	const { path: toPath } = to;
	if (pulicRouterList.includes(to.name)) {
		next();
	} else {
		const userStore = useUserStore()
		//console.log('isAuthenticated',userStore.isAuthenticated);
		// 如果未登录
		if (!userStore.isAuthenticated) {
			userStore.logout()
			next({name: 'login' })
		}else{
			next()
		}
	}
})
export default router