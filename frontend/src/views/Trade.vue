<template>
  <div class="trade-page">
    <div class="trade-bg-blur"></div>
    <div class="trade-bg-mask"></div>
    <div class="trade-main">
      <div class="top-nav">
        <div class="nav-left"></div>
        <button class="records-3d-btn" @click="goRecords">
          {{ t('trade.records') || '订单记录' }}
        </button>
      </div>

      <!-- 轮播图模块 - 3D 卡片效果（带悬浮效果） -->
      <div class="banner-swipe-wrapper" v-if="bannerList.length > 0">
		  <van-swipe
          class="banner-swipe"
          :autoplay="4000"
          :show-indicators="true"
          indicator-color="rgba(255, 255, 255, 0.3)"
          indicator-color-active="#11b411"
          :lazy-render="true"
          @change="onBannerChange"
        >
          <van-swipe-item
            v-for="(item, index) in bannerList"
            :key="index"
            class="banner-item"
            :class="{ 'active': currentBannerIndex === index }"
          >
            <div class="banner-card">
              <van-image
                :src="item.image"
                fit="contain"
                class="banner-image"
                :alt="item.title || item.name || ''"
                :show-loading="true"
                :show-error="true"
                loading-icon="photo"
                error-icon="photo-fail"
                @load="onImageLoad"
                @error="onImageError"
              />
              <div class="banner-overlay" v-if="item.title || item.desc">
                <div class="banner-title" v-if="item.title">{{ item.title }}</div>
                <div class="banner-desc" v-if="item.desc">{{ item.desc }}</div>
              </div>
            </div>
          </van-swipe-item>
		  </van-swipe>
					</div>

      <!-- 玻璃拟态卡片 - 合并 Today Income 和 Account Balance -->
      <div class="glass-stats-card" :class="{ 'income-beat': incomeBeat }">
        <div class="glass-card-content">
          <!-- Today's Income -->
          <div class="stat-row income-row">
            <div class="stat-info">
              <div class="stat-label">{{ t('trade.today_income') || 'Today\'s Income' }}</div>
              <div class="stat-desc">{{ t('trade.auto_update') || 'Auto updated daily' }}</div>
					</div>
            <div class="stat-amount">
              <span class="amount-value" :class="{ 'income-beat': incomeBeat }">
                ${{ formatAmount(data.task?.task_revenue) }}
              </span>
              <span class="amount-unit">USD</span>
              <div v-if="incomeBeat" class="music-eq">
                <span class="bar b1"></span>
                <span class="bar b2"></span>
                <span class="bar b3"></span>
                <span class="bar b4"></span>
                <span class="bar b5"></span>
				</div>
						</div>
					</div>
          
          <!-- Divider -->
          <div class="stat-divider"></div>
          
          <!-- Account Balance -->
          <div class="stat-row balance-row">
            <div class="stat-info">
              <div class="stat-label">{{ t('trade.balance') || 'Account Balance' }}</div>
              <div class="stat-desc">{{ t('trade.balance_tip') || 'Total assets balance' }}</div>
						</div>
            <div class="stat-amount">
              <span class="amount-value">
                ${{ formatAmount(data.wallet?.balance ?? data.wallet?.total_balance) }}
              </span>
              <span class="amount-unit">USD</span>
					</div>
				</div>
			</div>
		</div>
		
      <!-- 专业金融风格按钮 - 深色背景+绿色流光边框 -->
      <button 
        class="main-btn premium-btn" 
        :disabled="data.loading" 
        :class="{ 'loading': data.loading }"
        @click="onStart"
      >
        <span class="btn-content">
          <span class="btn-text">{{ t('trade.start') || 'Single Start Matching' }}</span>
          <span class="btn-count">({{ data.task?.task_done || 0 }}/{{ data.task?.task_num || 0 }})</span>
        </span>
        <div class="btn-glow"></div>
        <div v-if="data.loading" class="btn-loading">
          <van-loading size="20" color="#11b411" />
			</div>
      </button>

      <div class="bottom-eq">
        <img src="/order_files/W11.gif" alt="eq" />
			</div>

      <div class="ft-h"></div>
      <FooterTabbar active="trade" />

      <!-- 交易成功弹窗 -->
      <van-popup
        :show="data.success_popup_show"
        @update:show="(val) => (data.success_popup_show = val)"
        :close-on-click-overlay="true"
        :close-on-popstate="false"
        lock-scroll
        class="success-popup"
      >
        <div class="success-popup-main">
          <div class="success-left">
            <div class="success-icon">
              <div class="success-checkmark">
                <div class="checkmark-circle"></div>
                <div class="checkmark-stem"></div>
                <div class="checkmark-kick"></div>
				</div>
			</div>
			</div>
          <div class="success-right">
            <div class="success-title">{{ t('trade.success') || '交易成功' }}</div>
            <div class="success-profit" v-if="data.order?.profit">
              <span class="profit-label">{{ t('trade.list.profit') || '预计收益' }}：</span>
              <span class="profit-value">${{ data.order.profit }}</span>
		</div>
		</div>
	</div>
      </van-popup>

      <!-- 订单弹窗 -->
      <van-popup
        :show="data.task_popup_show"
        @update:show="(val) => (data.task_popup_show = val)"
        :close-on-click-overlay="false"
        :close-on-popstate="false"
        lock-scroll
        class="task-popup"
      >
  	<div class="task-popup-main">
          <div class="popup-header">
            <div class="popup-title">{{ t('trade.purchase_album') || '购买专辑:' }}</div>
            <van-icon name="cross" class="close-icon" @click="onCancel()" />
			</div>
          
          <div class="task-popup-content">
            <div class="album-section">
            <div class="album-cover">
              <van-image :src="getGoodsImageUrl(data.order?.goods_pic)" fit="cover" />
				</div>
            <div class="album-info">
              <div class="album-artist">{{ t('trade.album_artist') || 'SEGRETO' }}</div>
              <div class="album-title">{{ data.order?.goods_name || 'Give Me A Chance' }}</div>
				</div>
			</div>

          <div class="financial-section">
            <div class="financial-item">
              <div class="financial-label">{{ t('trade.list.total_amount') || '订单金额' }}</div>
              <div class="financial-value">${{ data.order?.total_price || '0.00' }}</div>
					</div>
            <div class="financial-item">
              <div class="financial-label">{{ t('trade.deposit') || '存款' }}</div>
              <div class="financial-value">${{ data.order?.deposit || '0' }}</div>
					</div>
            <div class="financial-item">
              <div class="financial-label">{{ t('trade.list.profit') || '订单利润' }}</div>
              <div class="financial-value">${{ data.order?.profit || '0.00' }}</div>
					</div>
					</div>

          <div class="rating-section">
            <div class="rating-item">
              <div class="rating-label">{{ t('trade.musician') || '音乐家' }}</div>
              <div class="star-rating">
                <span 
                  v-for="(star, index) in 5" 
                  :key="index"
                  class="star"
                  :class="{ active: index < data.rating.musician }"
                  @click="data.rating.musician = index + 1"
                >
                  ★
                </span>
					</div>
				</div>
            <div class="rating-item">
              <div class="rating-label">{{ t('trade.singer') || '歌手' }}</div>
              <div class="star-rating">
                <span 
                  v-for="(star, index) in 5" 
                  :key="index"
                  class="star"
                  :class="{ active: index < data.rating.singer }"
                  @click="data.rating.singer = index + 1"
                >
                  ★
                </span>
			</div>
				</div>
			</div>

          <div class="comment-section">
            <div class="comment-label">{{ t('trade.song_review') || '歌曲评论' }}</div>
            <textarea 
              v-model="data.comment"
              class="comment-input"
              :placeholder="t('trade.comment_placeholder') || 'Type here'"
              rows="2"
            ></textarea>
					</div>
					</div>
			<div class="btn-box">
            <van-button 
              class="submit-btn" 
              type="primary" 
              :loading="data.loading" 
              @click="onConfirm(data.order?.order_id)"
            >
              {{ t('trade.submit') || '提交' }}
            </van-button>
  		</div>
  	</div>
  </van-popup>
  <Fireworks ref="fireRef" />
			</div>
		</div>
