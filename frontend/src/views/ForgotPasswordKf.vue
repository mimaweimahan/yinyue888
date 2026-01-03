<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
      <section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goBack()" />
        <div class="title"><span>{{ t('mine.customer_service') || '客服' }}</span></div>
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
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { showFailToast } from 'vant'
import { kfUrlByAccountApi } from '@/api/public'
import { i18n } from '@/i18n'
import { useRouter, useRoute } from 'vue-router'
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
  
  // 从路由 query 参数中获取账号信息
  const account = route.query.account
  const accountType = route.query.type // 'email' 或 'phone'
  
  if (!account) {
    error.value = '缺少账号参数'
    loading.value = false
    showFailToast('缺少账号参数')
    return
  }
  
  try {
    // 构建请求参数
    const params = {}
    if (accountType === 'email') {
      params.email = account
    } else {
      params.phone = account
    }
    
    // 调用接口，根据账号获取客服链接（不需要登录）
    const res = await kfUrlByAccountApi(params)
    const data = res?.data || {}
    
    // 优先使用业务员链接，业务员没有则使用代理链接
    const agentUrl = data.agent_url || data.broker_url || data.salesman_url || data.agent_kf_url
    const proxyUrl = data.proxy_url || data.agency_url || data.proxy_kf_url
    
    // 先尝试业务员链接，再尝试代理链接，最后使用默认字段
    let target = agentUrl || proxyUrl || data.url || data.kf_url || data.customer_service || data.top_kf
    
    if (!target) {
      // 如果没有获取到链接，使用默认链接
      target = window.location.origin + '/index/user/kfindex'
    } else if (target.startsWith('/')) {
      // 如果是相对路径，拼接完整URL
      target = window.location.origin + target
    }
    
    // 验证 URL 安全性（如果验证失败，仍然使用原始URL）
    const validatedUrl = validateKfUrl(target) || target
    
    if (validatedUrl) {
      kfUrl.value = validatedUrl
    } else {
      error.value = '客服链接无效，请联系管理员'
      showFailToast(error.value)
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
  background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
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
  min-height: 100dvh;
  display: flex;
  flex-direction: column;
}

.page-wrapper-header {
  display: flex;
  align-items: center;
  padding: 16px 20px;
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  
  .icon-box {
    color: #fff;
    cursor: pointer;
    margin-right: 12px;
    transition: opacity 0.2s;
    
    &:hover {
      opacity: 0.7;
    }
  }
  
  .title {
    flex: 1;
    font-size: 18px;
    font-weight: 600;
    color: #fff;
    text-align: center;
  }
}

.content-section {
  flex: 1;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  
  .loading-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    
    .loading-text {
      color: #fff;
      font-size: 14px;
    }
  }
  
  .error-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
    padding: 40px 20px;
    
    .error-text {
      color: #fff;
      font-size: 14px;
      text-align: center;
    }
    
    .retry-btn {
      margin-top: 8px;
    }
  }
  
  .kf-iframe {
    width: 100%;
    height: 100%;
    min-height: 500px;
    border: none;
    border-radius: 8px;
    background: #fff;
  }
}

.ft-h {
  height: 20px;
}
</style>

