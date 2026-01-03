<template>
  <van-button
    class="auth-btn-primary"
    type="default"
    :native-type="nativeType"
    :loading="loading"
    v-bind="$attrs"
  >
    <slot>{{ text }}</slot>
  </van-button>
</template>

<script setup>
defineProps({
  text: { type: String, default: '' },
  nativeType: { type: String, default: 'button' },
  loading: { type: Boolean, default: false }
})
</script>

<style scoped lang="scss">
.auth-btn-primary {
  width: 100% !important;
  background: #1ec765 !important;
  border: none !important;
  font-size: 16px !important;
  font-weight: 600 !important;
  color: #ffffff !important;
  height: 52px !important;
  border-radius: 12px !important;
  line-height: 52px !important;
  transition: background 0.2s ease !important;
  font-family: "Montserrat", "Arial", "Helvetica Neue", Helvetica, sans-serif !important;

  &:hover:not(:disabled) {
    background: #19b85a !important;
  }
}
</style>