</template>

<script setup>
import { onMounted, ref, reactive, onUnmounted, computed } from 'vue'
import { walletApi, tradingInfoApi, tradingCreateApi, tradingConfirmApi } from '@/api/public'
import { showLoadingToast, showFailToast, showSuccessToast } from 'vant'
import { i18n } from '@/i18n'
	import FooterTabbar from '@/components/FooterTabbar.vue'
	import Fireworks from '@/components/Fireworks.vue'
import { useRouter } from 'vue-router'
import { formatAmount, getGoodsImageUrl } from '@/utils/common'
import { useTimer } from '@/composables/useTimer'
import config from '@/config'
const router = useRouter()

const { t } = i18n.global

	const data = reactive({
  wallet: {},
  loading: false,
  task: {
    task_num: 0,
    task_done: 0,
    task_rate: 0,
    task_revenue: '0.0000',
    credit_tips: 'Good credit score'
  },
  task_popup_show: false,
  success_popup_show: false,
  order: {
    order_id: 0,
    trade_no: '',
    goods_name: '',
    goods_pic: '',
    goods_price: '',
    goods_num: '',
    total_price: '',
    profit: '',
    created_at: '',
    is_ready: 0,
    need: 0,
    deposit: '0'
  },
  rating: {
    musician: 0,
    singer: 0
  },
  comment: ''
})

const incomeBeat = ref(false)
const prevRevenue = ref(0)
const incomeTimer = ref(null)
const currentBannerIndex = ref(0)

// 轮播图数据 - 使用本地静态图片（从 /images/lunbo/ 目录读取）
// 可以根据需要修改图片列表，支持最多显示多张图片
const bannerList = ref([
  { image: '/images/lunbo/u5hietn9y7.jpg', title: '', desc: '' },
  { image: '/images/lunbo/oailwkio0c.jpg', title: '', desc: '' },
  { image: '/images/lunbo/krp576i8uz.jpg', title: '', desc: '' },
  { image: '/images/lunbo/l04q2yroz3.jpg', title: '', desc: '' },
  { image: '/images/lunbo/z97v7094fx.jpg', title: '', desc: '' },
  { image: '/images/lunbo/otyj0bggcl.jpg', title: '', desc: '' },
  { image: '/images/lunbo/v2lwhucf49.jpg', title: '', desc: '' },
  { image: '/images/lunbo/tfg23xlo8h.jpg', title: '', desc: '' },
  { image: '/images/lunbo/qbpf6271xg.jpg', title: '', desc: '' },
  { image: '/images/lunbo/t4r9xsziox.jpg', title: '', desc: '' },
  { image: '/images/lunbo/zgm04id5rx.jpg', title: '', desc: '' },
  { image: '/images/lunbo/xlgewv2u0i.jpg', title: '', desc: '' },
  { image: '/images/lunbo/l3isxhis2l.jpg', title: '', desc: '' },
  { image: '/images/lunbo/rkko4ie6gf.jpg', title: '', desc: '' },
  { image: '/images/lunbo/s83isylilo.jpg', title: '', desc: '' },
  { image: '/images/lunbo/r9b6yhyrm1.jpg', title: '', desc: '' },
  { image: '/images/lunbo/qw5s72zwe3.jpg', title: '', desc: '' },
  { image: '/images/lunbo/tk5oa8o11n.jpg', title: '', desc: '' },
  { image: '/images/lunbo/oz3ww6qj9n.jpg', title: '', desc: '' },
  { image: '/images/lunbo/37tujixej0.jpg', title: '', desc: '' }
])

const onBannerChange = (index) => {
  currentBannerIndex.value = index
  // 预加载相邻的图片（前一张和后一张）
  preloadAdjacentImages(index)
}

