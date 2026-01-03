<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
      <div class="page-wrapper-header">
        <div class="icon-box" @click="goBack">
          <van-icon name="arrow-left" size="20" />
        </div>
        <div class="title">{{ t('notice.title') || '公告列表' }}</div>
      </div>

      <div class="content-section">
        <van-loading v-if="loading" type="spinner" vertical class="loading-box">
          {{ t('notice.loading') || '加载中...' }}
        </van-loading>
        
        <div v-else-if="error" class="error-box">
          <van-icon name="warning-o" size="40" />
          <div class="error-content">
            <p class="error-title">错误详情（供调试使用）：</p>
            <pre class="error-message">{{ formatError(error) }}</pre>
          </div>
          <van-button type="primary" size="small" @click="fetchNotices">
            {{ t('notice.retry') || '重试' }}
          </van-button>
        </div>

        <div v-else-if="notices.length === 0" class="empty-box">
          <van-icon name="info-o" size="40" />
          <p>{{ t('notice.empty') || '暂无公告' }}</p>
        </div>

        <div v-else class="notice-list">
          <div
            v-for="notice in notices"
            :key="notice.id"
            class="notice-item"
            @click="viewNoticeDetail(notice)"
          >
            <div class="notice-item-main">
              <h3 class="notice-item-title">{{ notice.title }}</h3>
            </div>
            <div class="notice-item-arrow">
              <van-icon name="arrow" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { i18n } from '@/i18n'
import { noticeListApi } from '@/api/public'
import { showFailToast } from 'vant'

defineOptions({ name: 'NoticeListPage' })
const { t } = i18n.global
const router = useRouter()

const notices = ref([])
const loading = ref(false)
const error = ref('')

const fetchNotices = async () => {
  loading.value = true
  error.value = ''
  try {
    // 获取所有公告，不限制 show_home
    const res = await noticeListApi({ limit: 100 })
    if (res?.code === 1 && Array.isArray(res?.data)) {
      notices.value = res.data
    } else {
      // 显示完整的响应信息
      const errorMsg = res?.msg || JSON.stringify(res, null, 2) || t('common.get_notice_list_failed') || '获取公告失败'
      error.value = `API 返回错误: ${errorMsg}`
    }
  } catch (e) {
    console.error('获取公告列表失败：', e)
    // 提取完整的错误信息，包括堆栈和响应数据
    let errorMsg = ''
    if (e?.response?.data) {
      // 如果有响应数据，显示完整的响应
      errorMsg = `HTTP ${e.response.status || 'Error'}: ${JSON.stringify(e.response.data, null, 2)}`
    } else if (e?.msg) {
      errorMsg = e.msg
    } else if (e?.message) {
      errorMsg = e.message
    } else {
      errorMsg = JSON.stringify(e, null, 2)
    }
    error.value = `请求失败: ${errorMsg}`
    showFailToast(t('common.get_notice_list_failed') || '获取公告列表失败')
  } finally {
    loading.value = false
  }
}

const viewNoticeDetail = (notice) => {
  // 跳转到详情页面
  router.push({
    path: '/notice-detail',
    query: { id: notice.id }
  })
}

const formatError = (errorMsg) => {
  // 显示完整错误信息供后端调试
  return errorMsg || '未知错误'
}

const goBack = () => {
  router.back()
}

onMounted(() => {
  fetchNotices()
})
</script>

<style scoped lang="scss">
.page-wrapper {
  position: relative;
  min-height: 100vh;
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
  min-height: 100vh;
  min-height: 100dvh;
}

.page-mask {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.6);
  z-index: 1;
  min-height: 100vh;
  min-height: 100dvh;
}

.page-wrapper-body {
  position: relative;
  z-index: 2;
  max-width: 520px;
  margin: 0 auto;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
  padding: 14px 12px;
  padding-top: max(14px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(20px + env(safe-area-inset-bottom, 0px));
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
  min-height: 200px;
}

.loading-box {
  padding: 60px 0;
  color: rgba(255, 255, 255, 0.8);
}

.error-box {
  padding: 40px 20px;
  text-align: center;
  color: rgba(255, 255, 255, 0.8);
  
  .error-content {
    text-align: left;
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 68, 68, 0.3);
    border-radius: 8px;
    padding: 16px;
    margin: 20px 0;
    max-height: 400px;
    overflow-y: auto;
  }
  
  .error-title {
    font-size: 14px;
    font-weight: 600;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 12px 0;
  }
  
  .error-message {
    font-family: 'Consolas', 'Monaco', 'Courier New', monospace;
    font-size: 12px;
    line-height: 1.6;
    color: rgba(255, 100, 100, 0.95);
    white-space: pre-wrap;
    word-break: break-word;
    margin: 0;
    padding: 0;
    background: transparent;
    border: none;
  }
}

.empty-box {
  padding: 60px 20px;
  text-align: center;
  color: rgba(255, 255, 255, 0.6);
  
  p {
    margin-top: 16px;
    font-size: 14px;
  }
}

.notice-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.notice-item {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 16px;
  cursor: pointer;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  
  &::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
      rgba(255, 255, 255, 0.05) 0%, 
      transparent 50%, 
      rgba(0, 0, 0, 0.1) 100%
    );
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  &:hover {
    background: rgba(255, 255, 255, 0.06);
    border-color: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    
    &::before {
      opacity: 1;
    }
    
    .notice-item-arrow {
      opacity: 1;
      transform: translateX(0);
    }
  }
  
  &:active {
    transform: translateY(0);
  }
}

.notice-item-main {
  flex: 1;
  min-width: 0;
}

.notice-item-title {
  font-size: 16px;
  font-weight: 600;
  color: #fff;
  margin: 0;
  line-height: 1.4;
  word-break: break-word;
}

.notice-item-arrow {
  flex-shrink: 0;
  opacity: 0.5;
  transition: all 0.3s ease;
  color: rgba(255, 255, 255, 0.6);
  transform: translateX(-4px);
}

@media (max-width: 600px) {
  .page-wrapper-body {
    padding: 12px 10px;
    padding-top: max(12px, env(safe-area-inset-top, 0px));
  }
  
  .notice-item {
    padding: 14px;
  }
  
  .notice-item-title {
    font-size: 15px;
  }
}
</style>

