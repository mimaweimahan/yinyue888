<template>
  <div 
    class="product-carousel"
    :style="{ 
      height: `${height}px`,
      backgroundColor: bgColor,
      borderRadius: borderRadius
    }"
  >
    <!-- 加载状态 -->
    <div v-if="isLoading" class="carousel-loading">
      <div class="carousel-loading__spinner"></div>
    </div>

    <!-- 空状态 -->
    <div v-else-if="!products.length" class="carousel-empty">
      <i class="carousel-empty__icon fas fa-box-open"></i>
      <p>{{ $t('common.nodata') }}</p>
    </div>

    <!-- 走马灯容器 -->
    <div v-else class="carousel-track-container" ref="trackContainer">
      <div 
        ref="track"
        class="carousel-track"
        :style="{ 
          transform: `translateX(${translateX}px)`,
          gap: `${gap}px`
        }"
      >
        <template v-for="(item, index) in displayedProducts" :key="item.key">
          <ProductCard 
            :product="item.product"
            :style="{ 
              width: `${width}px`,
              height: `${height}px`,
              margin: `0 ${gap/2}px`
            }"
            :last-item="index === displayedProducts.length - 1"
            @last-item-visible="handleLastItemVisible"
          />
        </template>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed, watch, nextTick } from 'vue';
import ProductCard from './ProductCard.vue';
// 接收父组件传入的产品数据和配置
const props = defineProps({
  products: {
    type: Array,
    default: () => []
  },
  width: {
    type: Number,
    default: 240,
  },
  height: {
    type: Number,
    default: 320,
  },
  gap: {
    type: Number,
    default: 12,
  },
  speed: {
    type: Number,
    default: 20,
  },
  bgColor: {
    type: String,
    default: '#f9fafb',
  },
  borderRadius: {
    type: String,
    default: '0.5rem',
  },
  isLoading: {
    type: Boolean,
    default: false,
  }
});

// 状态管理
const translateX = ref(0);
const animationFrameId = ref(null);
const lastTime = ref(0);
const track = ref(null);
const trackContainer = ref(null);
const displayedProducts = ref([]);
const groupCount = ref(0);
const maxGroups = 3; // 最大同时显示的产品组数量

// 计算单个产品实际占据宽度（含间隙）
const productWidthWithGap = computed(() => props.width + props.gap);

// 处理产品数据，添加价格计算
const processedProducts = computed(() => {
  return props.products.map(product => ({
    ...product,
    priceAfterDiscount: product.discount 
      ? parseFloat(product.price) * (1 - product.discount / 100) 
      : parseFloat(product.price)
  }));
});

// 初始化显示的产品
const initializeProducts = () => {
  displayedProducts.value = [];
  groupCount.value = 0;
  // 初始加载maxGroups组，确保有足够内容
  for (let i = 0; i < maxGroups; i++) {
    addNewGroup(i);
  }
  translateX.value = 0;
};

// 新增产品组
const addNewGroup = (groupIndex) => {
  if (processedProducts.value.length === 0) return;
  const newProducts = processedProducts.value.map((product, index) => ({
    product,
    key: `${product.id}-${groupIndex}-${index}` // 确保key唯一
  }));
  displayedProducts.value.push(...newProducts);
  groupCount.value++;
};

// 当最后一个产品可见时添加新组
const handleLastItemVisible = () => {
  if (processedProducts.value.length > 0) {
    addNewGroup(groupCount.value);
  }
};

// 检查并移除最早的产品组
const checkAndRemoveOldGroup = () => {
  if (groupCount.value > maxGroups) {
    const itemsToRemove = processedProducts.value.length;
    displayedProducts.value = displayedProducts.value.slice(itemsToRemove);
    groupCount.value--;
    // 调整滚动位置，实现视觉无缝衔接
    translateX.value += itemsToRemove * productWidthWithGap.value;
  }
};

// 滚动逻辑
const scroll = (timestamp) => {
  if (!track.value || !trackContainer.value) return;
  
  if (!lastTime.value) lastTime.value = timestamp;
  const deltaTime = timestamp - lastTime.value;
  
  if (deltaTime > props.speed) {
    translateX.value -= 1;
    lastTime.value = timestamp;
    
    // 当滚动距离超过一组宽度时重置位置
    const oneGroupWidth = processedProducts.value.length * productWidthWithGap.value;
    if (Math.abs(translateX.value) >= oneGroupWidth) {
      translateX.value += oneGroupWidth;
      checkAndRemoveOldGroup();
    }
  }
  
  animationFrameId.value = requestAnimationFrame(scroll);
};

// 开始滚动
const startScroll = () => {
  if (!animationFrameId.value && processedProducts.value.length > 0) {
    lastTime.value = 0;
    animationFrameId.value = requestAnimationFrame(scroll);
  }
};

// 停止滚动
const stopScroll = () => {
  if (animationFrameId.value) {
    cancelAnimationFrame(animationFrameId.value);
    animationFrameId.value = null;
  }
};

// 监听窗口焦点状态
const handleVisibilityChange = () => {
  if (document.hidden) {
    stopScroll();
  } else {
    startScroll();
  }
};

// 监听产品数据变化
watch(processedProducts, () => {
  initializeProducts();
  nextTick(startScroll);
});

// 监听尺寸变化
watch([() => props.width, () => props.height, () => props.gap], () => {
  nextTick(() => {
    stopScroll();
    translateX.value = 0;
    startScroll();
  });
});

// 组件生命周期
onMounted(() => {
  initializeProducts();
  startScroll();
  document.addEventListener('visibilitychange', handleVisibilityChange);
});

onUnmounted(() => {
  stopScroll();
  document.removeEventListener('visibilitychange', handleVisibilityChange);
});
</script>

<style scoped>
/* 走马灯容器样式 */
.product-carousel {
  position: relative;
  overflow: hidden;
}

/* 滚动轨道容器 */
.carousel-track-container {
  height: 100%;
  overflow: hidden;
}

/* 滚动轨道样式 */
.carousel-track {
  display: flex;
  height: 100%;
  transition: transform 0s ease-linear; /* 无过渡效果，实现无缝滚动 */
}

/* 隐藏滚动条但保留滚动功能 */
.carousel-track::-webkit-scrollbar {
  display: none;
}

.carousel-track {
  -ms-overflow-style: none;
  scrollbar-width: none;
}

/* 加载状态样式 */
.carousel-loading {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
  color: #6b7280;
}

.carousel-loading__spinner {
  width: 2rem;
  height: 2rem;
  border: 3px solid #e5e7eb;
  border-top-color: #3b82f6;
  border-radius: 50%;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

/* 空状态样式 */
.carousel-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100%;
  padding: 2rem;
  text-align: center;
  color: #6b7280;
}

.carousel-empty__icon {
  font-size: 3rem;
  margin-bottom: 1rem;
  color: #d1d5db;
}

/* 响应式调整 */
@media (max-width: 640px) {
  .product-carousel {
    border-radius: 0.5rem;
  }
}
</style>