<template>
  <div class="home-wrapper">
    <div class="bg-blur"></div>
    <div class="bg-mask"></div>
    <div class="home-main">
      <div
        class="notice-bar"
        @click="goToNoticeList"
      >
        <van-icon name="volume-o" class="notice-icon" />
        <div class="notice-text-wrapper">
          <div class="notice-text" v-if="latestNoticeTitle">
            {{ latestNoticeTitle }}
      </div>
        </div>
      </div>

      <div class="welcome-card">
        <div class="left">
          <div class="hello">{{ t('home.hello') || '你好！欢迎' }}</div>
          <div class="uid">
            {{ displayAccount }}
            <img class="medal" src="/images/home/7e4248291fb40d38f314127dfa1914ba.png" alt="medal" />
        </div>
        </div>
        <div class="right">
          <div class="credit">{{ t('home.credit') || '信用评分' }}: {{ userInfo.credit_score || 100 }}</div>
        </div>
      </div>

      <div class="quick-nav">
        <div class="nav-grid">
          <div
            class="nav-item"
            :class="{ disabled: item.disabled }"
            v-for="item in navList"
            :key="item.label"
            @click="handleNav(item)"
          >
            <div class="nav-icon">
              <img :src="item.icon" :alt="item.label" />
            </div>
            <div class="nav-label">{{ item.label }}</div>
            <span class="nav-press" aria-hidden="true"></span>
          </div>
        </div>
      </div>

      <!-- 播放器和滚动区容器 - 取消间距 -->
      <div class="player-dynamics-wrapper">
        <div class="player-frame">
          <iframe
            class="player-iframe"
            :src="playerUrl"
            frameborder="0"
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
            referrerpolicy="strict-origin-when-cross-origin"
            title="Spotify 播放器"
          ></iframe>
        </div>

        <div class="dynamics-card">
          <div class="ticker-track" v-if="tickerListLimited.length">
            <div class="ticker-scroll">
              <div class="tick" v-for="(tick, idx) in tickerListLimited" :key="`a-${idx}`" :style="{ color: tick.color }">
                {{ tick.text }}
              </div>
              <div class="tick" v-for="(tick, idx) in tickerListLimited" :key="`b-${idx}`" :style="{ color: tick.color }">
                {{ tick.text }}
              </div>
            </div>
          </div>
        </div>
      </div>

      <FooterTabbar active="home" />
    </div>

    <!-- 证书图片弹窗 -->
    <van-popup
      :show="showCertificatePopup"
      @update:show="showCertificatePopup = $event"
      :close-on-click-overlay="true"
      :close-on-popstate="false"
      lock-scroll
      class="certificate-popup"
    >
      <div class="certificate-popup-main">
        <div class="certificate-header">
          <div class="certificate-title">{{ t('home.certificate') || '证书' }}</div>
          <van-icon name="cross" class="close-icon" @click="showCertificatePopup = false" />
        </div>
        <div class="certificate-content">
          <van-image
            :src="'/images/zhengshu.jpg'"
            fit="contain"
            class="certificate-image"
            :show-loading="true"
            :show-error="true"
            loading-icon="photo"
            error-icon="photo-fail"
          />
        </div>
      </div>
    </van-popup>

    <!-- 条款弹窗 -->
    <van-popup
      :show="showClausePopup"
      @update:show="showClausePopup = $event"
      :close-on-click-overlay="true"
      :close-on-popstate="false"
      lock-scroll
      class="clause-popup"
      @close="closeClausePopup"
    >
      <div class="clause-popup-main">
        <div class="clause-header">
          <div class="clause-title">{{ t('home.renew') || '条款' }}</div>
          <van-icon name="cross" class="close-icon" @click="closeClausePopup" />
        </div>
        <div class="clause-content">
          <div v-if="clauseLoading" class="clause-loading">
            <van-loading size="28" color="#1ed760" />
          </div>
          <div v-else-if="clauseContent" class="clause-text-content">
            <div
              v-for="(paragraph, index) in formattedClauseContent"
              :key="index"
              class="clause-paragraph"
              :data-long="paragraph.length > 200"
            >
              {{ paragraph }}
            </div>
          </div>
          <div v-else class="clause-empty">
            {{ t('common.nodata') || '暂无数据' }}
          </div>
        </div>
      </div>
    </van-popup>

    <!-- 事件弹窗 -->
    <van-popup
      :show="showEventPopup"
      @update:show="showEventPopup = $event"
      :close-on-click-overlay="true"
      :close-on-popstate="false"
      lock-scroll
      class="event-popup"
      @close="closeEventPopup"
    >
      <div class="event-popup-main">
        <div class="event-header">
          <div class="event-title">{{ t('home.event') || '事件' }}</div>
          <van-icon name="cross" class="close-icon" @click="closeEventPopup" />
        </div>
        <div class="event-content">
          <div v-if="eventLoading" class="event-loading">
            <van-loading size="28" color="#333" />
          </div>
          <div v-else-if="eventContent" class="event-text-content">
            <div
              v-for="(paragraph, index) in formattedEventContent"
              :key="index"
              class="event-paragraph"
              :data-long="paragraph.length > 200"
            >
              {{ paragraph }}
            </div>
          </div>
          <div v-else class="event-empty">
            {{ t('common.nodata') || '暂无数据' }}
          </div>
        </div>
      </div>
    </van-popup>

    <!-- 关于我们弹窗 -->
    <van-popup
      :show="showAboutPopup"
      @update:show="showAboutPopup = $event"
      :close-on-click-overlay="true"
      :close-on-popstate="false"
      lock-scroll
      class="about-popup"
      @close="closeAboutPopup"
    >
      <div class="about-popup-main">
        <div class="about-header">
          <div class="about-title">{{ t('home.about') || '关于' }}</div>
          <van-icon name="cross" class="close-icon" @click="closeAboutPopup" />
        </div>
        <div class="about-content">
          <div v-if="aboutLoading" class="about-loading">
            <van-loading size="28" color="#333" />
          </div>
          <div v-else-if="aboutContent" class="about-text-content">
            <div
              v-for="(paragraph, index) in formattedAboutContent"
              :key="index"
              class="about-paragraph"
              :data-long="paragraph.length > 200"
            >
              {{ paragraph }}
            </div>
          </div>
          <div v-else class="about-empty">
            {{ t('common.nodata') || '暂无数据' }}
          </div>
        </div>
      </div>
    </van-popup>
  </div>
