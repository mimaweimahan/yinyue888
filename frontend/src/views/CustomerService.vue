<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
      <section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goBack()" />
        <div class="title"><span>{{ t('mine.customer_service') || '客服接口' }}</span></div>
      </section>

      <section class="content-section">
        <div v-if="loading" class="loading-box">
          <van-loading size="28" color="#1ed760" />
          <div class="loading-text">{{ t('common.loading') || '加载中...' }}</div>
        </div>
        <div v-else-if="error" class="error-box">
          <van-icon name="warning-o" size="48" color="#ff4444" />
          <div class="error-text">{{ error }}</div>
          <van-button class="retry-btn" type="primary" @click="loadKfUrl">重试</van-button>
        </div>
        <iframe
          v-else-if="kfUrl"
          :src="kfUrl"
          class="kf-iframe"
          frameborder="0"
          loading="eager"
          sandbox="allow-scripts allow-same-origin allow-forms allow-popups"
          referrerpolicy="strict-origin-when-cross-origin"
          @error="handleIframeError"
          @load="handleIframeLoad"
        ></iframe>
      </section>

      <div class="ft-h"></div>
      <FooterTabbar active="home" />
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { showFailToast } from 'vant'
import { kfUrlApi } from '@/api/public'
import { i18n } from '@/i18n'
import { useRouter, useRoute } from 'vue-router'
import FooterTabbar from '@/components/FooterTabbar.vue'
import { validateKfUrl } from '@/utils/common'

const router = useRouter()
const route = useRoute()
const { t } = i18n.global

const loading = ref(true)
const error = ref('')
const kfUrl = ref('')

const goBack = () => {
  router.back()
}

const handleIframeError = () => {
  error.value = '客服页面加载失败，请稍后重试'
  kfUrl.value = ''
  loading.value = false
}

const handleIframeLoad = () => {
  // iframe 加载成功后的处理
}

const loadKfUrl = async () => {
  loading.value = true
  error.value = ''
  
  // 如果路由 query 中有 kf_url 参数（从忘记密码页面传递过来的），直接使用
  const queryKfUrl = route.query.kf_url
  if (queryKfUrl) {
    try {
      const decodedUrl = decodeURIComponent(queryKfUrl)
      const validatedUrl = validateKfUrl(decodedUrl)
      if (validatedUrl) {
        kfUrl.value = validatedUrl
        loading.value = false
        return
      }
    } catch (e) {
      console.error('解析传递的客服链接失败:', e)
      // 如果解析失败，继续调用接口获取
    }
  }
  
  try {
    const res = await kfUrlApi({})
    const d = res?.data || {}
    
    // 优先使用业务员链接，业务员没有则使用代理链接
    // 业务员链接字段：agent_url, broker_url, salesman_url, agent_kf_url
    // 代理链接字段：proxy_url, agency_url, proxy_kf_url
    const agentUrl = d.agent_url || d.broker_url || d.salesman_url || d.agent_kf_url
    const proxyUrl = d.proxy_url || d.agency_url || d.proxy_kf_url
    
    // 先尝试业务员链接
    let rawUrl = agentUrl || proxyUrl || d.url || d.kf_url || d.customer_service || d.top_kf || '/index/user/kfindex'
    
    // 验证 URL 安全性
    const validatedUrl = validateKfUrl(rawUrl)
    
    if (validatedUrl) {
      kfUrl.value = validatedUrl
    } else {
      // 如果验证失败，使用默认的同域链接
      const defaultUrl = window.location.origin + '/index/user/kfindex'
      const defaultValidated = validateKfUrl(defaultUrl)
      if (defaultValidated) {
        kfUrl.value = defaultValidated
      } else {
        error.value = '客服链接无效，请联系管理员'
        showFailToast(error.value)
      }
    }
    
    loading.value = false
  } catch (e) {
    loading.value = false
    error.value = e.msg || '加载客服链接失败'
    showFailToast(error.value)
  }
}

onMounted(() => {
  loadKfUrl()
})
</script>

<style scoped lang="scss">
.page-wrapper {
  position: relative;
  min-height: 100dvh;
  background: #000;
  overflow: hidden;
  overflow-x: hidden;
}

.page-bg {
  position: fixed;
  inset: 0;
  background: url('/images/home/bg-page.png') center/cover no-repeat;
  filter: blur(14px);
  opacity: 0.5;
  z-index: 0;
}

.page-mask {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1;
}

.page-wrapper-body {
  position: relative;
  z-index: 2;
  max-width: 520px;
  margin: 0 auto;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
  padding: 14px 12px;
  padding-top: max(14px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  color: #fff;
}

.page-wrapper-header {
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  padding: 12px 0;
  margin-bottom: 16px;
  
  .icon-box {
    position: absolute;
    left: 0;
    padding: 8px;
    cursor: pointer;
    color: #fff;
    border-radius: 8px;
    transition: background-color 0.2s;
    
    &:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    
    &:active {
      background-color: rgba(255, 255, 255, 0.15);
    }
  }
  
  .title {
    font-size: 18px;
    font-weight: 700;
    color: #fff;
    text-align: center;
  }
}

.content-section {
  position: relative;
  width: 100%;
    height: calc(100dvh - 140px);
  min-height: 500px;
  background: rgba(0, 0, 0, 0.25);
  border: 1px solid rgba(255, 255, 255, 0.06);
  border-radius: 14px;
  overflow: hidden;
  backdrop-filter: blur(20px);
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.4),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.loading-box,
.error-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  gap: 16px;
  
  .loading-text,
  .error-text {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.7);
    text-align: center;
  }
  
  .error-text {
    color: rgba(255, 68, 68, 0.9);
  }
}

.retry-btn {
  margin-top: 8px;
  background: linear-gradient(135deg, #11b411, #1ed760);
  border: none;
  border-radius: 8px;
  color: #fff;
  font-size: 14px;
  font-weight: 600;
  padding: 10px 24px;
  box-shadow: 0 4px 12px rgba(17, 180, 17, 0.3);
}

.kf-iframe {
  width: 100%;
  height: 100%;
  border: none;
  background: #fff;
}

.ft-h {
  height: 20px;
}

@media (max-width: 600px) {
  .page-wrapper-body {
    padding: 12px 10px;
    padding-top: max(12px, env(safe-area-inset-top, 0px));
    padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  }
  
  .content-section {
    height: calc(100dvh - 120px);
    min-height: 400px;
    border-radius: 12px;
  }
  
  .page-wrapper-header {
    padding: 10px 0;
    margin-bottom: 12px;
    
    .title {
      font-size: 16px;
    }
  }
}
</style>