// 预加载相邻图片
const preloadAdjacentImages = (currentIndex) => {
  const list = bannerList.value
  if (!list || list.length === 0) return
  
  // 预加载前一张
  const prevIndex = currentIndex > 0 ? currentIndex - 1 : list.length - 1
  // 预加载后一张
  const nextIndex = currentIndex < list.length - 1 ? currentIndex + 1 : 0
  
  const preloadImage = (url) => {
    if (!url) return
    const img = new Image()
    img.src = url
  }
  
  if (list[prevIndex]?.image) preloadImage(list[prevIndex].image)
  if (list[nextIndex]?.image) preloadImage(list[nextIndex].image)
}

// 图片加载成功
const onImageLoad = (event) => {
  // 图片加载成功后的处理
}

// 图片加载失败
const onImageError = (event) => {
  // 图片加载失败后的处理
}

const raf = (cb) => {
  if (typeof requestAnimationFrame === 'function') return requestAnimationFrame(cb)
  return setTimeout(cb, 16)
}

const triggerIncomeBeat = () => {
  // 重新触发动画：先置 false，再下一帧置 true
  if (incomeTimer.value) clearTimeout(incomeTimer.value)
  incomeBeat.value = false
  raf(() => {
    raf(() => {
      incomeBeat.value = true
      incomeTimer.value = setTimeout(() => {
        incomeBeat.value = false
      }, 1600)
    })
  })
}

const handleIncomeChange = (val) => {
  const num = parseFloat(val) || 0
  if (num > prevRevenue.value) {
    triggerIncomeBeat()
  }
  prevRevenue.value = num
}

const goRecords = () => {
  router.push('/list')
}

const onStart = () => {
  if (data.loading) return
  data.loading = true
		showLoadingToast({
			message: t('trade.search'),
			forbidClick: true,
    duration: 1200
  })
  tradingCreateApi()
    .then((res) => {
      data.order = res.data
      // 存款金额：使用need的绝对值，不管正负都显示（负数表示需要充值，存款就是需要充值的金额）
      if (data.order.need !== undefined && data.order.need !== null) {
        const needValue = parseFloat(data.order.need) || 0
        data.order.deposit = needValue < 0 ? String(Math.abs(needValue)) : String(needValue)
      } else {
        data.order.deposit = '0'
      }
			setTimeout(() => {
        data.loading = false
        showSuccessToast({
					message: t('trade.trading'),
          duration: 1200
        })
      }, 800)
			setTimeout(() => {
        // 重置评分和评论
        data.rating.musician = 0
        data.rating.singer = 0
        data.comment = ''
        data.task_popup_show = true
        if (fireRef.value && data.order.need < 0) {
          fireRef.value.startFireworks()
        }
      }, 1400)
    })
    .catch((e) => {
      data.loading = false
				showFailToast(e.msg)
    })
}

const onConfirm = (id) => {
  // 验证评分：必须都评5星
  if (data.rating.musician !== 5 || data.rating.singer !== 5) {
    showFailToast(t('trade.rate_required') || '请点满5个星')
    return
  }
  
  data.loading = true
  tradingConfirmApi({ 
    order_id: id,
    musician_rating: data.rating.musician,
    singer_rating: data.rating.singer,
    comment: data.comment
  })
    .then((res) => {
      data.order = res.data
      data.task_popup_show = false
      data.loading = false
      // 重置评分和评论
      data.rating.musician = 0
      data.rating.singer = 0
      data.comment = ''
      
      // 直接显示交易成功弹窗
      data.success_popup_show = true
      triggerIncomeBeat() // 交易完成立即触发特效
			refresh()
      // 2秒后自动关闭
      setTimeout(() => {
        data.success_popup_show = false
      }, 2000)
    })
    .catch((e) => {
      data.loading = false
			showFailToast(e.msg)
		})
	}
	


const onCancel = () => {
  // 重置评分和评论
  data.rating.musician = 0
  data.rating.singer = 0
  data.comment = ''
		refresh()
		data.task_popup_show = false
	}
	
const refresh = () => {
  walletApi().then((res) => {
    data.wallet = res.data
  })
  tradingInfoApi().then((res) => {
    data.task = res.data
    handleIncomeChange(res.data?.task_revenue)
  })
  // 轮播图已改为使用本地静态图片，不再需要获取商品列表接口
}

const fireRef = ref(null)

// 使用 composable 管理定时器
const { start: startTimer, stop: stopTimer } = useTimer(() => {
  refresh()
}, 8000, 'trade_timerId')
	 
	onMounted(() => {
  refresh()
  startTimer()
})

onUnmounted(() => {
  stopTimer()
})
</script>	

