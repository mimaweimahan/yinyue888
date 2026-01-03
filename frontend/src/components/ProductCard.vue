<template>
  <div class="product-card" ref="cardRef">
    <div class="product-card__inner">
      <!-- 产品图片 -->
      <div class="product-card__image-container">
        <img 
          :src="product.image" 
          :alt="product.title"
          class="product-card__image"
        >
      </div>
      
      <!-- 产品信息 -->
      <div class="product-card__info">
        <div class="product-card__name">{{ product.title }}</div>
        <span class="product-card__price">${{ parseFloat(product.price).toFixed(2) }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, nextTick } from 'vue';

const props = defineProps({
  product: {
    type: Object,
    required: true,
  },
  lastItem: {
    type: Boolean,
    default: false,
  }
});

const emit = defineEmits(['last-item-visible']);
const cardRef = ref(null);
const observer = ref(null);

// 监听最后一个元素是否可见
const setupIntersectionObserver = () => {
  if (!props.lastItem || !cardRef.value) return;
  
  // 以轨道容器为根元素，扩大提前检测范围
  observer.value = new IntersectionObserver(
    (entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          emit('last-item-visible');
        }
      });
    },
    { 
      root: cardRef.value.parentElement?.parentElement,
      rootMargin: '500px 0px' // 提前500px检测
    }
  );
  
  observer.value.observe(cardRef.value);
};

onMounted(() => {
  // 确保DOM渲染完成后再初始化观察器
  nextTick(setupIntersectionObserver);
});

onUnmounted(() => {
  if (observer.value && cardRef.value) {
    observer.value.unobserve(cardRef.value);
  }
});
</script>

<style scoped>
/* 产品卡片样式 */
.product-card {
  flex-shrink: 0; /* 防止卡片被压缩 */
}

.product-card__inner { 
  overflow: hidden;
  height: 100%;
  display: flex;
  flex-direction: column;
  transition: all 0.3s ease;
  transform: translateY(0);
}

.product-card__inner:hover {
  transform: translateY(-2px);
}

/* 产品图片样式 */
.product-card__image-container {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  flex: 1; /* 图片区域占卡片剩余空间 */
  min-height: 0;
  overflow: hidden;
  border: 1px solid #ebebeb;
}

.product-card__image {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.product-card__inner:hover .product-card__image {
  transform: scale(1.05);
}

/* 产品信息样式 */
.product-card__info {
  padding: 3px 0;
  display: flex;
  flex-direction: column;
}

/* 产品名称样式 */
.product-card__name {
  color: #1f2937;
  overflow: hidden;
  padding: 5px 0;
  white-space: nowrap;
  text-overflow: ellipsis;
}


/* 价格样式 */

.product-card__price {
  color: #000;
  font-weight: 700;
  padding-top: 5px;
}

/* 触摸设备支持 */
@media (hover: none) {
  .product-card {
    scroll-snap-align: start;
  }
  
  .product-card__inner:hover {
    transform: none;
  }
}
</style>