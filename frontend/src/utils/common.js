// 处理错误信息
import { showSuccessToast,showFailToast } from 'vant';
import { getCurrentInstance } from "vue";

import { i18n } from "@/i18n";

/**
 * 格式化金额，保留两位小数
 * 统一格式化函数，避免代码重复
 */
export const formatAmount = (val) => {
  if (val === undefined || val === null || val === '') return '0.00'
  const num = parseFloat(val)
  if (Number.isNaN(num)) return '0.00'
  return num.toFixed(2)
}

export const timestampToTime = (timestamp) => {
    var date = new Date(timestamp * 1000);//时间戳为10位需*1000，时间戳为13位的话不需乘1000
    var Y = date.getFullYear() + '-';
    var M = (date.getMonth() + 1 < 10 ? '0' + (date.getMonth() + 1) : date.getMonth() + 1) + '-';
    var D = date.getDate() < 10 ? '0' + date.getDate() + ' ' : date.getDate() + ' ';
    var h = date.getHours() < 10 ? '0' + date.getHours() + ':' : date.getHours() + ':';
    var m = date.getMinutes() < 10 ? '0' + date.getMinutes(): date.getMinutes();
    // var s = date.getSeconds() < 10 ? '0' + date.getSeconds() : date.getSeconds();
    return Y + M + D + h + m;
}
export const globalProperties = () => {
    const internalInstance = getCurrentInstance();
    return internalInstance?.appContext?.config?.globalProperties;
};

// 动态加载图片内容（用于静态资源）
export let  getImageUrl= (url) => new URL(url, import.meta.url).href;

/**
 * 处理后端返回的图片URL
 * 如果已经是完整URL则直接返回，如果是绝对路径（以/开头）则直接返回（浏览器会自动基于当前域名解析）
 * @param {string} url - 图片URL（可能是相对路径、绝对路径或完整URL）
 * @returns {string} - 处理后的URL
 */
export const getGoodsImageUrl = (url) => {
  if (!url || typeof url !== 'string') {
    return ''
  }
  
  // 如果已经是完整URL（http:// 或 https://），直接返回
  if (url.startsWith('http://') || url.startsWith('https://')) {
    return url
  }
  
  // 如果是以 / 开头的绝对路径（如 /upload/xxx.jpg），直接返回
  // 浏览器会自动基于当前域名解析（如 https://example.com/upload/xxx.jpg）
  if (url.startsWith('/')) {
    return url
  }
  
  // 如果是相对路径（不以/开头），拼接 / 使其成为绝对路径
  return '/' + url
}

//验证邮箱格式
export const validateEmail = (value,) => {
    const {t} = i18n.global; // 使用国际化配置语言
    const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (!value) {
        // return Promise.reject(t('请输入邮箱'));
        showFailToast(t('请输入邮箱'))
        return false;
    } else if (!re.test(value)) {
        showFailToast(t('输入正确的邮箱格式'))
        return false;
    } else {
        return true;
    }
}

export const copyValue =(value)=> { 
    const {t} = i18n.global; //使用国际化配置语言
	if(!value){
		return false;
	}
    navigator.clipboard.writeText(value).then(() => {
        showSuccessToast( t('common.copy_success') );
    }).catch(() => {
        showFailToast( t('common.copy_fail') );
    })
}

/**
 * 安全地打开外部链接（符合 Chrome 安全机制）
 * @param {string} url - 要打开的 URL
 * @param {string} target - 打开方式，默认为 '_blank'
 */
export const safeOpenUrl = (url, target = '_blank') => {
  if (!url || typeof url !== 'string') {
    console.warn('无效的 URL:', url)
    return
  }

  try {
    // 创建临时 <a> 标签，使用 rel="noopener noreferrer" 增强安全性
    // 这种方式符合 Chrome 安全机制，避免被标记为不安全
    const link = document.createElement('a')
    link.href = url
    link.target = target
    link.rel = 'noopener noreferrer' // 防止新页面访问原始页面，增强安全性
    link.style.display = 'none'
    document.body.appendChild(link)
    link.click()
    // 立即移除 DOM 元素
    setTimeout(() => {
      if (document.body.contains(link)) {
        document.body.removeChild(link)
      }
    }, 0)
  } catch (e) {
    console.error('打开链接失败:', e)
    // 降级方案：使用 window.open，但现代浏览器已默认处理 opener 安全
    // 注意：window.open 不支持 rel 参数，但现代浏览器（Chrome 88+）已默认设置 noopener
    // 为了最大兼容性，仍然使用 <a> 标签方式作为主要方案
    try {
      const newWindow = window.open(url, target)
      // 如果新窗口打开成功，确保 opener 被正确设置
      if (newWindow) {
        newWindow.opener = null
      }
    } catch (fallbackError) {
      console.error('降级方案也失败:', fallbackError)
    }
  }
}

/**
 * 验证客服链接 URL 的安全性
 * @param {string} url - 要验证的 URL
 * @param {string[]} allowedDomains - 允许的域名白名单（可选）
 * @returns {string|null} - 验证通过的 URL，失败返回 null
 */
export const validateKfUrl = (url, allowedDomains = []) => {
  if (!url || typeof url !== 'string') {
    return null
  }

  try {
    // 解析 URL（如果是相对路径，会基于当前域名解析）
    const urlObj = new URL(url, window.location.origin)
    
    // 只允许 http/https 协议
    if (!['http:', 'https:'].includes(urlObj.protocol)) {
      console.warn('客服链接协议不允许:', urlObj.protocol)
      return null
    }
    
    const hostname = urlObj.hostname.toLowerCase()
    const currentHostname = window.location.hostname.toLowerCase()
    
    // 同域链接，直接允许
    if (hostname === currentHostname) {
      return urlObj.href
    }
    
    // 外部域名处理
    // 如果传入了白名单，则检查白名单
    if (allowedDomains.length > 0) {
      const allAllowedDomains = [currentHostname, ...allowedDomains].map(d => d.toLowerCase())
      const isAllowed = allAllowedDomains.some(domain => {
        return hostname === domain || hostname.endsWith('.' + domain)
      })
      
      if (!isAllowed) {
        console.warn('客服链接域名不在白名单中:', hostname, '允许的域名:', allAllowedDomains)
        return null
      }
    } else {
      // 如果未配置白名单，允许所有 HTTPS 的外部域名（客服域名是安全的）
      // 外部域名必须使用 HTTPS
      if (urlObj.protocol !== 'https:') {
        console.warn('外部客服链接必须使用 HTTPS:', url)
        return null
      }
    }
    
    return urlObj.href
  } catch (e) {
    console.error('客服链接格式错误:', url, e)
    return null
  }
}
