<template>
  <div class="user-wrapper">
    <div class="user-bg-blur"></div>
    <div class="user-bg-mask"></div>
    <div class="user-wrapper-main">
      <div class="user-card">
        <div class="user-info">
          <img :src="data.userInfo?.avatar ?? avatarImg" alt="avatar" />
          <div class="info-text">
            <div class="account">
              {{ displayAccount }}
              <van-icon name="shield-o" class="verified" />
            </div>
            <div class="sub">
              {{ t('home.credit') || '信用评分' }}：{{ data.userInfo?.credit_score ?? '--' }}
            </div>
          </div>
        </div>

        <div class="stat-list">
          <div class="stat-item">
            <div class="stat-label">{{ $t('login.invite') }}</div>
            <div class="stat-value copyable" @click="copyValue(data.userInfo?.invite)">
              {{ data.userInfo?.invite || '--' }}
            </div>
          </div>
          <div class="stat-item">
            <div class="stat-label">{{ $t('mine.today_profit') || '本轮收益(USD)' }}</div>
            <div class="stat-value">{{ formatAmount(data.userInfo?.task_revenue ?? data.userInfo?.today_profit ?? 0) }}</div>
          </div>
          <div class="stat-item">
            <div class="stat-label">{{ $t('mine.available') }} (USD)</div>
            <div class="stat-value">{{ formatAmount(data.userInfo?.balance ?? 0) }}</div>
          </div>
        </div>
      </div>

      <div class="menu-card">
        <div class="menu-item" v-for="(item,index) in navList" :key="index" @click="handleNav(item)">
          <div class="left">
            <img v-if="item.icon" :src="item.icon" class="menu-icon" />
            <span>{{ item.name }}</span>
          </div>
          <span class="arrow">›</span>
        </div>
      </div>

      <div class="ft-button">
        <van-button type="black" class="logout" @click="onLogout()"> {{ $t('mine.logout') }} </van-button>
      </div>
    </div>
    <van-popup
      :show="data.withdraw_show"
      @update:show="data.withdraw_show = $event"
      class="withdraw-popup"
    >
      <div class="withdraw-popup-main">
        <div class="tip">{{t('mine.set_address')}}</div>
        <div class="input-box">
          <van-field class="address_withdraw" v-model="data.address_withdraw" :placeholder="t('mine.enter_address')"  />
        </div>
        <div class="btn-box">
          <van-button class="item" type="theme" :loading="data.loading"  @click="setAddress()">{{t('mine.set')}}</van-button>
          <van-button class="item btn2" type="red" @click="data.withdraw_show=false">{{t('mine.cancel')}}</van-button>
        </div>
      </div>
    </van-popup>
    
    <!-- 公告弹窗 -->
    <van-popup
      :show="data.notice_show"
      @update:show="(val) => (data.notice_show = val)"
      :close-on-click-overlay="false"
      :close-on-popstate="false"
      lock-scroll
      class="notice-popup"
    >
      <div class="notice-popup-main">
        <div class="notice-header">
          <div class="notice-title">{{ data.notice.title || '' }}</div>
        </div>
        <div class="notice-content">
          {{ data.notice.note || '' }}
        </div>
        <div class="notice-footer">
          <van-button class="notice-ok-btn" type="primary" @click="onNoticeConfirm">
            OK
          </van-button>
        </div>
      </div>
    </van-popup>
    
    <FooterTabbar active="user" />
    <!-- <Customer /> -->
  </div>
</template>

<script setup>
import { onMounted,ref,reactive,computed,onUnmounted } from 'vue'
import { showFailToast,showToast } from 'vant'
import { i18n } from "@/i18n"
import { useUserStore } from '@/stores/user'
import { useRouter } from 'vue-router'
import { userInfoApi,setAddressWithdrawApi,noticeApi,noticeSeeApi,tradingInfoApi } from "@/api/public"
import FooterTabbar from '@/components/FooterTabbar.vue'
// import Customer from '@/components/Customer.vue'
import avatarImg from '@/assets/ico_avatar.png'
import { useWebSocket } from '@/utils/useWebSocket'
import { formatAmount } from '@/utils/common'
import { useTimer } from '@/composables/useTimer'