<style scoped lang="scss">
.trade-page {
			position: relative;
  min-height: 100dvh;
  overflow: hidden;
  overflow-x: hidden;
  background: #000;
}
.trade-bg-blur {
  position: fixed;
  inset: 0;
  background: url('/images/home/bg-page.png') center/cover no-repeat;
  filter: blur(12px);
  opacity: 0.55;
  z-index: 0;
}
.trade-bg-mask {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.65);
  z-index: 1;
}
.trade-main {
  position: relative;
  z-index: 2;
  max-width: 520px;
  width: 100%;
  margin: 0 auto;
  padding: 20px 12px;
  padding-top: max(20px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
			color: #fff;
  box-sizing: border-box;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
  display: flex;
  flex-direction: column;
}
.top-nav {
					display: flex;
  justify-content: space-between;
					align-items: center;
  padding: 8px 4px 16px 4px;
  font-weight: 800;
  font-size: 18px;
  color: #fff;
}
.nav-left {
  flex: 1;
}
.records-3d-btn {
  padding: 10px 20px;
  background: linear-gradient(135deg, #1ee484, #16c45f);
  border: none;
  border-radius: 12px;
  color: #fff;
  font-size: 15px;
					    font-weight: 700;
  cursor: pointer;
  box-shadow:
    0 8px 0 #0e8c46,
    0 12px 24px rgba(30, 228, 132, 0.4);
  transform: translateY(0);
  transition: transform 0.12s ease, box-shadow 0.12s ease, filter 0.12s ease;
  text-shadow: 0 2px 4px rgba(0,0,0,0.3);
  position: relative;
  overflow: hidden;
  overflow-x: hidden;
}
.records-3d-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 50%;
  background: linear-gradient(180deg, rgba(255,255,255,0.25), transparent);
  border-radius: 12px 12px 0 0;
  pointer-events: none;
}
.records-3d-btn:hover {
  filter: brightness(1.05);
}
.records-3d-btn:active {
  transform: translateY(4px);
  box-shadow:
    0 4px 0 #0e8c46,
    0 8px 16px rgba(30, 228, 132, 0.3);
  filter: brightness(0.95);
}

/* 轮播图模块 - 3D 卡片效果（带悬浮效果） */
.banner-swipe-wrapper {
  width: 100%;
  margin-bottom: 24px;
			    display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 16px;
}

.banner-swipe {
  width: 100%;
  height: 180px;
  position: relative;
  overflow: visible;
}

.banner-swipe :deep(.van-swipe__track) {
  display: flex;
  align-items: center;
  height: 100%;
  overflow: visible;
}

.banner-swipe :deep(.van-swipe-item) {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 0 8px;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: visible;
}

.banner-item {
  width: 100%;
  height: 100%;
  transform: scale(0.85);
  opacity: 0.6;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  filter: blur(1px);
}

.banner-item.active {
  transform: scale(1);
  opacity: 1;
  z-index: 2;
  filter: blur(0);
}

.banner-card {
  width: 100%;
  height: 100%;
  border-radius: 16px;
  overflow: hidden;
	    position: relative;
  box-shadow: 
    0 12px 32px rgba(0, 0, 0, 0.4),
    0 6px 16px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
  background: rgba(30, 30, 38, 0.9);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.banner-item.active .banner-card {
  box-shadow: 
    0 16px 40px rgba(17, 180, 17, 0.3),
    0 8px 20px rgba(0, 0, 0, 0.4),
    0 0 0 1px rgba(17, 180, 17, 0.2) inset;
}

.banner-image {
	    width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(20, 20, 25, 0.5);
  border-radius: 16px;
}

.banner-image :deep(.van-image__img) {
  width: 100%;
  height: 100%;
  object-fit: contain;
  border-radius: 16px;
}

.banner-image :deep(img) {
  width: 100%;
  height: 100%;
  object-fit: contain;
  border-radius: 16px;
}

.banner-overlay {
		    position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.7));
  padding: 16px 14px 12px;
  border-radius: 0 0 16px 16px;
}

.banner-title {
  font-size: 15px;
  font-weight: 700;
		    color: #fff;
  margin-bottom: 4px;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

.banner-desc {
  font-size: 12px;
  color: rgba(255, 255, 255, 0.8);
  line-height: 1.4;
  text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
}

/* 指示器样式优化 */
.banner-swipe :deep(.van-swipe__indicators) {
  bottom: 8px;
}

.banner-swipe :deep(.van-swipe__indicator) {
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.3);
  margin: 0 3px;
  transition: all 0.3s ease;
}

.banner-swipe :deep(.van-swipe__indicator--active) {
  width: 20px;
  border-radius: 3px;
  background: #11b411;
  box-shadow: 0 0 8px rgba(17, 180, 17, 0.6);
}

/* 玻璃拟态卡片 - 合并 Today Income 和 Account Balance */
.glass-stats-card {
  background: rgba(255, 255, 255, 0.05);
  backdrop-filter: blur(15px);
  -webkit-backdrop-filter: blur(15px);
  border: 0.5px solid rgba(255, 255, 255, 0.1);
  border-radius: 20px;
  margin-bottom: 24px;
  overflow: hidden;
			position: relative;
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 
    0 8px 32px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.05) inset;
}

.glass-stats-card.income-beat {
  border-color: rgba(30, 199, 101, 0.3);
  box-shadow: 
    0 0 30px rgba(30, 199, 101, 0.2),
    0 8px 32px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(30, 199, 101, 0.15) inset;
  animation: card-beat 0.9s ease;
}

.glass-card-content {
  padding: 20px;
}

.stat-row {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}

.stat-info {
  flex: 1;
  min-width: 0;
}

.stat-label {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  font-size: 13px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.7);
  margin-bottom: 4px;
  letter-spacing: 0.2px;
}

.stat-desc {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  font-size: 11px;
  color: rgba(255, 255, 255, 0.45);
  line-height: 1.4;
}

.stat-amount {
  display: flex;
  flex-direction: column;
  align-items: flex-end;
  gap: 2px;
  position: relative;
}

.amount-value {
  font-family: 'Inter', 'Din Alternate', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 32px;
  font-weight: 700;
  color: #fff;
  line-height: 1.2;
  letter-spacing: -0.5px;
  display: inline-flex;
  align-items: baseline;
}

.amount-value.income-beat {
  color: #1ed760;
  animation: value-beat 0.9s ease;
  text-shadow: 0 0 12px rgba(30, 199, 101, 0.5);
}

.amount-unit {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 10px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.5);
  letter-spacing: 0.5px;
  text-transform: uppercase;
  margin-top: -2px;
}

.stat-divider {
  height: 1px;
  background: linear-gradient(90deg, 
    transparent, 
    rgba(255, 255, 255, 0.08), 
    transparent
  );
  margin: 16px 0;
}

.balance-row {
  margin-top: 0;
}

.music-eq {
  display: flex;
  align-items: flex-end;
  gap: 2px;
  margin-top: 8px;
  height: 20px;
}

