export default  {
	baseURL: import.meta.env.VITE_API_URL || '/api',
	basePath: import.meta.env.VITE_PUBLIC_PATH || '/h5/', //站点目录 默认为/h5/
	baseWsUrl: import.meta.env.VITE_WEBSCOKET_URL || '/ws/', //站点目录 默认为/
    requestTimeout: 30000,
	cacheExpire: 24*60*60,//缓存过期时间
}