</template>

<script setup>
import { computed, ref, onMounted, defineOptions } from 'vue'
import { useRouter } from 'vue-router'
import { i18n } from '@/i18n'
import { useUserStore } from '@/stores/user'
import { tradingDynamicsApi, homeNoticeApi, appDownloadApi, clauseDetailApi, eventDetailApi, aboutDetailApi } from '@/api/public'
import { showFailToast } from 'vant'
import { safeOpenUrl } from '@/utils/common'
import FooterTabbar from '@/components/FooterTabbar.vue'

defineOptions({ name: 'IndexPage' })
const { t } = i18n.global
const router = useRouter()
const userStore = useUserStore()

const userInfo = computed(() => userStore.userInfo || {})

// 显示账号信息：优先显示手机号，如果没有手机号则显示邮箱
const displayAccount = computed(() => {
  const info = userInfo.value
  // 优先检查手机号字段（可能的后端字段名：tel, phone, mobile, account等）
  const phone = info.tel || info.phone || info.mobile || (info.account && !info.account.includes('@') ? info.account : null)
  // 如果有手机号，优先显示手机号
  if (phone) {
    return phone
  }
  // 如果没有手机号，显示邮箱
  if (info.email) {
    return info.email
  }
  // 最后显示用户名或其他
  return info.username || info.account || '--'
})

const noticeData = ref(null)
const dynamics = ref([])
const noticeFallback = computed(() => t('home.hello') || '欢迎来到平台')
const showCertificatePopup = ref(false)
const showClausePopup = ref(false)
const clauseContent = ref('')
const clauseLoading = ref(false)
const showEventPopup = ref(false)
const eventContent = ref('')
const eventLoading = ref(false)
const showAboutPopup = ref(false)
const aboutContent = ref('')
const aboutLoading = ref(false)

const navList = computed(() => ([
  { label: t('home.app') || 'APP下载', icon: '/images/home/download.png', action: 'appDownload' },
  { label: t('home.certificate') || '证书', icon: '/images/home/zhengshu.png', action: 'certificate' },
  { label: t('mine.withdraw') || '提现', icon: '/images/home/tixian.png', url: '/withdraw' },
  { label: t('mine.customer_service') || '客服接口', icon: '/images/home/kehufuwu.png', action: 'kf' },
  { label: t('home.renew') || '条款', icon: '/images/home/tiaokuan.png', action: 'clause' },
  { label: t('home.event') || '事件', icon: '/images/home/huodong.png', action: 'event' },
  { label: t('mine.recharge') || '充值', icon: '/images/home/faq.png', url: '/recharge' },
  { label: t('home.about') || '关于', icon: '/images/home/gywm.png', action: 'about' },
]))

// 播放器地址：切换为 Spotify 官方 Embed（公开歌单示例，暗色主题）
const playerUrl = computed(
  () => 'https://open.spotify.com/embed/playlist/37i9dQZF1DXcBWIGoYBM5M?utm_source=generator&theme=0'
)

// 只获取最近的一条公告标题
const latestNoticeTitle = computed(() => {
  const n = noticeData.value
  if (Array.isArray(n) && n.length > 0) {
    // 取第一条（最近的一条）
    return n[0]?.title || ''
  } else if (n && typeof n === 'object') {
    return n.title || ''
  } else if (typeof n === 'string' && n.trim()) {
    return n.trim()
  }
  return noticeFallback.value
})

