<template>
  <div class="auth-wrapper">
    <div class="auth-bg-blur" :style="bgImageStyle"></div>
    <div class="auth-bg-mask" :style="{ background: `rgba(0,0,0,${maskOpacity})` }"></div>
    <div class="auth-main">
      <slot name="top"></slot>
      <div class="auth-header" v-if="title || subtitle || desc">
        <div class="auth-title-main" v-if="title">{{ title }}</div>
        <div class="auth-title-sub" v-if="subtitle">{{ subtitle }}</div>
        <div class="auth-desc" v-if="desc">{{ desc }}</div>
      </div>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  title: { type: String, default: '' },
  subtitle: { type: String, default: '' },
  desc: { type: String, default: '' },
  background: { type: String, default: '/images/bg-page.png' },
  maskOpacity: { type: Number, default: 0.75 },
  blur: { type: String, default: '14px' }
})

const bgImageStyle = computed(() => ({
  backgroundImage: `url('${props.background}')`,
  filter: `blur(${props.blur})`
}))
</script>

<style scoped lang="scss">
.auth-wrapper {
  width: 100%;
  min-height: 100dvh;
  position: relative;
  overflow: hidden;
  overflow-x: hidden;
  background: #000;
  padding-top: env(safe-area-inset-top, 0px);
  padding-bottom: env(safe-area-inset-bottom, 0px);
}

.auth-bg-blur {
  position: fixed;
  inset: 0;
  z-index: 0;
  background-position: center;
  background-size: cover;
  background-repeat: no-repeat;
  opacity: 0.7;
}

.auth-bg-mask {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.75);
  z-index: 1;
}

.auth-main {
  position: relative;
  z-index: 2;
  width: 100%;
  max-width: 380px;
  margin: 0 auto;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 0 16px;
  padding-top: max(0px, env(safe-area-inset-top, 0px));
  padding-bottom: max(0px, env(safe-area-inset-bottom, 0px));
  box-sizing: border-box;
  font-family: "Montserrat", "Arial", "Helvetica Neue", Helvetica, sans-serif;
  overflow-x: hidden;
}

.auth-header {
  color: #fff;
  text-align: center;
  width: 100%;
  margin-bottom: 24px;
}

.auth-title-main {
  font-size: clamp(1.2rem, 6vw, 2.2rem);
  font-weight: 900;
  margin-bottom: 0;
  line-height: 1.1;
  letter-spacing: 2px;
}

.auth-title-sub {
  font-size: 1.1rem;
  font-weight: 700;
  margin: 12px 0 2px;
}

.auth-desc {
  font-size: 1rem;
  color: #e0e0e0;
  margin-top: 6px;
}

@media (max-width: 600px) {
  .auth-main {
    max-width: 100vw;
    padding: 0 4vw;
  }
}
</style>