const { websocket, isConnected } = useWebSocket();
if(!isConnected){
  websocket.init();
}
const {t} = i18n.global; 
const userStore = useUserStore();
const router    = useRouter();
const data = reactive({
  loading: false,
  userInfo: userStore.userInfo,
  withdraw_show: false,
  address_withdraw: '',
  notice: { title: '', note: '', uid: '' },
  notice_show: false,
})
const creditFetched = ref(false)

// 显示账号信息：优先显示手机号，如果没有手机号则显示邮箱
const displayAccount = computed(() => {
  const info = data.userInfo
  if (!info) return t('login.mobile') || '--'
  
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
  return info.username || info.account || t('login.mobile') || '--'
})

if(userStore.userInfo?.address_withdraw){
  data.address_withdraw = userStore.userInfo.address_withdraw;
}

const navList = computed(() => {
  return [
    { name: t('mine.withdraw'), url: '/withdraw', icon: '/images/mine/records.png' },
    { name: t('mine.recharge'), url: '/recharge', icon: '/images/mine/pass.png' },
    { name: t('mine.records'), url: '/records', icon: '/images/mine/records.png' },
    { name: t('tabBar.team'), url: '/team', icon: '/images/mine/team.png' },
    { name: t('mine.withdraw_address') || t('mine.withdraw'), url: '/withdraw', icon: '/images/mine/security.png' },
    // { name: t('mine.kyc') || 'KYC', url: '/authenticator', icon: '/images/mine/security.png' },
    { name: t('mine.safepass'), url: '/securitypin', icon: '/images/mine/security.png' },
    { name: t('lang.lang_switch'), url: '/lang', icon: '/images/dq.png' },
    { name: t('mine.customer_service') || '客服', action: 'kf', icon: '/images/server.png' },
    
  ]
})

// 使用 composable 管理定时器
const { start: startTimer, stop: stopTimer } = useTimer(() => {
  updateUser()
}, 5000, 'timerId')

// 退出登录
const onLogout = () => {
  userStore.logout()
  router.push({path:'/login'});
}

const goLink = (item) => {
  router.push({ path: item.url });
}

const handleNav = (item) => {
  if (item.action === 'kf') {
    router.push('/customer-service');
    return;
  }
  if (item.url === '/withdraw') {
    onWithdraw();
    return;
  }
  if (item.url) {
    goLink(item)
  }
}

const copyValue = async (val) => {
  if (!val) {
    showFailToast('No content to copy');
    return;
  }
  try {
    await navigator.clipboard.writeText(val);
    showToast('Copy success');
  } catch (e) {
    const textarea = document.createElement('textarea');
    textarea.value = val;
    textarea.setAttribute('readonly', '');
    textarea.style.position = 'absolute';
    textarea.style.left = '-9999px';
    document.body.appendChild(textarea);
    textarea.select();
    const ok = document.execCommand('copy');
    document.body.removeChild(textarea);
    ok ? showToast('Copy success') : showFailToast('Copy failed');
  }
}


const onWithdraw =()=>{
  if(data.userInfo?.address_withdraw){
    router.push({path:'/withdraw'});
  }else{
    data.withdraw_show = true
  }
  return false
}

const setAddress =()=>{
  if(!data.address_withdraw){
    showFailToast(t('mine.enter_address'))
    return false
  }
  setAddressWithdrawApi({ address:data.address_withdraw }).then(res=>{
    showToast(res.msg)
    updateUser()
    data.withdraw_show = false
  }).catch(e=>{
    showFailToast(e.msg)
  })
}

const updateUser = () => {
  userInfoApi()
    .then((res) => {
      const merged = { ...data.userInfo, ...res.data }
      // 保留已获取的信用分，避免闪烁
      if (!merged.credit_score && data.userInfo?.credit_score) {
        merged.credit_score = data.userInfo.credit_score
      }
      data.userInfo = merged
      userStore.updateUserInfo(merged)
      if (!creditFetched.value) {
        fetchCreditScore()
      }
    })
    .catch((e) => {
      console.log(e)
    })
}

const fetchCreditScore = async () => {
  try {
    const res = await tradingInfoApi()
    const credit_score = res?.data?.credit_score
    const credit_usdt = res?.data?.credit_usdt
    const credit_tips = res?.data?.credit_tips
    const task_revenue = res?.data?.task_revenue
    const merged = {
      ...data.userInfo,
      credit_score,
      credit_usdt,
      credit_tips,
      task_revenue
    }
    data.userInfo = merged
    userStore.updateUserInfo(merged)
    creditFetched.value = true
  } catch (e) {
    console.log(e)
  }
}

