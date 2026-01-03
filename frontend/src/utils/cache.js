const Cache = {}

Cache.get = (key)=>{
	const value = window.localStorage.getItem(key)
	try {
		return JSON.parse(localStorage.getItem(key))
	} catch (error) {
		return value
	}
}

Cache.set = (key, data)=>{
	if (typeof data === 'object') data = JSON.stringify(data)
	try {
		return localStorage.setItem(key, data);
	} catch (e) {
		console.log(e);
		return false;
	}
}

Cache.remove = (key='')=>{
	if(key){
		return localStorage.removeItem(key)
	}else{
		return false
	}
}

Cache.clear = ()=>{
	return localStorage.clear()
} 
export default Cache