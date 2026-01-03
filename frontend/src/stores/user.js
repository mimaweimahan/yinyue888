import { defineStore } from 'pinia'
import avatarImg from '@/assets/ico_avatar.png'
export const useUserStore = defineStore('user', {
  state: () => ({
	token:'',
	isLogin: false,
    userInfo: {
		uid: 0,
		email: 'of****ce@gmail.com',//Guest
		avatar: avatarImg,
		invite: '00000'
    }
  }),
  
  getters: {
    isAuthenticated() {
      return this.isLogin
    }
  },
  
  actions: {
    login(userData,token) {
      this.userInfo = userData;
	  this.token = token;
	  this.isLogin = true;
    },
	updateUserInfo(userData) {
	  this.userInfo = userData;
	  this.isLogin = true;
	},
    logout() {
      this.userInfo = {
        name: 'Guest',
        avatar: '',
        invite: '',
		uid: 0
      }
	   this.token = '';
	   this.isLogin = false;
    },
    updateToken(str){
		this.token = str?str:''
	}
  },
  
  // 持久化用户信息
  persist: {
    key: 'user_data',
    storage: localStorage,
    paths: ['userInfo', 'token']
  }
})