.music-eq .bar {
  width: 3px;
  background: linear-gradient(180deg, #1ed760, rgba(30, 199, 101, 0.6));
  border-radius: 2px;
  animation: eq-bounce 0.8s ease-in-out infinite;
}

.music-eq .bar.b1 { animation-delay: 0s; }
.music-eq .bar.b2 { animation-delay: 0.1s; }
.music-eq .bar.b3 { animation-delay: 0.2s; }
.music-eq .bar.b4 { animation-delay: 0.3s; }
.music-eq .bar.b5 { animation-delay: 0.4s; }

/* 专业金融风格按钮 - 深色背景+绿色流光边框 */
.main-btn.premium-btn {
  position: relative;
  z-index: 950;
  flex-shrink: 0;
				width: 100%;
  height: 56px;
  margin-top: 24px;
  margin-bottom: 16px;
  padding: 0;
				border: none;
  border-radius: 16px;
  background: rgba(15, 15, 20, 0.95);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  overflow: hidden;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: 
    0 4px 16px rgba(0, 0, 0, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.05) inset;
}

.main-btn.premium-btn::before {
  content: '';
  position: absolute;
  inset: 0;
  border-radius: 16px;
  padding: 1px;
  background: linear-gradient(135deg, 
    rgba(17, 180, 17, 0.6),
    rgba(30, 199, 101, 0.4),
    rgba(17, 180, 17, 0.6)
  );
  background-size: 200% 200%;
  -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
  -webkit-mask-composite: xor;
  mask-composite: exclude;
  animation: border-glow 3s ease-in-out infinite;
  z-index: 0;
}

.btn-content {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  height: 100%;
  padding: 0 24px;
}

.btn-text {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
				font-size: 16px;
  font-weight: 600;
				color: #fff;
  letter-spacing: 0.3px;
}

.btn-count {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: rgba(255, 255, 255, 0.6);
}

.btn-glow {
  position: absolute;
  inset: -2px;
  border-radius: 16px;
  background: linear-gradient(135deg, 
    rgba(17, 180, 17, 0.3),
    rgba(30, 199, 101, 0.2)
  );
  filter: blur(12px);
  opacity: 0;
  transition: opacity 0.3s ease;
  z-index: -1;
}

.main-btn.premium-btn:hover:not(:disabled) .btn-glow {
  opacity: 0.6;
}

.main-btn.premium-btn:hover:not(:disabled) {
  transform: translateY(-1px);
  box-shadow: 
    0 6px 20px rgba(0, 0, 0, 0.5),
    0 0 0 1px rgba(255, 255, 255, 0.08) inset,
    0 0 30px rgba(17, 180, 17, 0.2);
}

.main-btn.premium-btn:active:not(:disabled) {
  transform: translateY(0);
}

.main-btn.premium-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

.main-btn.premium-btn.loading {
  pointer-events: none;
}

.btn-loading {
			    position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2;
  background: rgba(15, 15, 20, 0.8);
}

@keyframes border-glow {
  0%, 100% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
}

/* 呼吸灯动画效果 */
.breathing-btn {
  animation: breathing 2s ease-in-out infinite;
}

.breathing-btn::before {
  content: '';
		    position: absolute;
  inset: -2px;
  border-radius: 30px;
  background: linear-gradient(135deg, rgba(17, 180, 17, 0.6), rgba(30, 215, 96, 0.6));
  z-index: -1;
  opacity: 0;
  animation: breathing-glow 2s ease-in-out infinite;
  filter: blur(8px);
}

.breathing-btn:active:not(:disabled) {
  transform: scale(0.98);
  animation: none;
}

.breathing-btn:disabled {
  animation: none;
  opacity: 0.6;
}

@keyframes breathing {
  0%, 100% {
    box-shadow: 
      0 8px 24px rgba(17, 180, 17, 0.4),
      0 4px 12px rgba(0, 0, 0, 0.3),
      0 0 0 0 rgba(17, 180, 17, 0.7);
  }
  50% {
    box-shadow: 
      0 8px 24px rgba(17, 180, 17, 0.5),
      0 4px 12px rgba(0, 0, 0, 0.3),
      0 0 0 8px rgba(17, 180, 17, 0);
  }
}

@keyframes breathing-glow {
  0%, 100% {
    opacity: 0;
    transform: scale(1);
  }
  50% {
    opacity: 0.6;
    transform: scale(1.05);
  }
}

.bottom-eq {
  position: fixed;
			    left: 50%;
  transform: translateX(-50%);
  bottom: 0;
				width: 100%;
  max-width: 520px;
  height: 210px;
  overflow: hidden;
  overflow-x: hidden;
  border-radius: 0;
  border: none;
  background: transparent;
  z-index: 900; /* 在内容之上、导航之下 */
  pointer-events: none;
}
.bottom-eq img {
			    width: 100%;
			    height: 100%;
  object-fit: cover;
  display: block;
}
.task-popup {
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(8px);
}
.task-popup-main {
  background: linear-gradient(145deg, rgba(25, 25, 32, 0.98), rgba(18, 18, 24, 0.98));
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 20px;
  padding: 0;
  width: 400px;
  max-width: 90vw;
  max-height: 90vh;
  overflow: hidden;
  overflow-x: hidden;
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
  color: #fff;
  box-sizing: border-box;
  position: relative;
}
.task-popup-main::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: linear-gradient(90deg, 
    transparent, 
    rgba(255, 255, 255, 0.15), 
    rgba(255, 255, 255, 0.25), 
    rgba(255, 255, 255, 0.15), 
    transparent
  );
  pointer-events: none;
  border-radius: 20px 20px 0 0;
}
.task-popup-main::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 20px;
  background: linear-gradient(135deg, 
    rgba(255, 255, 255, 0.05) 0%, 
    transparent 50%, 
    rgba(0, 0, 0, 0.1) 100%
  );
  pointer-events: none;
}

.task-popup-content {
  flex: 1;
  overflow-y: auto;
  overflow-x: hidden;
  min-height: 0;
}
.popup-header {
			display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 16px 20px 14px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  width: 100%;
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  flex-shrink: 0;
}
.popup-title {
  font-size: 18px;
  font-weight: 700;
				color: #fff;
  white-space: nowrap;
  overflow: hidden;
  overflow-x: hidden;
  text-overflow: ellipsis;
				flex: 1;
}
.close-icon {
  font-size: 20px;
  color: rgba(255, 255, 255, 0.6);
  cursor: pointer;
  transition: color 0.2s, transform 0.2s;
  flex-shrink: 0;
  margin-left: 12px;
}
.close-icon:hover {
  color: #fff;
  transform: scale(1.1);
}
.close-icon:active {
  transform: scale(0.95);
}

