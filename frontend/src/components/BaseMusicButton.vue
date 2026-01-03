<template>
  <button
    class="music-btn"
    :class="[{ disabled, loading }, size]"
    :disabled="disabled || loading"
    @click="$emit('click')"
  >
    <span class="music-bg"></span>
    <span class="music-border"></span>
    <span class="music-content">
      <span class="icon-wrap" v-if="$slots.icon">
        <slot name="icon" />
      </span>
      <span class="label">
        <slot />
      </span>
      <span class="pulse" aria-hidden="true"></span>
    </span>
  </button>
</template>

<script setup>
const props = defineProps({
  disabled: { type: Boolean, default: false },
  loading: { type: Boolean, default: false },
  size: {
    type: String,
    default: 'md', // sm | md | lg
    validator: (v) => ['sm', 'md', 'lg'].includes(v)
  }
})

defineEmits(['click'])
</script>

<style scoped lang="scss">
.music-btn {
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  padding: 12px 20px;
  border: none;
  border-radius: 999px;
  color: #fff;
  font-weight: 800;
  letter-spacing: 0.4px;
  overflow: hidden;
  cursor: pointer;
  background: transparent;
  transition: transform 0.15s ease, box-shadow 0.15s ease;
  isolation: isolate;
  user-select: none;

  &.sm { padding: 10px 16px; font-size: 13px; }
  &.md { font-size: 14px; }
  &.lg { padding: 14px 24px; font-size: 15px; }

+  &:active {
    transform: translateY(1px) scale(0.98);
  }

  &.disabled,
  &:disabled {
    cursor: not-allowed;
    opacity: 0.6;
  }

  .music-bg {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 20% 20%, rgba(30, 199, 101, 0.35), transparent 40%),
                radial-gradient(circle at 80% 50%, rgba(0, 122, 255, 0.35), transparent 40%),
                linear-gradient(135deg, #11b411, #0f8cff);
    filter: blur(0.5px);
    z-index: 1;
  }

  .music-border {
    position: absolute;
    inset: 0;
    border-radius: inherit;
    padding: 1px;
    background: linear-gradient(135deg, rgba(255,255,255,0.45), rgba(255,255,255,0));
    -webkit-mask:
      linear-gradient(#fff 0 0) content-box,
      linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    z-index: 2;
    opacity: 0.8;
  }

  .music-content {
    position: relative;
    z-index: 3;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 2px 4px;
    text-shadow: 0 2px 6px rgba(0,0,0,0.25);
  }

  .icon-wrap {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 18px;
    height: 18px;
  }

  .label {
    line-height: 1.2;
    white-space: nowrap;
  }

  .pulse {
    position: absolute;
    inset: 2px;
    border-radius: inherit;
    background: rgba(255,255,255,0.12);
    filter: blur(1px);
    animation: pulse 1.8s ease-in-out infinite;
    z-index: 1;
  }

  &:hover:not(.disabled):not(:disabled) {
    box-shadow: 0 10px 28px rgba(17, 180, 17, 0.18),
                0 4px 14px rgba(0, 122, 255, 0.16);
    transform: translateY(-1px);
  }

  &.loading {
    cursor: progress;
  }
}

@keyframes pulse {
  0%   { opacity: 0.45; transform: scale(1); }
  50%  { opacity: 0.8;  transform: scale(1.03); }
  100% { opacity: 0.45; transform: scale(1); }
}
</style>

