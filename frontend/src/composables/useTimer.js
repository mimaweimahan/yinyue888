/**
 * 定时器 Composable
 * 统一管理定时器逻辑，自动清理
 */
import { ref, onUnmounted } from 'vue'

/**
 * 使用定时器
 * @param {Function} callback 回调函数
 * @param {number} interval 间隔时间（毫秒）
 * @param {string} storageKey localStorage 存储的 key（可选）
 */
export function useTimer(callback, interval = 5000, storageKey = null) {
  const timerId = ref(null)
  
  const start = () => {
    // 如果已有定时器，先清除
    stop()
    
    // 如果使用 localStorage 存储，先清除旧的
    if (storageKey) {
      const oldTimerId = localStorage.getItem(storageKey)
      if (oldTimerId) {
        clearInterval(Number(oldTimerId))
      }
    }
    
    // 创建新定时器
    const id = setInterval(callback, interval)
    timerId.value = id
    
    // 存储到 localStorage（如果需要）
    if (storageKey) {
      localStorage.setItem(storageKey, String(id))
    }
  }
  
  const stop = () => {
    if (timerId.value) {
      clearInterval(timerId.value)
      timerId.value = null
    }
    
    // 清除 localStorage 中的定时器 ID
    if (storageKey) {
      const storedId = localStorage.getItem(storageKey)
      if (storedId) {
        clearInterval(Number(storedId))
        localStorage.removeItem(storageKey)
      }
    }
  }
  
  // 组件卸载时自动清理
  onUnmounted(() => {
    stop()
  })
  
  return {
    timerId,
    start,
    stop
  }
}