.album-section {
			display: flex;
  gap: 16px;
  padding: 16px 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  width: 100%;
  box-sizing: border-box;
  position: relative;
  z-index: 1;
}
.album-cover {
  width: 100px;
  height: 100px;
  border-radius: 12px;
  overflow: hidden;
  overflow-x: hidden;
  flex-shrink: 0;
  box-shadow: 
    0 8px 20px rgba(0, 0, 0, 0.4),
    0 4px 10px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}
.album-cover :deep(.van-image) {
  width: 100%;
  height: 100%;
}
.album-info {
				flex: 1;
  display: flex;
  flex-direction: column;
  justify-content: center;
  min-width: 0;
  max-width: calc(100% - 116px);
  overflow: hidden;
  overflow-x: hidden;
}
.album-artist {
  font-size: 14px;
  color: #11b411;
  font-weight: 600;
  margin-bottom: 8px;
  white-space: nowrap;
  overflow: hidden;
  overflow-x: hidden;
  text-overflow: ellipsis;
  width: 100%;
}
.album-title {
				font-size: 18px;
				font-weight: 700;
  color: #fff;
  line-height: 1.3;
  word-break: break-word;
  overflow-wrap: break-word;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
  overflow-x: hidden;
  width: 100%;
  max-width: 100%;
}

.financial-section {
  padding: 14px 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  display: flex;
  flex-direction: column;
  gap: 12px;
  width: 100%;
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  flex-shrink: 0;
}
.financial-item {
			display: flex;
			justify-content: space-between;
  align-items: center;
  gap: 12px;
  width: 100%;
}
.financial-label {
				font-size: 14px;
  color: rgba(255, 255, 255, 0.7);
  white-space: nowrap;
  flex-shrink: 0;
  max-width: 50%;
  overflow: hidden;
  overflow-x: hidden;
  text-overflow: ellipsis;
}
.financial-value {
  font-size: 18px;
  font-weight: 700;
  color: #fff;
  white-space: nowrap;
  flex-shrink: 0;
  margin-left: auto;
}

.rating-section {
  padding: 14px 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
				display: flex;
  flex-direction: column;
  gap: 16px;
  width: 100%;
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  flex-shrink: 0;
}
.rating-item {
  display: flex;
  justify-content: space-between;
				align-items: center;
  gap: 12px;
  width: 100%;
}
.rating-label {
  font-size: 15px;
  color: rgba(255, 255, 255, 0.9);
  font-weight: 500;
  white-space: nowrap;
  flex-shrink: 0;
  margin-right: 12px;
  max-width: 40%;
  overflow: hidden;
  overflow-x: hidden;
  text-overflow: ellipsis;
}
.star-rating {
  display: flex;
  gap: 8px;
  flex-shrink: 0;
  align-items: center;
}
.star {
  font-size: 28px;
  color: rgba(255, 255, 255, 0.25);
  cursor: pointer;
  transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  user-select: none;
				line-height: 1;
  flex-shrink: 0;
  width: 28px;
  height: 28px;
  text-align: center;
  position: relative;
  filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
  text-shadow: 
    0 1px 2px rgba(0, 0, 0, 0.5),
    0 -1px 1px rgba(255, 255, 255, 0.1);
}
.star.active {
  color: #ffd700;
  filter: drop-shadow(0 0 8px rgba(255, 215, 0, 0.6)) drop-shadow(0 2px 6px rgba(255, 215, 0, 0.4));
  text-shadow: 
    0 0 12px rgba(255, 215, 0, 0.8),
    0 0 20px rgba(255, 215, 0, 0.4),
    0 2px 4px rgba(0, 0, 0, 0.5),
    0 -1px 2px rgba(255, 255, 255, 0.2);
  transform: scale(1.05);
}
.star:hover {
  transform: scale(1.15);
  filter: drop-shadow(0 0 6px rgba(255, 255, 255, 0.3)) drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
}
.star.active:hover {
  transform: scale(1.2);
  filter: drop-shadow(0 0 12px rgba(255, 215, 0, 0.8)) drop-shadow(0 0 20px rgba(255, 215, 0, 0.5)) drop-shadow(0 2px 6px rgba(255, 215, 0, 0.4));
}

.comment-section {
  padding: 14px 20px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
  width: 100%;
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  flex-shrink: 0;
}
.comment-label {
  font-size: 15px;
  color: rgba(255, 255, 255, 0.9);
  font-weight: 500;
			margin-bottom: 10px;
  width: 100%;
}
.comment-input {
  width: 100%;
  min-height: 60px;
  max-height: 80px;
  padding: 10px 12px;
  background: rgba(30, 30, 35, 0.85);
  border: 1px solid rgba(255, 255, 255, 0.12);
  border-radius: 10px;
  color: #fff;
  font-size: 16px !important;
  font-family: inherit;
  resize: vertical;
  box-sizing: border-box;
  transition: all 0.2s;
  box-shadow: 
    0 2px 8px rgba(0, 0, 0, 0.2) inset,
    0 1px 2px rgba(255, 255, 255, 0.05) inset;
  max-width: 100%;
}
.comment-input:focus {
  outline: none;
  border-color: rgba(17, 180, 17, 0.5);
  background: rgba(30, 30, 35, 0.95);
  box-shadow: 
    0 0 0 3px rgba(17, 180, 17, 0.15),
    0 2px 8px rgba(0, 0, 0, 0.2) inset,
    0 1px 2px rgba(255, 255, 255, 0.05) inset;
}
.comment-input::placeholder {
  color: rgba(255, 255, 255, 0.4);
}