const randomEmail = () => {
  const chars = 'abcdefghijklmnopqrstuvwxyz'
  const len = Math.floor(Math.random() * 5) + 6 // 6-10 chars
  let name = ''
  for (let i = 0; i < len; i++) {
    name += chars.charAt(Math.floor(Math.random() * chars.length))
  }
  const domains = ['gmail.com', 'outlook.com', 'yahoo.com', 'qq.com', 'icloud.com']
  const domain = domains[Math.floor(Math.random() * domains.length)]
  return `${name}${Math.floor(Math.random() * 90 + 10)}@${domain}`
}
const maskEmail = (email) => {
  if (!email || !email.includes('@')) return email || 'user@example.com'
  const [name, domain] = email.split('@')
  if (name.length <= 2) return `${name[0] || ''}***@${domain}`
  return `${name.slice(0, 2)}***@${domain}`
}

const tickerList = computed(() => {
  try {
    const list = Array.isArray(dynamics.value) ? dynamics.value : []
    const buildEntry = (item) => {
      try {
        const rawUser = item?.uid || item?.user || item?.account || randomEmail()
        const email = typeof rawUser === 'string' && rawUser.includes('@') ? rawUser : randomEmail()
        const masked = maskEmail(email)
        const amount = Math.floor(Math.random() * (5000 - 30 + 1)) + 30
        const isHot = amount >= 1000
        const msg = isHot ? `🔥 HOT Commission +$${amount}` : `Commission +$${amount}`
        const color =
          isHot
            ? '#ff6b6b' // 爆款提示色
            : amount >= 200
              ? '#1ed760' // 正常高亮
              : '#d7f0ff' // 默认
        return { text: `${masked} ${msg}`, color, isHot }
      } catch (e) {
        console.error('构建动态条目失败：', e)
        return { text: 'Commission +$100', color: '#d7f0ff', isHot: false }
      }
    }
    const base = list.length ? list.map(buildEntry) : Array.from({ length: 8 }).map(() => buildEntry({}))

    // 随机 5-10 条之间插入 1 条爆款提示
    if (base.length > 0) {
      const hotIndex = Math.min(Math.floor(Math.random() * 6) + 5, base.length)
      const hotAmount = Math.floor(Math.random() * (5000 - 1000 + 1)) + 1000
      const hotItem = {
        text: `🔥 HOT Commission +$${hotAmount}`,
        color: '#ff6b6b',
        isHot: true
      }
      base.splice(hotIndex, 0, hotItem)
    }

    return base
  } catch (e) {
    console.error('计算动态列表失败：', e)
    return []
  }
})
const tickerListLimited = computed(() => tickerList.value.slice(0, 40))

const fetchNotice = async () => {
  try {
    // 首页顶部只使用全局公告API
    const res = await homeNoticeApi({ limit: 5 })
    if (res?.code === 1 && Array.isArray(res?.data)) {
      noticeData.value = res.data
    } else {
      noticeData.value = null
    }
  } catch (e) {
    console.error('获取首页公告失败：', e)
    noticeData.value = null
  }
}

const fetchDynamics = async () => {
  try {
    const res = await tradingDynamicsApi()
    // 确保返回的数据是数组
    if (Array.isArray(res?.data)) {
      dynamics.value = res.data
    } else {
      dynamics.value = []
    }
  } catch (e) {
    console.error('获取交易动态失败：', e)
    dynamics.value = []
  }
}

const goToNoticeList = () => {
  router.push('/notice-list')
}

// 加载条款内容（id=1）
const loadClauseContent = async () => {
  clauseLoading.value = true
  clauseContent.value = ''
  try {
    const res = await clauseDetailApi({ id: 1 })
    if (res?.code === 1 && res?.data?.content) {
      clauseContent.value = res.data.content
    } else {
      showFailToast(res?.msg || t('common.get_clause_content_failed') || '获取条款内容失败')
    }
  } catch (e) {
    showFailToast(e?.msg || t('common.get_clause_content_failed') || '获取条款内容失败')
  } finally {
    clauseLoading.value = false
  }
}

// 格式化条款内容为段落数组
const formattedClauseContent = computed(() => {
  if (!clauseContent.value) return []
  // 按换行符分割段落，过滤空行
  return clauseContent.value
    .split(/\n+/)
    .map(p => p.trim())
    .filter(p => p.length > 0)
})

// 关闭条款弹窗
const closeClausePopup = () => {
  showClausePopup.value = false
  clauseContent.value = ''
}

// 加载事件内容（id=1）
const loadEventContent = async () => {
  eventLoading.value = true
  eventContent.value = ''
  try {
    const res = await eventDetailApi({ id: 1 })
    if (res?.code === 1 && res?.data?.content) {
      eventContent.value = res.data.content
    } else {
      showFailToast(res?.msg || t('common.get_event_content_failed') || '获取事件内容失败')
    }
  } catch (e) {
    showFailToast(e?.msg || t('common.get_event_content_failed') || '获取事件内容失败')
  } finally {
    eventLoading.value = false
  }
}

// 格式化事件内容为段落数组
const formattedEventContent = computed(() => {
  if (!eventContent.value) return []
  // 按换行符分割段落，过滤空行
  return eventContent.value
    .split(/\n+/)
    .map(p => p.trim())
    .filter(p => p.length > 0)
})

// 关闭事件弹窗
const closeEventPopup = () => {
  showEventPopup.value = false
  eventContent.value = ''
}

