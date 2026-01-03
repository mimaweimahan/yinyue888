<template>
  <div class="login-top-icons">
    <img :src="serverIcon" alt="server" @click="emit('server')" />
    <img :src="langIcon" alt="lang" @click="emit('lang')" />
    <img :src="downloadIcon" alt="download" @click="emit('download')" />
  </div>
</template>

<script setup>
const props = defineProps({
  serverIcon: { type: String, default: '/images/server.png' },
  langIcon: { type: String, default: '/images/dq.png' },
  downloadIcon: { type: String, default: '/images/download.png' }
})
const emit = defineEmits(['server', 'lang', 'download'])
</script>

<style scoped lang="scss">
.login-top-icons {
  position: absolute;
  top: 18px;
  right: 18px;
  display: flex;
  gap: 8px;
  z-index: 3;
}

.login-top-icons img {
  width: 22px;
  height: 22px;
  background: rgba(255, 255, 255, 0.10);
  border-radius: 11px;
  box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.10);
  object-fit: contain;
  padding: 3px;
  display: block;
  filter: brightness(10);
  transition: background 0.2s;
  cursor: pointer;
}

.login-top-icons img:hover {
  background: rgba(255, 255, 255, 0.22);
}
</style>