.btn-box {
  padding: 16px 20px 20px;
				display: flex;
  flex-direction: column;
  gap: 0;
  width: 100%;
  box-sizing: border-box;
  position: relative;
  z-index: 1;
  flex-shrink: 0;
  background: linear-gradient(145deg, rgba(25, 25, 32, 0.98), rgba(18, 18, 24, 0.98));
  border-top: 1px solid rgba(255, 255, 255, 0.08);
}
.submit-btn {
  width: 100%;
  height: 50px;
  background: linear-gradient(135deg, #11b411, #1ed760);
  border: none;
  border-radius: 12px;
  color: #fff;
  font-size: 16px;
  font-weight: 700;
  box-shadow: 
    0 8px 20px rgba(17, 180, 17, 0.4),
    0 4px 8px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset,
    0 1px 0 rgba(255, 255, 255, 0.2) inset;
  transition: all 0.2s;
  position: relative;
}
.submit-btn::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 50%;
  background: linear-gradient(180deg, rgba(255, 255, 255, 0.15), transparent);
  border-radius: 12px 12px 0 0;
  pointer-events: none;
}
.submit-btn:active {
  transform: translateY(2px);
  box-shadow: 
    0 4px 12px rgba(17, 180, 17, 0.3),
    0 2px 4px rgba(0, 0, 0, 0.3),
    0 0 0 1px rgba(255, 255, 255, 0.1) inset;
}

.color-red {
  color: #ff4444 !important;
}
.ft-h {
  height: 20px;
}