// 加载关于我们内容（id=1）
const loadAboutContent = async () => {
  aboutLoading.value = true
  aboutContent.value = ''
  try {
    const res = await aboutDetailApi({ id: 1 })
    if (res?.code === 1 && res?.data?.content) {
      aboutContent.value = res.data.content
    } else {
      showFailToast(res?.msg || t('common.get_about_content_failed') || '获取关于我们内容失败')
    }
  } catch (e) {
    showFailToast(e?.msg || t('common.get_about_content_failed') || '获取关于我们内容失败')
  } finally {
    aboutLoading.value = false
  }
}

// 格式化关于我们内容为段落数组
const formattedAboutContent = computed(() => {
  if (!aboutContent.value) return []
  // 按换行符分割段落，过滤空行
  return aboutContent.value
    .split(/\n+/)
    .map(p => p.trim())
    .filter(p => p.length > 0)
})

// 关闭关于我们弹窗
const closeAboutPopup = () => {
  showAboutPopup.value = false
  aboutContent.value = ''
}

const handleNav = async (item) => {
  // 如果项被禁用，不执行任何操作
  if (item.disabled) {
    return
  }
  if (item.action === 'kf') {
    router.push('/customer-service')
    return
  }
  if (item.action === 'appDownload') {
    try {
      const res = await appDownloadApi({})
      if (res?.code === 1 && Array.isArray(res?.data) && res.data.length > 0) {
        // result.data 是数组: [{id: 1, url: "https://..."}]
        const downloadUrl = res.data[0]?.url
        if (downloadUrl) {
          // 安全地打开下载链接（符合 Chrome 安全机制）
          safeOpenUrl(downloadUrl)
        } else {
          showFailToast(t('common.download_link_invalid') || '下载链接无效')
        }
      } else {
        showFailToast(res?.msg || t('common.get_download_link_failed') || '获取下载链接失败')
      }
    } catch (e) {
      showFailToast(e?.msg || t('common.get_download_link_failed') || '获取下载链接失败')
    }
    return
  }
  if (item.action === 'certificate') {
    // 显示证书图片弹窗
    showCertificatePopup.value = true
    return
  }
  if (item.action === 'clause') {
    // 显示条款弹窗并加载条款内容（id=1）
    showClausePopup.value = true
    loadClauseContent()
    return
  }
  if (item.action === 'event') {
    // 显示事件弹窗并加载事件内容（id=1）
    showEventPopup.value = true
    loadEventContent()
    return
  }
  if (item.action === 'about') {
    // 显示关于我们弹窗并加载关于我们内容（id=1）
    showAboutPopup.value = true
    loadAboutContent()
    return
  }
  if (item.action === 'logout') {
    userStore.logout()
    router.push('/login')
    return
  }
  if (item.url) {
    router.push(item.url)
  }
}

onMounted(() => {
  fetchNotice()
  fetchDynamics()
})
</script>

<style scoped lang="scss">
.home-wrapper {
  position: relative;
  min-height: 100vh;
  min-height: 100dvh;
  background: #000;
  overflow: hidden;
  overflow-x: hidden;
}
.bg-blur {
  position: fixed;
  inset: 0;
  background: url('/images/home/bg-page.png') center/cover no-repeat;
  filter: blur(14px);
  opacity: 0.5;
  z-index: 0;
}
.bg-mask {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1;
  min-height: 100vh;
  min-height: 100dvh;
}
.home-main {
  position: relative;
  z-index: 2;
  max-width: 520px;
  width: 100%;
  margin: 0 auto;
  padding: 14px 12px;
  padding-bottom: calc(80px + env(safe-area-inset-bottom, 0px));
  padding-top: max(14px, env(safe-area-inset-top, 0px));
  color: #fff;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
  overflow-x: hidden;
  gap: 12px;
  background: transparent;
}
.notice-bar{
  margin: 0;
  padding: 0 12px;
  height: 36px;
  border-radius: 12px;
  overflow: hidden;
  background: rgba(0,0,0,0.25);
  border: 1px solid rgba(255,255,255,0.06);
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 8px;
  position: relative;
  
  &:hover {
    background: rgba(0,0,0,0.35);
    border-color: rgba(255,255,255,0.1);
  }
  
  &:active {
    transform: scale(0.98);
}
}

.notice-icon {
  flex-shrink: 0;
  font-size: 16px;
  color: #fff;
}

.notice-text-wrapper {
  flex: 1;
  overflow: hidden;
  position: relative;
  height: 100%;
  display: flex;
  align-items: center;
}

.notice-text {
  font-size: 14px;
  color: #fff;
  white-space: nowrap;
  padding-right: 50px;
  animation: scroll-text 15s linear infinite;
  display: inline-block;
}