const updated =()=>{
  noticeApi().then(res=>{
    if (res.data && res.data.title && res.data.note) {
      data.notice = res.data;
      data.notice_show = true;
    }
  }).catch(e=>{
    console.log(e);
  })
}

const onNoticeConfirm = () => {
  if (data.notice.uid) {
    noticeSeeApi({uid: data.notice.uid}).catch(e => {
      console.log(e);
    });
  }
  data.notice_show = false;
  data.notice = { title: '', note: '', uid: '' };
}

onMounted(() => {
  // 如果未登录
  if (!userStore.isAuthenticated) {
    userStore.logout()
  }
  updateUser();
  updated();
  
  const refreshTimerId = localStorage.getItem('timerId');
  clearInterval(refreshTimerId);
  const timerId = setInterval(function(){
    updateUser();
  }, 5000)
  localStorage.setItem('timerId', timerId);
})

onUnmounted(()=>{
  const refreshTimerId = localStorage.getItem('timerId');
  clearInterval(refreshTimerId);
})
</script>
<style scoped lang="scss">
.user-wrapper{
  position: relative;
  min-height: 100dvh;
  background: #000;
  overflow: hidden;
  overflow-x: hidden;
  color: #fff;
}
.user-bg-blur{
  position: fixed;
  inset: 0;
  background: url('/images/bg-page.png') center/cover no-repeat;
  filter: blur(14px);
  opacity: 0.7;
  z-index: 0;
}
.user-bg-mask{
  position: fixed;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0.75), rgba(0,0,0,0.92));
  z-index: 1;
}
.user-wrapper-main{
  position: relative;
  z-index: 2;
  padding: 16px;
  padding-top: max(16px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  max-width: 620px;
  margin: 0 auto;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
}
.top-actions{
  display: flex;
  justify-content: flex-end;
  margin-bottom: 8px;
}
.lang-select-box{ position: relative; z-index: 3; }

.user-card{
  background: linear-gradient(150deg, rgba(255,255,255,0.1), rgba(255,255,255,0.04));
  border: 1px solid rgba(255,255,255,0.14);
  box-shadow: 0 16px 36px rgba(0,0,0,0.32);
  border-radius: 18px;
  padding: 20px;
  margin-bottom: 16px;
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
}
.user-info{
  display: flex;
  align-items: center;
  gap: 14px;
}
.user-info img{
  width: 72px;
  height: 72px;
  border-radius: 50%;
  border: 3px solid #fff;
  object-fit: cover;
  box-shadow: 0 2px 12px rgba(102,126,234,0.12);
}
.info-text{
  display: flex;
  flex-direction: column;
  gap: 6px;
}
.account{
  font-size: 18px;
  font-weight: 700;
  color: #f0e8e8;
  display: flex;
  align-items: center;
  gap: 6px;
}
.account .verified{ color: #1ec765; font-size: 18px; }
.sub{
  font-size: 13px;
  color: #cfd6ff;
}

.balances{
  display: none;
}
.stat-list{
  display: grid;
  grid-template-columns: repeat(3,1fr);
  gap: 12px;
  margin-top: 16px;
}
.stat-item{
  background: linear-gradient(150deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 14px;
  padding: 12px 8px;
  text-align: center;
  box-shadow: 0 10px 24px rgba(0,0,0,0.24);
  min-width: 0;
  overflow: hidden;
}
.stat-label{
  font-size: 12px;
  color: #cfd6ff;
  margin-bottom: 6px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.stat-value{
  font-size: 19px;
  font-weight: 800;
  color: #ffdd55;
  word-break: break-all;
  overflow-wrap: break-word;
  line-height: 1.2;
  max-width: 100%;
  overflow: hidden;
}
.copyable{ cursor: pointer; }

.menu-card{
  background: linear-gradient(145deg, rgba(255,255,255,0.06), rgba(255,255,255,0.02));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 16px;
  box-shadow: 0 12px 30px rgba(0,0,0,0.26);
  overflow: hidden;
  overflow-x: hidden;
  margin-top: 12px;
  backdrop-filter: blur(10px);
}
.menu-item{
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 14px 16px;
  border-bottom: 1px solid rgba(255,255,255,0.07);
  cursor: pointer;
  transition: background 0.2s ease;
}
.menu-item:last-child{ border-bottom: none; }
.menu-item:hover{ background: rgba(255,255,255,0.06); }
.menu-item .left{ display: flex; align-items: center; gap: 10px; font-size: 15px; color: #fff; font-weight: 700; }
.menu-icon{ width: 22px; height: 22px; object-fit: contain; filter: drop-shadow(0 0 6px rgba(0,0,0,0.35)); }
.arrow{ color: #fff; font-size: 18px; }

.ft-button{ margin: 18px 0 20px 0; }
.ft-button .logout{
  width: 100%;
  border: none;
  border-radius: 12px;
  background: linear-gradient(135deg, #313131, #1c1c1c) !important;
  color: #fff !important;
  font-weight: 700;
  box-shadow: 0 12px 26px rgba(0,0,0,0.35);
}

.notice-popup {
  :deep(.van-popup) {
    background: transparent;
  }
}

.notice-popup-main {
  background: linear-gradient(145deg, rgba(25, 25, 32, 0.98), rgba(18, 18, 24, 0.98));
  border: 1px solid rgba(255, 255, 255, 0.15);
  border-radius: 20px;
  padding: 0;
  width: 400px;
  max-width: 90vw;
  max-height: 85vh;
  overflow: hidden;
  overflow-x: hidden;
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
  display: flex;
  flex-direction: column;
}

.notice-popup-main::before {
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

.notice-popup-main::after {
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

.notice-header {
  padding: 20px 24px 16px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  position: relative;
  z-index: 1;
}

.notice-title {
  font-size: 18px;
  font-weight: 700;
  color: #fff;
  text-align: center;
  line-height: 1.4;
}

.notice-content {
  padding: 20px 24px;
  font-size: 15px;
  line-height: 1.6;
  color: rgba(255, 255, 255, 0.9);
  flex: 1;
  overflow-y: auto;
  position: relative;
  z-index: 1;
  white-space: pre-wrap;
  word-break: break-word;
}

.notice-footer {
  padding: 16px 24px 20px;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  position: relative;
  z-index: 1;
}

.notice-ok-btn {
  width: 100%;
  height: 44px;
  background: linear-gradient(135deg, #11b411, #1ed760);
  border: none;
  border-radius: 12px;
  color: #fff;
  font-size: 16px;
  font-weight: 700;
  box-shadow: 
    0 4px 12px rgba(17, 180, 17, 0.3),
    0 2px 6px rgba(0, 0, 0, 0.2);
  transition: all 0.2s;
  
  &:active {
    transform: scale(0.98);
    box-shadow: 
      0 2px 8px rgba(17, 180, 17, 0.25),
      0 1px 4px rgba(0, 0, 0, 0.2);
  }
}

@media (max-width: 600px) {
  .notice-popup-main {
    width: 90vw;
    border-radius: 16px;
  }
  
  .notice-header {
    padding: 18px 20px 14px;
  }
  
  .notice-title {
    font-size: 16px;
  }
  
  .notice-content {
    padding: 16px 20px;
    font-size: 14px;
  }
  
  .notice-footer {
    padding: 14px 20px 18px;
  }
  
  .notice-ok-btn {
    height: 42px;
    font-size: 15px;
  }
}

.withdraw-popup{
  background: rgba(0,0,0,0.5);
  color: #fff;
  .withdraw-popup-main{
    width: 320px;
    background: #1c1c1c;
    border-radius: 10px;
    padding: 20px;
    .tip{
      color: #fff;
      font-size: 16px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .input-box{
      margin: 10px 0 20px 0;
      .van-cell{
        background: #000;
        color: #fff;
        border-radius: 8px;
      }
    }
    .btn-box{
      display: flex;
      align-items: center;
      .item{
        flex: 1;
        margin-right: 10px;
        &:last-child{ margin-right: 0; }
      }
      .btn2{
        background: rgba(255,255,255,0.12);
        color: #fff;
      }
    }
  }
}

@media (max-width: 600px){
  .user-wrapper-main{ padding: 16px 12px calc(96px + env(safe-area-inset-bottom, 0px)); }
  .balances{ grid-template-columns: 1fr; }
  .stat-list{
    gap: 8px;
  }
  .stat-item{
    padding: 10px 6px;
  }
  .stat-label{
    font-size: 11px;
  }
  .stat-value{ 
    font-size: 16px; 
    line-height: 1.3;
  }
}
</style>
