import './assets/main.css'
// 注意：使用按需引入后，不需要全量引入 Vant 样式
// import 'vant/lib/index.css' // 已通过 unplugin-vue-components 自动处理
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { i18n } from './i18n'
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'
import App from './App.vue'
import router from './router'
// 移除全量引入，改为按需引入（通过 unplugin-vue-components 自动处理）
// import vant from "vant"

// 抑制浏览器扩展相关的错误（可选）
if (typeof window !== 'undefined') {
  // 抑制 Chrome 扩展的 message port 错误
  const originalError = window.console.error
  window.console.error = (...args) => {
    const message = args.join(' ')
    // 过滤掉扩展相关的错误
    if (
      message.includes('runtime.lastError') ||
      message.includes('message port closed') ||
      message.includes('The message port closed before a response was received') ||
      message.includes('tabReply') ||
      message.includes('Extension context invalidated')
    ) {
      return // 忽略这些错误
    }
    originalError.apply(console, args)
  }
  
  // 捕获全局未处理的错误
  window.addEventListener('error', (event) => {
    const errorMessage = event.message || event.error?.message || ''
    if (
      errorMessage.includes('runtime.lastError') ||
      errorMessage.includes('message port closed') ||
      errorMessage.includes('The message port closed before a response was received') ||
      errorMessage.includes('Extension context invalidated')
    ) {
      // 阻止默认错误处理
      event.preventDefault()
      return false
    }
  }, true)
  
  // 捕获未处理的 Promise rejection
  window.addEventListener('unhandledrejection', (event) => {
    const errorMessage = event.reason?.message || event.reason?.toString() || ''
    if (
      errorMessage.includes('runtime.lastError') ||
      errorMessage.includes('message port closed') ||
      errorMessage.includes('The message port closed before a response was received') ||
      errorMessage.includes('Extension context invalidated')
    ) {
      // 阻止默认错误处理
      event.preventDefault()
      return false
    }
  })
}

const app = createApp(App)
// 创建 Pinia 实例
const pinia = createPinia()
// 使用持久化插件
pinia.use(piniaPluginPersistedstate)
app.use(pinia)
app.use(i18n)
app.use(router)
// 移除全量引入 Vant
// app.use(vant)
app.mount('#app')
