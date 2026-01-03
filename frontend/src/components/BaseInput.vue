<template>
  <div class="auth-input">
    <div
      v-if="prefix"
      class="auth-input-prefix"
      :class="{ clickable: prefixClickable }"
      @click="prefixClickable && emit('prefix-click')"
    >
      {{ prefix }}
    </div>
    <van-field
      class="auth-input-field"
      v-bind="$attrs"
      :model-value="modelValue"
      @update:model-value="val => emit('update:modelValue', val)"
      :type="actualType"
      :placeholder="placeholder"
      :clearable="false"
    >
      <template #right-icon v-if="togglePassword">
        <span class="auth-input-eye" @click.stop="toggle">
          <van-icon name="eye" v-if="actualType === 'password'" />
          <van-icon name="closed-eye" v-else />
        </span>
      </template>
    </van-field>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
  modelValue: [String, Number],
  placeholder: { type: String, default: '' },
  type: { type: String, default: 'text' },
  prefix: { type: String, default: '' },
  prefixClickable: { type: Boolean, default: false },
  togglePassword: { type: Boolean, default: false }
})

const emit = defineEmits(['update:modelValue'])

const innerType = ref(props.type)
const actualType = computed(() => {
  if (props.togglePassword) return innerType.value
  return props.type
})

const toggle = () => {
  innerType.value = innerType.value === 'password' ? 'text' : 'password'
}
</script>

<style scoped lang="scss">
.auth-input {
  display: flex;
  align-items: center;
  border-radius: 12px;
  background: rgba(255, 255, 255, 0.10);
  padding: 0 12px;
  min-height: 52px;
  transition: box-shadow 0.2s ease;
  width: 100%;
  box-sizing: border-box;
  border: none;
}

.auth-input:focus-within {
  box-shadow: 0 0 0 2px rgba(30, 199, 101, 0.25);
}

.auth-input-prefix {
  white-space: nowrap;
  color: #fff;
  font-size: 14px;
  margin-right: 12px;
  padding-right: 12px;
  border-right: 1px solid rgba(255, 255, 255, 0.2);
  line-height: 52px;
  &.clickable {
    cursor: pointer;
  }
}

.auth-input-field {
  width: 100%;
  background: transparent;
  padding: 0;

  .van-field__control {
    color: #fff;
    font-size: 16px !important;
  }

  .van-field__control::placeholder {
    color: #888;
  }

  .van-field__body {
    background: transparent;
  }
}

.auth-input-eye {
  color: #fff;
  display: inline-flex;
  align-items: center;
  cursor: pointer;
}
</style>