@keyframes scroll-text {
  0% {
    transform: translateX(100%);
  }
  100% {
    transform: translateX(-100%);
  }
}
.top-bar {
  display: flex;
  justify-content: flex-end;
  margin-bottom: 12px;
}
.quick-nav {
  margin-top: 8px;
  width: 100%;
  box-sizing: border-box;
}
.nav-title {
  font-size: 16px;
  font-weight: 700;
  margin-bottom: 10px;
}
.nav-grid {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 12px;
  justify-items: center;
  width: 100%;
  box-sizing: border-box;
}
.nav-item {
  position: relative;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.08);
  border-radius: 16px;
  padding: 12px 10px;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 8px;
  text-align: center;
  transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.2s ease;
  min-height: 110px;
  justify-content: center;
  width: 100%;
  overflow: hidden;
}
.nav-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 24px rgba(0,0,0,0.2);
}
.nav-item:active {
  transform: translateY(1px) scale(0.98);
}
.nav-press {
  position: absolute;
  inset: 0;
  background: radial-gradient(circle, rgba(255,255,255,0.12), rgba(255,255,255,0));
  opacity: 0;
  transition: opacity 0.2s ease;
}
.nav-item:active .nav-press {
  opacity: 1;
}
.nav-item.disabled {
  cursor: not-allowed;
  pointer-events: none;
}
.nav-item.disabled:hover {
  transform: none;
  box-shadow: none;
}
.nav-item.disabled:active {
  transform: none;
}
.nav-item.disabled .nav-press {
  display: none;
}
.nav-icon {
  width: 64px;
  height: 64px;
}
.nav-icon img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
.nav-label {
  font-size: 13px;
  font-weight: 600;
  line-height: 1.2;
  max-width: 100%;
  white-space: normal;
  word-break: break-all;
}
/* 播放器和滚动区容器 - 取消间距 */
.player-dynamics-wrapper {
  display: flex;
  flex-direction: column;
  margin-top: -4px;
  gap: 0 !important;
}

.player-frame {
  flex-shrink: 0;
  margin-bottom: 0 !important;
  width: 100%;
  height: 158px !important;
  border-radius: 14px 14px 0 0;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,0.1);
  border-bottom: none !important;
  background: #000;
  position: relative;
}

.player-frame + .dynamics-card {
  margin-top: -2px !important;
  border-radius: 0 0 16px 16px;
  border-top: none !important;
}

.player-iframe {
  border: none;
  display: block;
  width: 100%;
  height: 180px !important;
  position: absolute;
  top: -2px;
  left: 0;
}
.player-card{
  margin: 12px 0 0;
  width: 100%;
  border-radius: 14px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,0.08);
  background: rgba(0,0,0,0.5);
  backdrop-filter: blur(8px);
  padding: 12px;
  box-sizing: border-box;
}
.player-cover{
  display: flex;
  align-items: center;
  gap: 12px;
}
.cover-img{
  width: 70px;
  height: 70px;
  border-radius: 12px;
  background: url('/images/home/bg-page.png') center/cover no-repeat;
  border: 1px solid rgba(255,255,255,0.08);
}
.cover-meta{
  display: flex;
  flex-direction: column;
  gap: 4px;
}
.cover-title{
  font-size: 16px;
  font-weight: 800;
  color: #fff;
}
.cover-sub{
  font-size: 12px;
  color: #cfd6ff;
}
.player-controls{
  margin: 12px 0;
  display: flex;
  justify-content: center;
  gap: 30px;
  color: #fff;
  font-size: 22px;
}
.player-controls .play-btn{
  font-size: 28px;
}
.player-list{
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.track{
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 8px 6px;
  background: rgba(255,255,255,0.05);
  border-radius: 10px;
}
.t-num{
  width: 24px;
  text-align: center;
  font-weight: 700;
  color: #ffdd55;
}
.t-main{
  flex: 1;
  overflow: hidden;
}
.t-title{
  font-size: 14px;
  font-weight: 700;
  color: #fff;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.t-sub{
  font-size: 12px;
  color: #cfd6ff;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.t-duration{
  font-size: 12px;
  color: #fff;
}

.welcome-card{
  flex-shrink: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 8px 6px;
  color: #fff;
  margin: 0;
}
.welcome-card .hello{
  font-size: 20px;
  font-weight: 800;
}
.welcome-card .uid{
  display: flex;
  align-items: center;
  gap: 8px;
  margin-top: 6px;
}
.welcome-card .medal{
  width: 22px;
  height: 22px;
}
.welcome-card .credit{
  font-size: 14px;
  font-weight: 700;
}

.ticker{
  margin-top: 16px;
  background: rgba(0,0,0,0.45);
  border-radius: 12px;
  padding: 8px 6px;
  border: 1px solid rgba(255,255,255,0.04);
  overflow: hidden;
}
.ticker-swiper{
  height: 60px;
}
.ticker-swiper .van-swipe-item{
  display: flex;
  align-items: center;
  padding: 0 6px;
}
.tick{
  color: #fff;
  font-size: 15px;
  font-weight: 800;
  line-height: 1.35;
}
.dynamics-card{
  flex-shrink: 0;
  margin: 0;
  margin-top: -2px !important;
  min-height: 200px;
  height: 200px;
  border-radius: 0 0 16px 16px;
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255,255,255,0.12);
  border-top: none !important;
  overflow: hidden;
  padding: 12px;
  box-shadow: 0 12px 28px rgba(0,0,0,0.28);
  backdrop-filter: blur(10px);
}
.ticker-track{
  height: 200px;
  overflow: hidden;
  position: relative;
}
.ticker-scroll{
  display: flex;
    flex-direction: column;
    gap: 12px;
  animation: ticker-move 40s linear infinite;
  align-items: center;
}
.tick{
  color: #e8f4ff;
  font-size: 17px;
  font-weight: 600;
  line-height: 1.35;
  padding: 8px 14px;
  white-space: nowrap;
  text-overflow: ellipsis;
  overflow: hidden;
  text-align: center;
  background: linear-gradient(135deg, rgba(255,255,255,0.08), rgba(255,255,255,0.02));
  border-radius: 999px;
  border: 1px solid rgba(255,255,255,0.12);
  box-shadow: 0 8px 18px rgba(0,0,0,0.24);
  backdrop-filter: blur(6px);
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.tick::before{
  content: "";
  width: 10px;
  height: 10px;
  border-radius: 50%;
  background: radial-gradient(circle, #1ed760 0%, rgba(30,215,96,0.5) 60%, rgba(30,215,96,0) 100%);
  box-shadow: 0 0 12px rgba(30,215,96,0.8);
}
@keyframes ticker-move{
  0% { transform: translateY(0); }
  100% { transform: translateY(-50%); }
}

// 证书弹窗样式
:deep(.certificate-popup) {
  background: rgba(0, 0, 0, 0.7);
  backdrop-filter: blur(10px);
}

.certificate-popup-main {
  width: 90vw;
  max-width: 500px;
  background: rgba(0, 0, 0, 0.85);
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.1);
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
}

.certificate-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  background: rgba(255, 255, 255, 0.03);
}

