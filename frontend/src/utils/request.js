import axios from 'axios'
import { useUserStore } from '@/stores/user'
import { useSettingsStore } from '@/stores/settings'
import Vrouter from "@/router"
import config from '@/config'
import Cache from './cache'

// axios.defaults.baseURL = config.baseURL
axios.defaults.timeout = config.requestTimeout
// 携带 cookie，对目前的项目没有什么作用，因为我们是 token 鉴权
//axios.defaults.withCredentials = true

// 请求头，headers 信息

// 使用 application/json 形式
//axios.defaults.headers.post['Content-Type'] = 'application/json'
//请求拦截器
axios.interceptors.response.use(res => {
	if (res.data.status == 410000 || res.data.status == 410001 || res.data.status == 410002) {
	   const router = Vrouter;
	   router.push('/login');
	}
	if (res.data.code == 410000 || res.data.code == 410001 || res.data.code == 410002) {
	  const router = Vrouter;
	  router.push('/login');
	}
    if (res.status !== 200) {
        return Promise.reject(res.data)
    }
    return res;
})

function baseRequest(method, url, data, { auth = false }) {
	//判断登陆
    if (auth === true && store.uid < 1) {
		return new Promise((reslove, reject) => {
			const router = Vrouter;
			router.push('/login');
		    reject({msg:''});
		});
    }else{
		return new Promise((reslove, reject) => {
		    axios.defaults.headers['Authorization'] = useUserStore()?.token || null; // 添加token数据
		    axios.defaults.headers['lang'] = useSettingsStore()?.locale || 'en'; 
		    axios.defaults.headers['uid'] = useUserStore()?.userInfo?.uid || 0; 
		    axios({
		        url: url, method: method || 'get', data: data, params: method == 'get' ? data : {}
		    }).then(res => {
				if(res.data.code==1){
					reslove(res.data, res);
				}else{
					reject(res.data);
				}
		    }).catch(e => {
		        reject(e);
		    })
		});
	}
}
const doRequest = {};
['options', 'get', 'post', 'put', 'head', 'delete', 'trace', 'connect'].forEach((method) => {
    doRequest[method] = (api, data, opt) => baseRequest(method, config.baseURL + api, data, opt || true)
});
export { doRequest };