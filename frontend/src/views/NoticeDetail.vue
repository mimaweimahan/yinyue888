<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
      <div class="page-wrapper-header">
        <div class="icon-box" @click="goBack">
          <van-icon name="arrow-left" size="20" />
        </div>
        <div class="title">{{ t('notice.detail') || '公告详情' }}</div>
      </div>

      <div class="content-section">
        <van-loading v-if="loading" type="spinner" vertical class="loading-box">
          {{ t('notice.loading') || '加载中...' }}
        </van-loading>
        
        <div v-else-if="error" class="error-box">
          <van-icon name="warning-o" size="40" />
          <p>{{ error }}</p>
          <van-button type="primary" size="small" @click="fetchNoticeDetail">
            {{ t('notice.retry') || '重试' }}
          </van-button>
        </div>

        <div v-else-if="notice" class="notice-detail">
          <h1 class="notice-detail-title">{{ notice.title }}</h1>
          <div class="notice-detail-content" v-if="notice.content">
            {{ notice.content }}
          </div>
          <div class="notice-detail-empty" v-else>
            {{ t('notice.no_content') || '暂无内容' }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter, useRoute } from 'vue-router'
import { i18n } from '@/i18n'
import { noticeDetailApi } from '@/api/public'
import { showFailToast } from 'vant'

defineOptions({ name: 'NoticeDetailPage' })
const { t } = i18n.global
const router = useRouter()
const route = useRoute()

const notice = ref(null)
const loading = ref(false)
const error = ref('')

const fetchNoticeDetail = async () => {
  const noticeId = route.query.id
  if (!noticeId) {
    error.value = t('notice.missing_id') || '缺少公告ID'
    return
  }
  
  loading.value = true
  error.value = ''
  try {
    const res = await noticeDetailApi({ id: noticeId })
    if (res?.code === 1 && res?.data) {
      notice.value = res.data
    } else {
      error.value = res?.msg || t('common.get_notice_detail_failed') || '获取公告详情失败'
    }
  } catch (e) {
    console.error('获取公告详情失败：', e)
    error.value = e?.msg || e?.message || t('common.get_notice_detail_failed') || '获取公告详情失败'
    showFailToast(error.value)
  } finally {
    loading.value = false
  }
}

const goBack = () => {
  router.back()
}

onMounted(() => {
  fetchNoticeDetail()
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
  padding: 60px 20px;
  text-align: center;
  color: rgba(255, 255, 255, 0.8);
  
  p {
    margin: 16px 0;
    font-size: 14px;
  }
}

.notice-detail {
  background: rgba(255, 255, 255, 0.04);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 20px;
}

.notice-detail-title {
  font-size: 20px;
  font-weight: 700;
  color: #fff;
  margin: 0 0 20px 0;
  line-height: 1.4;
  word-break: break-word;
}

.notice-detail-content {
  font-size: 15px;
  line-height: 1.8;
  color: rgba(255, 255, 255, 0.9);
  white-space: pre-wrap;
  word-break: break-word;
}

.notice-detail-empty {
  font-size: 15px;
  color: rgba(255, 255, 255, 0.5);
  text-align: center;
  padding: 40px 20px;
}

@media (max-width: 600px) {
  .page-wrapper-body {
    padding: 12px 10px;
    padding-top: max(12px, env(safe-area-inset-top, 0px));
  }
  
  .notice-detail {
    padding: 16px;
  }
  
  .notice-detail-title {
    font-size: 18px;
  }
  
  .notice-detail-content {
    font-size: 14px;
  }
}
</style>