.certificate-title {
  font-size: 18px;
  font-weight: 700;
  color: #fff;
}

.close-icon {
  font-size: 20px;
  color: #999;
  cursor: pointer;
  padding: 8px;
  border-radius: 6px;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
  justify-content: center;
  
  &:hover {
    color: #333;
    background: rgba(0, 0, 0, 0.05);
  }
  
  &:active {
    background: rgba(0, 0, 0, 0.1);
  }
}

.certificate-content {
  padding: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 300px;
  max-height: 70vh;
  overflow: auto;
}

.certificate-image {
    width: 100%;
  max-width: 100%;
  border-radius: 8px;
  overflow: hidden;
  
  :deep(img) {
    width: 100%;
    height: auto;
    display: block;
  }
}

// 条款弹窗样式 - 升级版
:deep(.clause-popup) {
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
}

.clause-popup-main {
  width: 90vw;
  max-width: 540px;
  max-height: 85vh;
  background: linear-gradient(145deg, rgba(25, 25, 32, 0.98), rgba(18, 18, 24, 0.98));
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 24px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 
    0 30px 80px rgba(0, 0, 0, 0.7),
    0 15px 40px rgba(0, 0, 0, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.08) inset,
    0 0 0 2px rgba(0, 0, 0, 0.3) inset,
    0 10px 30px rgba(0, 0, 0, 0.5) inset,
    0 -2px 10px rgba(255, 255, 255, 0.03) inset;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  color: #fff;
  box-sizing: border-box;
  position: relative;
  animation: clause-popup-enter 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.clause-popup-main::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, 
    transparent, 
    rgba(30, 215, 96, 0.3), 
    rgba(30, 215, 96, 0.5), 
    rgba(30, 215, 96, 0.3), 
    transparent
  );
  pointer-events: none;
  border-radius: 24px 24px 0 0;
}

.clause-popup-main::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 24px;
  background: linear-gradient(135deg, 
    rgba(255, 255, 255, 0.05) 0%, 
    transparent 50%, 
    rgba(0, 0, 0, 0.1) 100%
  );
  pointer-events: none;
}

@keyframes clause-popup-enter {
  0% {
    opacity: 0;
    transform: scale(0.92) translateY(20px);
  }
  100% {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

.clause-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 24px 18px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.12);
  background: rgba(255, 255, 255, 0.02);
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

.clause-title {
  font-size: 20px;
  font-weight: 700;
  color: #fff;
  letter-spacing: 0.3px;
  text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.close-icon {
  font-size: 20px;
  color: #999;
  cursor: pointer;
  padding: 8px;
  border-radius: 6px;
  transition: all 0.2s ease;
  display: flex;
  align-items: center;
    justify-content: center;
  
  &:hover {
    color: #333;
    background: rgba(0, 0, 0, 0.05);
  }
  
  &:active {
    background: rgba(0, 0, 0, 0.1);
  }
  
  &:active {
    transform: rotate(90deg) scale(0.95);
  }
}

.clause-content {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 0;
  min-height: 300px;
  max-height: calc(85vh - 80px);
  position: relative;
  z-index: 1;
  // 移动端平滑滚动支持
  -webkit-overflow-scrolling: touch;
  touch-action: pan-y;
  
  // 自定义滚动条样式
  &::-webkit-scrollbar {
    width: 6px;
  }
  
  &::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 3px;
  }
  
  &::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
    
    &:hover {
      background: rgba(255, 255, 255, 0.3);
    }
  }
}

.clause-loading,
.clause-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 60px 20px;
  color: rgba(255, 255, 255, 0.6);
  font-size: 15px;
  gap: 16px;
}

