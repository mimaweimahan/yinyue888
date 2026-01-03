<template>
  <div class="lang-page">
    <div class="lang-bg"></div>
    <div class="lang-mask"></div>

    <div class="lang-container">
      <button class="lang-back" @click="goBack">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M15 19L8 12L15 5" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>

      <header class="lang-header">{{ t('login.lang') || 'Language' }}</header>

      <div class="grid">
        <button
          class="lang-card"
          v-for="item in langs"
          :key="item.code"
          @click="changeLang(item.code)"
        >
          <img class="lang-flag" :src="item.icon" :alt="item.name" />
          <div class="lang-info">
            <span class="name">{{ item.name }}</span>
            <span class="code">{{ item.code.toUpperCase() }}</span>
          </div>
          <span class="lang-arrow">></span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { i18n, setLocale } from '@/i18n'

const { t } = i18n.global
const router = useRouter()

// 映射到现有的 i18n 语言代码，未匹配的回退 en
const codeMap = {
  'zh-cn': 'zh',
  'en-ww': 'en',
  'en-au': 'en',
  'en-id': 'en',
  'en-els': 'en',
  'jp': 'ja',
  'ko': 'han',
  'iv-vn': 'en',   // 无对应语言，回退英文
  'pt-br': 'pu',
  'es-mx': 'es',
  'tr-tr': 'tu',
  'ar-sa': 'al'
}

const langs = [
  { code: 'zh-cn', name: '中文简体', icon: '/images/lang/zh.png' },
  { code: 'en-ww', name: 'English', icon: '/images/lang/en.png' },
  { code: 'en-au', name: 'Australia', icon: '/images/lang/adly.png' },
  { code: 'en-id', name: 'Indonesia', icon: '/images/lang/ydnx.png' },
  { code: 'en-els', name: 'Europe', icon: '/images/lang/oz.png' },
  { code: 'jp', name: '日本語', icon: '/images/lang/rb.png' },
  { code: 'ko', name: '한국어', icon: '/images/lang/hg.png' },
  { code: 'iv-vn', name: 'Tiếng Việt', icon: '/images/lang/yn.png' },
  { code: 'pt-br', name: 'Português', icon: '/images/lang/pty.png' },
  { code: 'es-mx', name: 'Español', icon: '/images/lang/xby.png' },
  { code: 'tr-tr', name: 'Türkçe', icon: '/images/lang/trq.png' },
  { code: 'ar-sa', name: 'العربية', icon: '/images/lang/alb.png' },
]

const changeLang = (code) => {
  const target = codeMap[code] || 'en'
  setLocale(target)
  const canBack = window.history.length > 1
  if (canBack) {
    window.history.back()
  } else {
    router.push('/login')
  }
}

const goBack = () => {
  const canBack = window.history.length > 1
  if (canBack) {
    window.history.back()
  } else {
    router.push('/login')
  }
}
</script>

<style scoped lang="scss">
.lang-page {
  position: relative;
  min-height: 100dvh;
  background: #000;
  color: #fff;
  font-family: 'Montserrat', 'Arial', 'Helvetica Neue', Helvetica, sans-serif;
  overflow: hidden;
  overflow-x: hidden;
}

.lang-bg {
  position: fixed;
  inset: 0;
  background: url('/images/bg-page.png') center/cover no-repeat;
  filter: blur(14px);
  opacity: 0.7;
  z-index: 0;
}

.lang-mask {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.8);
  z-index: 1;
}

.lang-container {
  position: relative;
  z-index: 2;
  max-width: 520px;
  margin: 0 auto;
  padding: 18px 16px 50px;
  padding-top: max(18px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(50px + env(safe-area-inset-bottom, 0px));
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
  overflow-x: hidden;
}

.lang-header {
  color: #fff;
  font-size: 22px;
  font-weight: 800;
  text-align: center;
  padding: 22px 0 14px;
  letter-spacing: 1px;
  position: relative;
}

.lang-back {
  position: absolute;
  top: 18px;
  left: 18px;
  z-index: 3;
  width: 32px;
  height: 32px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(255, 255, 255, 0.10);
  border-radius: 16px;
  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.10);
  border: none;
  cursor: pointer;
  transition: background 0.2s;
}

.lang-back:hover {
  background: rgba(255, 255, 255, 0.22);
}

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 12px;
}
.lang-card {
  width: 100%;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,0.14);
  background: linear-gradient(150deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  box-shadow: 0 10px 24px rgba(0,0,0,0.26);
  padding: 14px 14px;
  display: flex;
  align-items: center;
  gap: 12px;
  color: #fff;
  font-size: 16px;
  cursor: pointer;
  transition: all 0.18s ease;
}
.lang-card:hover {
  border-color: #1ed760;
  box-shadow: 0 0 16px rgba(30,215,96,0.28);
}

.lang-flag {
  width: 36px;
  height: 36px;
  border-radius: 12px;
  box-shadow: 0 1px 4px rgba(0, 0, 0, 0.12);
  object-fit: cover;
}
.lang-info {
  display: flex;
  flex-direction: column;
  gap: 2px;
}
.lang-info .name {
  font-weight: 700;
  font-size: 16px;
}
.lang-info .code {
  font-size: 12px;
  color: rgba(255,255,255,0.7);
}

.lang-arrow {
  margin-left: auto;
  color: #fff;
  font-size: 20px;
}

@media (max-width: 600px) {
  .lang-container {
    width: 100%;
    padding: 16px 12px 50px;
  }
  .grid { gap: 10px; }
  .lang-card { padding: 12px 12px; }
  .lang-flag { width: 32px; height: 32px; }
}
</style>

