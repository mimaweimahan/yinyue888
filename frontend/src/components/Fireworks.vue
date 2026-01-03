<template>
    <canvas 
      :id="canvasId" 
      :width="canvasWidth" 
      :height="canvasHeight"
      :style="{ position: 'fixed', top: 0, left: 0, pointerEvents: 'none', zIndex }"
    ></canvas>
  </template>
  
  <script setup>
  import { ref, defineExpose, onUnmounted, computed } from 'vue';
  
  // 定义组件属性
  const props = defineProps({
    particleCount: {
      type: [Number, String],
      default: 200
    },
    angle: {
      type: [Number, String],
      default: 80
    },
    spread: {
      type: [Number, String],
      default: 100
    },
    startVelocity: {
      type: [Number, String],
      default: 80
    },
    decay: {
      type: [Number, String],
      default: 0.7
    },
    ticks: {
      type: [Number, String],
      default: 1000
    },
    zIndex: {
      type: [Number, String],
      default: 999999
    },
    colors: {
      type: Array,
      default: () => ["#5BC0EB", "#2176AE", "#FDE74C", "#9BC53D", "#E55934", "#FA7921", "#FF4242"]
    },
    canvasId: {
      type: String,
      default: "fireCanvas"
    },
    width: {
      type: [Number, String],
      default: () => window.innerWidth
    },
    height: {
      type: [Number, String],
      default: () => window.innerHeight
    },
    x: {
      type: [Number, String],
      default: () => window.innerWidth / 2
    },
    y: {
      type: [Number, String],
      default: () => 0.4 * window.innerHeight
    }
  });
  // 响应式变量
  const canvas = ref(null);
  const ctx = ref(null);
  const animationId = ref(null);
  const pixelRatio = ref(window.devicePixelRatio || 1);
  
  // 计算属性处理数字类型转换
  const particleCount = computed(() => Number(props.particleCount));
  const angle = computed(() => Number(props.angle));
  const spread = computed(() => Number(props.spread));
  const startVelocity = computed(() => Number(props.startVelocity));
  const decay = computed(() => Number(props.decay));
  const ticks = computed(() => Number(props.ticks));
  const zIndex = computed(() => Number(props.zIndex));
  const x = computed(() => Number(props.x));
  const y = computed(() => Number(props.y));
  const canvasWidth = computed(() => Number(props.width) * pixelRatio.value);
  const canvasHeight = computed(() => Number(props.height) * pixelRatio.value);
  
  // 辅助方法：16进制字符串转整数
  const parseInt16 = (str) => {
    return parseInt(str, 16);
  };
  
  // 初始化画布
  const initCanvas = () => {
    // 获取画布元素和上下文
    canvas.value = document.getElementById(props.canvasId);
    if (!canvas.value) {
      console.error(`Canvas element with id ${props.canvasId} not found`);
      return;
    }
    
    ctx.value = canvas.value.getContext('2d');
    
    // 设置画布尺寸（考虑设备像素比）
    canvas.value.width = canvasWidth.value;
    canvas.value.height = canvasHeight.value;
    
    // 缩放上下文以匹配设备像素比
    ctx.value.scale(pixelRatio.value, pixelRatio.value);
    
    // 开始绘制烟花
    drawFireworks();
  };
  
  // 绘制烟花效果
  const drawFireworks = () => {
    if (!ctx.value) return;
    
    // 创建粒子数组
    const particles = [];
    for (let i = 0; i < particleCount.value; i++) {
      const angleRad = angle.value * (Math.PI / 180);
      const spreadRad = spread.value * (Math.PI / 180);
      
      // 解析颜色
      let colorHex = props.colors[i % props.colors.length];
      colorHex = colorHex.replace(/[^0-9a-f]/gi, '');
      if (colorHex.length < 6) {
        colorHex = colorHex[0] + colorHex[0] + colorHex[1] + colorHex[1] + colorHex[2] + colorHex[2];
      }
      
      const color = {
        r: parseInt16(colorHex.substring(0, 2)),
        g: parseInt16(colorHex.substring(2, 4)),
        b: parseInt16(colorHex.substring(4, 6))
      };
      
      // 添加粒子
      particles.push({
        x: x.value,
        y: y.value,
        depth: 0.5 * Math.random() + 0.6,
        wobble: 10 * Math.random(),
        velocity: 0.5 * startVelocity.value + Math.random() * startVelocity.value,
        angle2D: -angleRad + (0.5 * spreadRad - Math.random() * spreadRad),
        tiltAngle: Math.random() * Math.PI,
        color,
        tick: 0,
        totalTicks: ticks.value,
        decay: decay.value,
        random: Math.random() + 5,
        tiltSin: 0,
        tiltCos: 0,
        wobbleX: 0,
        wobbleY: 0
      });
    }
    
    // 动画循环
    const animate = () => {
      if (!ctx.value) return;
      
      // 清除画布
      ctx.value.clearRect(0, 0, Number(props.width), Number(props.height));
      
      // 更新和绘制每个粒子
      const remainingParticles = particles.filter(particle => {
        // 更新粒子位置和状态
        particle.x += Math.cos(particle.angle2D) * particle.velocity;
        particle.y += Math.sin(particle.angle2D) * particle.velocity + 5 * particle.depth;
        particle.wobble += 0.1;
        particle.velocity *= particle.decay;
        particle.tiltAngle += 0.02 * Math.random() + 0.12;
        particle.tiltSin = Math.sin(particle.tiltAngle);
        particle.tiltCos = Math.cos(particle.tiltAngle);
        particle.random = Math.random() + 4;
        particle.wobbleX = particle.x + 10 * Math.cos(particle.wobble) * particle.depth;
        particle.wobbleY = particle.y + 10 * Math.sin(particle.wobble) * particle.depth;
        
        // 绘制粒子
        const alpha = 1 - particle.tick++ / particle.totalTicks;
        ctx.value.fillStyle = `rgba(${particle.color.r}, ${particle.color.g}, ${particle.color.b}, ${alpha})`;
        ctx.value.beginPath();
        ctx.value.moveTo(Math.floor(particle.x), Math.floor(particle.y));
        ctx.value.lineTo(
          Math.floor(particle.wobbleX), 
          Math.floor(particle.y + particle.random * particle.tiltSin)
        );
        ctx.value.lineTo(
          Math.floor(particle.wobbleX + particle.random * particle.tiltCos), 
          Math.floor(particle.wobbleY + particle.random * particle.tiltSin)
        );
        ctx.value.lineTo(
          Math.floor(particle.x + particle.random * particle.tiltCos), 
          Math.floor(particle.wobbleY)
        );
        ctx.value.closePath();
        ctx.value.fill();
        
        // 检查粒子是否应该继续存在
        return particle.tick < particle.totalTicks;
      });
      
      // 如果还有粒子，继续动画
      if (remainingParticles.length > 0) {
        animationId.value = requestAnimationFrame(animate);
      }
    };
    
    // 开始动画
    animationId.value = requestAnimationFrame(animate);
  };
  
  const startFireworks = () => {
    initCanvas();
  }

  // 组件卸载时清理
  onUnmounted(() => {
    if (animationId.value) {
      cancelAnimationFrame(animationId.value);
    }
  })

  defineExpose({
    startFireworks
  })
  </script>