.clause-text-content {
  padding: 28px 24px;
  color: rgba(255, 255, 255, 0.95);
  font-size: 16px;
  line-height: 1.9;
  position: relative;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif;
  letter-spacing: 0.2px;
  // 确保文本区域不阻止触摸滚动
  touch-action: pan-y;
  pointer-events: auto;
}

.clause-paragraph {
  margin-bottom: 20px;
  text-align: left;
  padding: 18px 20px;
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.04), rgba(255, 255, 255, 0.02));
  border-radius: 14px;
  border-left: 4px solid rgba(30, 215, 96, 0.35);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  box-shadow: 
    0 2px 8px rgba(0, 0, 0, 0.1),
    0 1px 3px rgba(0, 0, 0, 0.05),
    inset 0 1px 0 rgba(255, 255, 255, 0.05);
  word-wrap: break-word;
  word-break: break-word;
  hyphens: auto;
  // 确保文本段落不阻止触摸滚动
  touch-action: pan-y;
  pointer-events: auto;
  user-select: text;
  -webkit-user-select: text;
  
  &::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(180deg, 
      rgba(30, 215, 96, 0.5), 
      rgba(30, 215, 96, 0.35),
      rgba(30, 215, 96, 0.5)
    );
    border-radius: 2px 0 0 2px;
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  &:hover {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.06), rgba(255, 255, 255, 0.03));
    border-left-color: rgba(30, 215, 96, 0.6);
    transform: translateX(3px);
    box-shadow: 
      0 4px 12px rgba(0, 0, 0, 0.15),
      0 2px 6px rgba(0, 0, 0, 0.1),
      inset 0 1px 0 rgba(255, 255, 255, 0.08),
      0 0 20px rgba(30, 215, 96, 0.1);
    
    &::before {
      opacity: 1;
    }
  }
  
  &:last-child {
    margin-bottom: 0;
  }
  
  // 首段特殊样式 - 更突出
  &:first-child {
    background: linear-gradient(135deg, 
      rgba(30, 215, 96, 0.12), 
      rgba(30, 215, 96, 0.06)
    );
    border-left-color: rgba(30, 215, 96, 0.7);
    font-weight: 500;
    font-size: 16.5px;
    padding: 20px 22px;
    box-shadow: 
      0 4px 16px rgba(0, 0, 0, 0.15),
      0 2px 8px rgba(0, 0, 0, 0.1),
      inset 0 1px 0 rgba(255, 255, 255, 0.1),
      0 0 30px rgba(30, 215, 96, 0.15);
    
    &::before {
      background: linear-gradient(180deg, 
        rgba(30, 215, 96, 0.8), 
        rgba(30, 215, 96, 0.6),
        rgba(30, 215, 96, 0.8)
      );
      opacity: 1;
    }
    
    &:hover {
      background: linear-gradient(135deg, 
        rgba(30, 215, 96, 0.15), 
        rgba(30, 215, 96, 0.08)
      );
      border-left-color: rgba(30, 215, 96, 0.85);
      box-shadow: 
        0 6px 20px rgba(0, 0, 0, 0.2),
        0 3px 10px rgba(0, 0, 0, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.12),
        0 0 40px rgba(30, 215, 96, 0.2);
    }
  }
  
  // 长段落优化
  &[data-long] {
    padding: 20px 22px;
  }
}

// 事件弹窗样式 - 官方正式风格，支持移动端手指滑动
:deep(.event-popup) {
  background: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

.event-popup-main {
  width: 90vw;
  max-width: 600px;
  max-height: 85vh;
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 
    0 20px 60px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(0, 0, 0, 0.05);
  color: #333;
  box-sizing: border-box;
  position: relative;
  animation: event-popup-enter 0.3s ease-out;
}

@keyframes event-popup-enter {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.event-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 24px 28px;
  border-bottom: 1px solid #e5e5e5;
  background: #fafafa;
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

.event-title {
  font-size: 22px;
  font-weight: 600;
  color: #1a1a1a;
  letter-spacing: -0.3px;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif;
}

.event-content {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 0;
  min-height: 300px;
  max-height: calc(85vh - 90px);
  position: relative;
  z-index: 1;
  background: #ffffff;
  // 移动端平滑滚动支持
  -webkit-overflow-scrolling: touch;
  touch-action: pan-y;
  
  &::-webkit-scrollbar {
    width: 8px;
  }
  
  &::-webkit-scrollbar-track {
    background: #f5f5f5;
    border-radius: 4px;
  }
  
  &::-webkit-scrollbar-thumb {
    background: #d0d0d0;
    border-radius: 4px;
    
    &:hover {
      background: #b0b0b0;
    }
  }
}

.event-loading,
.event-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 80px 20px;
  color: #999;
  font-size: 15px;
  gap: 16px;
}

.event-text-content {
  padding: 32px 32px;
  color: #333;
  font-size: 15px;
  line-height: 1.8;
  position: relative;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif;
  letter-spacing: 0;
  // 确保文本区域不阻止触摸滚动
  touch-action: pan-y;
  pointer-events: auto;
}

.event-paragraph {
  margin-bottom: 24px;
  text-align: left;
  padding: 0;
  background: transparent;
  border: none;
  border-radius: 0;
  transition: none;
  position: relative;
  box-shadow: none;
  word-wrap: break-word;
  word-break: break-word;
  color: #4a4a4a;
  font-size: 15px;
  line-height: 1.8;
  // 确保文本段落不阻止触摸滚动
  touch-action: pan-y;
  pointer-events: auto;
  user-select: text;
  -webkit-user-select: text;
  
  &:last-child {
    margin-bottom: 0;
  }
  
  // 首段样式 - 更正式
  &:first-child {
    font-size: 16px;
    font-weight: 500;
    color: #1a1a1a;
    line-height: 1.75;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e8e8e8;
  }
  
  &[data-long] {
    line-height: 1.85;
  }
}

// 关于我们弹窗样式 - 官方正式风格，支持移动端手指滑动
:deep(.about-popup) {
  background: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(8px);
  -webkit-backdrop-filter: blur(8px);
}

.about-popup-main {
  width: 90vw;
  max-width: 600px;
  max-height: 85vh;
  background: #ffffff;
  border-radius: 16px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  box-shadow: 
    0 20px 60px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(0, 0, 0, 0.05);
  color: #333;
  box-sizing: border-box;
  position: relative;
  animation: about-popup-enter 0.3s ease-out;
}

@keyframes about-popup-enter {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}

.about-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 24px 28px;
  border-bottom: 1px solid #e5e5e5;
  background: #fafafa;
  flex-shrink: 0;
  position: relative;
  z-index: 1;
}

