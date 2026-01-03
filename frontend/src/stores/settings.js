import { defineStore } from 'pinia'
import { i18n } from '@/i18n'

export const useSettingsStore = defineStore('settings', {
  // 状态定义
  state: () => ({
    // 语言设置
    locale: 'en',
	// 语言名称
    langName: 'English',
    // 主题设置
    theme: 'light',
    // 字体大小
    fontSize: 16,
    // 侧边栏状态
    sidebarCollapsed: false
  }),
  
  // 计算属性
  getters: {
    // 获取当前主题的文本描述
    themeText() {
      return this.theme === 'light'
    },
    
    // 获取侧边栏状态的文本描述
    sidebarStatusText() {
      return this.sidebarCollapsed
    }
  },
  
  // 方法
  actions: {
    // 设置语言
    setLocale(locale,langName) {
      this.locale = locale
      this.langName = langName
      i18n.global.locale.value = locale
	  //this.theme = 'light'
    },
    
    // 切换主题
    toggleTheme() {
      this.theme = this.theme === 'light' ? 'dark' : 'light'
      this.applyTheme()
    },
    
    // 应用主题到页面
    applyTheme() {
      document.documentElement.setAttribute('data-theme', this.theme)
    },
    
    // 调整字体大小
    setFontSize(size) {
      this.fontSize = size
      document.documentElement.style.fontSize = `${size}px`
    },
    
    // 切换侧边栏状态
    toggleSidebar() {
      this.sidebarCollapsed = !this.sidebarCollapsed
    },
    
    // 重置设置到默认值
    resetSettings() {
      this.locale = 'en'
      this.theme = 'light'
      this.fontSize = 16
      this.sidebarCollapsed = false
      // 应用更改
      i18n.global.locale.value = this.locale
      this.applyTheme()
      document.documentElement.style.fontSize = `${this.fontSize}px`
    }
  },
  
  // 持久化配置
  persist: {
    // 存储的键名
    key: 'settings',
    // 存储方式：localStorage、sessionStorage 或自定义存储
    storage: localStorage,
    // 需要持久化的字段，默认所有状态都会被持久化
    paths: ['locale', 'theme', 'fontSize', 'sidebarCollapsed'],
    // 自定义序列化方法
    serializer: {
      serialize: (value) => JSON.stringify(value),
      deserialize: (value) => JSON.parse(value)
    }
  }
})