/* 交易成功弹窗 - 横向布局 */
.success-popup {
  background: rgba(0, 0, 0, 0.75);
  backdrop-filter: blur(8px);
}
.success-popup-main {
  background: linear-gradient(145deg, rgba(30, 30, 38, 0.98), rgba(20, 20, 28, 0.98));
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 16px;
  padding: 20px 24px;
  width: auto;
  min-width: 320px;
  max-width: 90%;
				display: flex;
					align-items: center;
  gap: 20px;
  box-shadow: 
    0 20px 50px rgba(0, 0, 0, 0.6),
    0 10px 25px rgba(0, 0, 0, 0.4),
    0 0 0 1px rgba(255, 255, 255, 0.08) inset,
    0 0 0 2px rgba(0, 0, 0, 0.3) inset,
    0 8px 20px rgba(0, 0, 0, 0.4) inset,
    0 -2px 8px rgba(255, 255, 255, 0.03) inset;
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  position: relative;
					overflow: hidden;
  overflow-x: hidden;
  animation: success-popup-enter 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.success-popup-main::before {
  content: '';
						position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 1px;
  background: linear-gradient(90deg, 
    transparent, 
    rgba(30, 199, 101, 0.3), 
    rgba(30, 199, 101, 0.5), 
    rgba(30, 199, 101, 0.3), 
    transparent
  );
  pointer-events: none;
}
.success-popup-main::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  border-radius: 16px;
  background: linear-gradient(135deg, 
    rgba(255, 255, 255, 0.04) 0%, 
    transparent 50%, 
    rgba(0, 0, 0, 0.1) 100%
  );
  pointer-events: none;
}
@keyframes success-popup-enter {
  0% {
    opacity: 0;
    transform: scale(0.9) translateY(10px);
  }
  100% {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

.success-left {
  flex-shrink: 0;
				display: flex;
				align-items: center;
  justify-content: center;
}
.success-icon {
						display: flex;
  justify-content: center;
						align-items: center;
}
.success-checkmark {
  width: 60px;
  height: 60px;
  position: relative;
  animation: checkmark-scale 0.4s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s both;
}
.checkmark-circle {
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: linear-gradient(135deg, #1ed760, #11b411);
  box-shadow: 
    0 0 25px rgba(30, 199, 101, 0.6),
    0 6px 16px rgba(30, 199, 101, 0.4),
    inset 0 2px 6px rgba(255, 255, 255, 0.2);
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
}
.checkmark-circle::after {
  content: '✓';
  font-size: 32px;
  color: #fff;
  font-weight: bold;
  line-height: 1;
  text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
  animation: checkmark-fade-in 0.3s ease 0.4s both;
}
.checkmark-stem {
  display: none;
}
.checkmark-kick {
  display: none;
}
@keyframes checkmark-scale {
  0% {
    transform: scale(0);
    opacity: 0;
  }
  50% {
    transform: scale(1.1);
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}
@keyframes checkmark-fade-in {
  0% {
    opacity: 0;
    transform: scale(0.5);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

.success-right {
  flex: 1;
  min-width: 0;
				display: flex;
  flex-direction: column;
				justify-content: center;
}
.success-title {
  font-size: 18px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 8px;
  text-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
  word-break: keep-all;
  animation: fade-in-right 0.4s ease 0.2s both;
}
.success-profit {
  display: flex;
  align-items: baseline;
  gap: 6px;
  white-space: nowrap;
  animation: fade-in-right 0.4s ease 0.3s both;
}
.profit-label {
  font-size: 13px;
  color: rgba(255, 255, 255, 0.7);
}
.profit-value {
  font-size: 17px;
  font-weight: 700;
  color: #1ed760;
  text-shadow: 0 0 12px rgba(30, 199, 101, 0.4);
}
@keyframes fade-in-right {
  from {
    opacity: 0;
    transform: translateX(-10px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}
@keyframes fade-in-up {
  from {
    opacity: 0;
    transform: translateY(10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@media (max-width: 430px) {
  .success-popup-main {
    width: 92%;
    padding: 14px 16px;
    gap: 14px;
  }
  .success-checkmark {
    width: 50px;
    height: 50px;
  }
  .checkmark-circle {
    width: 50px;
    height: 50px;
  }
  .checkmark-circle::after {
    font-size: 28px;
  }
  .success-title {
    font-size: 16px;
    margin-bottom: 6px;
  }
  .profit-label {
    font-size: 12px;
  }
  .profit-value {
    font-size: 15px;
  }
}
@media (max-width: 677px) {
  .task-popup-main {
    max-height: 85vh;
    width: 92%;
  }
  .main-btn {
    z-index: 950;
    position: relative;
  }
}
@media (max-width: 600px) {
  .trade-main {
    padding: 16px 12px 80px;
  }
  .banner-swipe {
    height: 160px;
  }
  .banner-item {
    transform: scale(0.8);
  }
  .banner-item.active {
    transform: scale(1);
  }
  .stat-cell {
    padding: 14px !important;
    margin-bottom: 10px;
  }
  .stat-value {
    font-size: 24px;
  }
  .stat-cell:deep(.van-cell__title) {
    font-size: 12px !important;
  }
  .stat-cell:deep(.van-cell__label) {
    font-size: 10px !important;
  }
  .main-btn {
    font-size: 16px !important;
    margin-top: 20px;
    margin-bottom: 12px;
    height: 52px !important;
    border-radius: 26px !important;
  }
  .bottom-eq {
    height: 220px;
  }
  .records-3d-btn {
    padding: 8px 16px;
    font-size: 14px;
    border-radius: 10px;
    box-shadow:
      0 6px 0 #0e8c46,
      0 10px 20px rgba(30, 228, 132, 0.35);
  }
  .records-3d-btn:active {
    transform: translateY(3px);
    box-shadow:
      0 3px 0 #0e8c46,
      0 6px 12px rgba(30, 228, 132, 0.3);
  }
  .task-popup-main {
    max-height: 85vh;
    width: 92%;
  }
}
@media (max-width: 430px) {
  .trade-main {
    padding: 14px 10px;
    padding-top: max(14px, env(safe-area-inset-top, 0px));
    padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  }
  .banner-swipe {
    width: 85%;
    height: 140px;
  }
  .banner-item {
    transform: scale(0.75);
  }
  .banner-item.active {
    transform: scale(1);
  }
  .banner-card {
    border-radius: 12px;
  }
  .banner-image :deep(.van-image__img),
  .banner-image :deep(img) {
    border-radius: 12px;
    object-fit: contain;
  }
  .banner-overlay {
    padding: 12px 10px 10px;
    border-radius: 0 0 12px 12px;
  }
  .banner-title {
    font-size: 13px;
  }
  .banner-desc {
    font-size: 11px;
  }
  .stat-cell {
    padding: 12px !important;
    border-radius: 10px !important;
    margin-bottom: 8px;
  }
  .stat-value {
    font-size: 22px;
  }
  .stat-cell:deep(.van-cell__title) {
    font-size: 12px !important;
    margin-bottom: 6px !important;
  }
  .stat-cell:deep(.van-cell__label) {
    font-size: 10px !important;
    margin-top: 4px !important;
  }
  .earnings-cell.income-beat {
    box-shadow: 
      0 0 15px rgba(30, 199, 101, 0.3),
      0 4px 12px rgba(0, 0, 0, 0.2) !important;
  }
  .main-btn {
    margin-top: 16px;
    margin-bottom: 10px;
    height: 50px !important;
    font-size: 15px !important;
    border-radius: 25px !important;
  }
  .music-eq {
    margin-top: 6px;
    height: 16px;
  }
  .music-eq .bar {
    width: 3px;
  }
  @keyframes eq-bounce {
    0%, 100% { height: 3px; opacity: 0.7; }
    50% { height: 14px; opacity: 1; }
  }
  .bottom-eq {
    height: 200px;
    max-width: 100%;
  }
  .task-popup-main {
    width: 95%;
    max-width: 95vw;
    border-radius: 16px;
  }
  .popup-header {
    padding: 16px 16px 12px;
  }
  .popup-title {
    font-size: 16px;
  }
  .album-section {
    padding: 16px;
    gap: 12px;
  }
  .album-cover {
    width: 80px;
    height: 80px;
  }
  .album-artist {
    font-size: 13px;
  }
  .album-title {
    font-size: 16px;
  }
  .popup-header {
    padding: 14px 16px 12px;
  }
  .album-section {
    padding: 14px 16px;
  }
  .financial-section,
  .rating-section,
  .comment-section {
    padding: 12px 16px;
  }
  .financial-section {
    gap: 10px;
  }
  .rating-section {
    gap: 14px;
  }
  .financial-label,
  .rating-label,
  .comment-label {
    font-size: 14px;
  }
  .financial-value {
    font-size: 16px;
  }
  .star {
    font-size: 26px;
    width: 26px;
    height: 26px;
  }
  .star-rating {
    gap: 6px;
  }
  .comment-input {
    min-height: 56px;
    max-height: 72px;
    padding: 8px 10px;
  }
  .btn-box {
    padding: 14px 16px 16px;
    flex-shrink: 0;
  }
  .submit-btn {
    height: 46px;
    font-size: 15px;
  }
  .task-popup-content {
    flex: 1;
    min-height: 0;
    overflow-y: auto;
  }
}

/* 收益特效：迷你音乐均衡器 */
.music-eq {
  margin-top: 8px;
  display: inline-flex;
  gap: 4px;
  height: 20px;
  align-items: flex-end;
  justify-content: flex-end;
}
.music-eq .bar {
  width: 4px;
  background: linear-gradient(180deg, #1ed760, #11b411);
  border-radius: 2px;
  animation: eq-bounce 1s infinite ease-in-out;
  filter: drop-shadow(0 0 4px rgba(30, 199, 101, 0.7));
}
.music-eq .b1 { animation-delay: 0s; }
.music-eq .b2 { animation-delay: 0.1s; }
.music-eq .b3 { animation-delay: 0.2s; }
.music-eq .b4 { animation-delay: 0.3s; }
.music-eq .b5 { animation-delay: 0.4s; }
@keyframes eq-bounce {
  0%, 100% { height: 4px; opacity: 0.7; }
  50% { height: 16px; opacity: 1; }
}

@keyframes card-beat {
  0% { transform: translateY(0) scale(1); }
  25% { transform: translateY(-3px) scale(1.03); }
  55% { transform: translateY(-1px) scale(1.01); }
  100% { transform: translateY(0) scale(1); }
}
@keyframes value-beat {
  0% { transform: scale(1); text-shadow: 0 0 0 rgba(30,199,101,0); }
  28% { transform: scale(1.12); text-shadow: 0 0 20px rgba(30,199,101,0.8); }
  55% { transform: scale(1.05); text-shadow: 0 0 10px rgba(30,199,101,0.5); }
  100% { transform: scale(1); text-shadow: 0 0 0 rgba(30,199,101,0); }
	}
	
</style>