.about-title {
  font-size: 22px;
  font-weight: 600;
  color: #1a1a1a;
  letter-spacing: -0.3px;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif;
}

.about-content {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 0;
  min-height: 300px;
  max-height: calc(85vh - 90px);
  position: relative;
  z-index: 1;
  background: #ffffff;
  // 移动端平滑滚动支持
  -webkit-overflow-scrolling: touch;
  touch-action: pan-y;
  
  &::-webkit-scrollbar {
    width: 8px;
  }
  
  &::-webkit-scrollbar-track {
    background: #f5f5f5;
    border-radius: 4px;
  }
  
  &::-webkit-scrollbar-thumb {
    background: #d0d0d0;
    border-radius: 4px;
    
    &:hover {
      background: #b0b0b0;
    }
  }
}

.about-loading,
.about-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 80px 20px;
  color: #999;
  font-size: 15px;
  gap: 16px;
}

.about-text-content {
  padding: 32px 32px;
  color: #333;
  font-size: 15px;
  line-height: 1.8;
  position: relative;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif;
  letter-spacing: 0;
  // 确保文本区域不阻止触摸滚动
  touch-action: pan-y;
  pointer-events: auto;
}

.about-paragraph {
  margin-bottom: 24px;
  text-align: left;
  padding: 0;
  background: transparent;
  border: none;
  border-radius: 0;
  transition: none;
  position: relative;
  box-shadow: none;
  word-wrap: break-word;
  word-break: break-word;
  color: #4a4a4a;
  font-size: 15px;
  line-height: 1.8;
  // 确保文本段落不阻止触摸滚动
  touch-action: pan-y;
  pointer-events: auto;
  user-select: text;
  -webkit-user-select: text;
  
  &:last-child {
    margin-bottom: 0;
  }
  
  // 首段样式 - 更正式
  &:first-child {
    font-size: 16px;
    font-weight: 500;
    color: #1a1a1a;
    line-height: 1.75;
    margin-bottom: 28px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e8e8e8;
  }
  
  &[data-long] {
    line-height: 1.85;
  }
}

@media (max-width: 600px) {
  .home-main{
    padding: 12px 10px;
    padding-top: max(12px, env(safe-area-inset-top, 0px));
    padding-bottom: calc(80px + env(safe-area-inset-bottom, 0px));
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
  }
  .quick-nav {
    width: 100%;
    box-sizing: border-box;
  }
  .nav-grid {
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
    width: 100%;
    box-sizing: border-box;
  }
  .nav-item{
    padding: 10px 6px;
    min-height: 100px;
    gap: 6px;
  }
  .nav-icon{
    width: 54px;
    height: 54px;
  }
  .nav-label{
    font-size: 12px;
    line-height: 1.2;
  }
  .player-dynamics-wrapper {
    margin-top: -4px;
    gap: 0 !important;
  }
  .player-frame{
    height: 148px !important;
    border-radius: 12px 12px 0 0;
    max-width: 100%;
    border-bottom: none !important;
  }
  .player-iframe{
    height: 168px !important;
    top: -2px;
  }
  .player-frame + .dynamics-card {
    margin-top: -2px !important;
    border-radius: 0 0 14px 14px;
    border-top: none !important;
  }
  .dynamics-card{
    margin-top: -2px !important;
    height: 180px;
    border-radius: 0 0 14px 14px;
    border-top: none !important;
    background: rgba(255, 255, 255, 0.04);
  }
  .ticker-track{
    height: 180px;
  }
  .tick{
    font-size: 16px;
    padding: 7px 12px;
  }
}
</style>
