<template>
  <div class="footer-nav">
    <div
      v-for="item in items"
      :key="item.key"
      class="nav-item"
      :class="[{ active: item.key === props.active }, { large: item.large }]"
      @click="go(item)"
    >
      <div class="icon-wrap">
        <img :src="item.icon" :alt="item.label" />
      </div>
      <span class="label">{{ item.label }}</span>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRouter } from 'vue-router';
import { i18n } from '@/i18n';

const { t } = i18n.global
const router  = useRouter();
const props = defineProps({
  active: {
    type: String,
    default: 'home'
  }
})

const items = computed(() => ([
  {
    key: 'home',
    label: t('tabBar.home') || '首页',
    icon: '/images/tabbar/BG-019.png',
    route: '/'
  },
  {
    key: 'trade',
    label: t('tabBar.trade') || '抢单',
    icon: '/images/tabbar/2.png',
    route: '/trade',
    large: true
  },
  {
    key: 'user',
    label: t('tabBar.profile') || t('tabBar.mine') || '我的',
    icon: '/images/tabbar/BG-021.png',
    route: '/user'
  }
]))

const go = (item) => {
  if (item.route) {
    router.push({ path: item.route })
  }
}
</script>

<style scoped lang="scss">
.footer-nav{
  position: fixed;
  left: 0;
  right: 0;
  bottom: 0;
  min-height: 70px;
  padding: 8px 12px;
  padding-bottom: max(8px, env(safe-area-inset-bottom, 0px));
  padding-top: max(8px, env(safe-area-inset-top, 0px));
  background: linear-gradient(180deg, 
    rgba(20, 20, 25, 0.95) 0%,
    rgba(15, 15, 20, 0.98) 100%
  );
  backdrop-filter: blur(30px);
  -webkit-backdrop-filter: blur(30px);
  display: flex;
  justify-content: space-around;
  align-items: flex-start;
  z-index: 1000;
  box-shadow: 
    0 -4px 20px rgba(0, 0, 0, 0.5),
    0 -2px 10px rgba(0, 0, 0, 0.3),
    inset 0 1px 0 rgba(255, 255, 255, 0.1);
  border-top: 1px solid rgba(255, 255, 255, 0.08);
  
  &::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg,
      transparent,
      rgba(255, 255, 255, 0.15),
      rgba(255, 255, 255, 0.25),
      rgba(255, 255, 255, 0.15),
      transparent
    );
  }
}

.nav-item{
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  color: rgba(255, 255, 255, 0.6);
  gap: 4px;
  flex: 1;
  cursor: pointer;
  padding: 8px;
  min-height: 44px;
  border-radius: 12px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  -webkit-tap-highlight-color: transparent;
  
  &:active {
    transform: scale(0.95);
    background: rgba(255, 255, 255, 0.05);
  }
  
  &.active {
    color: #fff;
    
    .icon-wrap {
      transform: scale(1.1);
      filter: drop-shadow(0 2px 8px rgba(30, 199, 101, 0.4));
    }
    
    .label {
      color: #1ed760;
      font-weight: 600;
      text-shadow: 0 0 8px rgba(30, 199, 101, 0.3);
    }
    
    &::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 50%;
      transform: translateX(-50%);
      width: 24px;
      height: 3px;
      background: linear-gradient(90deg, transparent, #1ed760, transparent);
      border-radius: 2px;
      opacity: 0.8;
    }
  }
}

.nav-item.large{
  transform: translateY(-28px);
  
  .icon-wrap {
    background: linear-gradient(135deg, #11b411, #1ed760);
    box-shadow: 
      0 8px 20px rgba(17, 180, 17, 0.4),
      0 4px 10px rgba(0, 0, 0, 0.3),
      inset 0 1px 0 rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.1);
  }
  
  &.active .icon-wrap {
    box-shadow: 
      0 10px 25px rgba(17, 180, 17, 0.5),
      0 5px 12px rgba(0, 0, 0, 0.3),
      inset 0 1px 0 rgba(255, 255, 255, 0.25),
      0 0 20px rgba(17, 180, 17, 0.3);
    transform: scale(1.05);
    filter: drop-shadow(0 4px 12px rgba(30, 199, 101, 0.5));
  }
  
  &:active .icon-wrap {
    transform: scale(0.98);
  }
}

.icon-wrap{
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 8px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  
  &::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 8px;
    background: linear-gradient(135deg, 
      rgba(255, 255, 255, 0.1) 0%,
      transparent 50%,
      rgba(0, 0, 0, 0.1) 100%
    );
    pointer-events: none;
  }
}

.nav-item.large .icon-wrap{
  width: 64px;
  height: 64px;
  border-radius: 18px;
  
  &::before {
    border-radius: 18px;
  }
}

.icon-wrap img{
  width: 100%;
  height: 100%;
  object-fit: contain;
  position: relative;
  z-index: 1;
  filter: brightness(1.05);
  transition: filter 0.3s ease;
}

.nav-item.active .icon-wrap img {
  filter: brightness(1.2);
}

.label{
  font-size: 11px;
  line-height: 1.2;
  font-weight: 500;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  letter-spacing: 0.2px;
}

.nav-item.large .label {
  margin-top: 2px;
  font-size: 12px;
}

@media (max-width: 600px) {
  .footer-nav {
    min-height: 68px;
    padding: 6px 8px;
    padding-bottom: calc(6px + env(safe-area-inset-bottom, 0px));
  }
  
  .nav-item {
    padding: 6px;
    min-height: 44px;
    gap: 3px;
  }
  
  .icon-wrap {
    width: 24px;
    height: 24px;
  }
  
  .nav-item.large .icon-wrap {
    width: 56px;
    height: 56px;
  }
  
  .label {
    font-size: 10px;
  }
  
  .nav-item.large .label {
    font-size: 11px;
  }
  
  .nav-item.large {
    transform: translateY(-24px);
  }
}
</style>