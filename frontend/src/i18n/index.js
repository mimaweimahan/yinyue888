import { createI18n } from 'vue-i18n'
import { useSettingsStore } from '@/stores/settings'

// 导入语言包
import en from './locales/en.json'
import al from './locales/al.json'
import de from './locales/de.json'
import es from './locales/es.json'
import ey from './locales/ey.json'
import fy from './locales/fy.json'
import han from './locales/han.json'
import it from './locales/it.json'
import ja from './locales/ja.json'
import pu from './locales/pu.json'
import tai from './locales/tai.json'
import tu from './locales/tu.json'
import yn from './locales/yn.json'
import zh from './locales/zh.json'

// 初始化时获取存储的语言设置
const getStoredLocale = () => {
  // 在客户端环境下获取存储的语言
  if (typeof window !== 'undefined') {
    try {
      return localStorage.getItem('settings') 
        ? JSON.parse(localStorage.getItem('settings')).locale 
        : 'en'
    } catch (e) {
      console.error('Failed to parse stored locale', e)
      return 'en'
    }
  }
  return 'en'
}

// 创建i18n实例
export const i18n = createI18n({
  legacy: false, // 使用Composition API模式
  globalInjection: true, // 全局注入$t函数
  locale: getStoredLocale(), // 默认语言
  fallbackLocale: 'en', //  fallback语言
  messages: {
    'en': en,
    'al': al,
    'de': de,
    'es': es,
    'ey': ey,
    'fy': fy,
    'han': han,
    'it': it,
    'ja': ja,
    'pu': pu,
    'tai': tai,
    'tu': tu,
    'yn': yn,
    'zh': zh
  }
})

// 语言切换函数
export const setLocale = (locale) => {
  i18n.global.locale.value = locale
  // 更新store中的语言设置
  const settingsStore = useSettingsStore()
  settingsStore.setLocale(locale)
}

// 语言列表
export const getLangList =()=>{
	return [{
		name: "English",
		lang: "en",
		code: "英语",
		enable: true //取用
	}, {
		name: "عربي",
		lang: "al",
		code: "阿拉伯语",
		enable: true
	}, {
		name: "Русский",
		lang: "ey",
		code: "俄语",
		enable: true
	}, {
		name: "español",
		lang: "es",
		code: "西班牙语",
		enable: true
	}, {
		name: "Français",
		lang: "fy",
		code: "法语",
		enable: true
	}, {
		name: "Deutsch",
		lang: "de",
		code: "德语",
		enable: true
	}, {
		name: "Português",
		lang: "pu",
		code: "葡萄牙语",
		enable: true
	}, {
		name: "Italiano",
		lang: "it",
		code: "意大利语",
		enable: true
	}, {
		name: "한국인",
		lang: "han",
		code: "韩语",
		enable: true
	}, {
		name: "แบบไทย",
		lang: "tai",
		code: "泰语",
		enable: true
	}, {
		name: "Türkçe",
		lang: "tu",
		code: "土耳其语",
		enable: true
	}, {
		name: "日本語",
		lang: "ja",
		code: "日本语",
		enable: true
	}, {
		name: "Indonesia",
		lang: "yn",
		code: "印尼语",
		enable: true
	}, {
		name: "中文",//Chinese
		lang: "zh",
		code: "中文",
		enable: true
	}]
}