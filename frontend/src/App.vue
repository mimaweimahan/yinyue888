<template>
  <router-view v-slot="{ Component, route }">
    <BasePageTransition>
      <KeepAlive include="IndexPage">
        <component :is="Component" :key="route.fullPath" />
      </KeepAlive>
    </BasePageTransition>
  </router-view>
</template>
<script setup>
import { onMounted, onUnmounted } from 'vue';
import { useUserStore } from '@/stores/user'
import { useWebSocket } from '@/utils/useWebSocket';
import config from '@/config'
import BasePageTransition from '@/components/BasePageTransition.vue'
import { KeepAlive } from 'vue'
const userStore = useUserStore()
// 初始化WebSocket连接
const { websocket } = useWebSocket(config.baseWsUrl);
// 组件挂载时初始化WebSocket
onMounted(() => {
  websocket.init();
});
// 组件卸载时清理WebSocket连接和计时器
onUnmounted(() => {
   websocket.close();
});
</script>
<style lang="scss">
	/* #ifdef H5 */
	body::-webkit-scrollbar,
	html::-webkit-scrollbar {
		display: none;
	}

	/* #endif */
	
	html, body {
		height: 100%;
		overflow-x: hidden;
		width: 100%;
	}
	
	#app {
		min-height: 100dvh;
		width: 100%;
		overflow-x: hidden;
		/* 大屏幕缩放适配 */
		@media (min-width: 768px) {
			width: 430px;
			margin: 0 auto;
			transform-origin: center top;
		}
		
		/* 横屏适配 - 提示用户旋转屏幕 */
		@media (orientation: landscape) and (max-height: 500px) {
			&::before {
				content: '请将设备旋转至竖屏模式以获得最佳体验';
				position: fixed;
				top: 0;
				left: 0;
				right: 0;
				bottom: 0;
				background: rgba(0, 0, 0, 0.95);
				color: #fff;
				display: flex;
				align-items: center;
				justify-content: center;
				font-size: 18px;
				text-align: center;
				padding: 20px;
				z-index: 9999;
				backdrop-filter: blur(10px);
			}
		}
		
		/* 超小屏幕适配（< 320px） */
		@media (max-width: 320px) {
			font-size: 14px;
		}
	}
	
	view {
		box-sizing: border-box;
	}

	::-webkit-scrollbar {
		width: 0;
		height: 0;
		color: transparent;
	}

	:root {
		--van-toast-default-width: auto;
		--van-toast-default-min-height: auto;
		--van-primary-color: #11B411;
		--van-toast-text-color: #fff;
		--van-toast-loading-icon-color: #11B411;
		--van-toast-success-icon-color: #11B411;
		--van-toast-background: rgba(30, 30, 38, 0.95);
	}

	/* 优化 Toast 样式 */
	.van-toast {
		background: linear-gradient(145deg, rgba(30, 30, 38, 0.98), rgba(20, 20, 28, 0.98)) !important;
		border: 1px solid rgba(255, 255, 255, 0.15) !important;
		border-radius: 16px !important;
		padding: 16px 24px !important;
		backdrop-filter: blur(20px) !important;
		-webkit-backdrop-filter: blur(20px) !important;
		box-shadow: 
			0 20px 50px rgba(0, 0, 0, 0.6),
			0 10px 25px rgba(0, 0, 0, 0.4),
			0 0 0 1px rgba(255, 255, 255, 0.08) inset,
			0 0 0 2px rgba(0, 0, 0, 0.3) inset !important;
		min-width: 120px !important;
		font-size: 15px !important;
		font-weight: 500 !important;
		color: #fff !important;
		animation: toast-enter 0.3s cubic-bezier(0.34, 1.56, 0.64, 1) !important;
	}

	.van-toast--loading {
		box-shadow: 
			0 20px 50px rgba(17, 180, 17, 0.3),
			0 10px 25px rgba(0, 0, 0, 0.4),
			0 0 0 1px rgba(17, 180, 17, 0.2) inset,
			0 0 0 2px rgba(0, 0, 0, 0.3) inset !important;
		border-color: rgba(17, 180, 17, 0.3) !important;
	}

	.van-toast--success {
		box-shadow: 
			0 20px 50px rgba(17, 180, 17, 0.3),
			0 10px 25px rgba(0, 0, 0, 0.4),
			0 0 0 1px rgba(17, 180, 17, 0.2) inset,
			0 0 0 2px rgba(0, 0, 0, 0.3) inset !important;
		border-color: rgba(17, 180, 17, 0.3) !important;
	}

	.van-toast--fail {
		box-shadow: 
			0 20px 50px rgba(255, 68, 68, 0.3),
			0 10px 25px rgba(0, 0, 0, 0.4),
			0 0 0 1px rgba(255, 68, 68, 0.2) inset,
			0 0 0 2px rgba(0, 0, 0, 0.3) inset !important;
		border-color: rgba(255, 68, 68, 0.3) !important;
	}

	.van-toast--fail .van-toast__icon {
		color: #ff4444 !important;
	}

	.van-toast__text {
		color: #fff !important;
		text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
	}

	.van-toast__icon {
		color: #11B411 !important;
		font-size: 36px !important;
	}

	.van-loading__spinner {
		color: #11B411 !important;
	}

	.van-loading__spinner--spinner {
		color: #11B411 !important;
	}

	@keyframes toast-enter {
		0% {
			opacity: 0;
			transform: scale(0.9) translateY(-10px);
		}
		100% {
			opacity: 1;
			transform: scale(1) translateY(0);
		}
	}

	/* 移动端优化 */
	@media (max-width: 430px) {
		.van-toast {
			padding: 14px 20px !important;
			font-size: 14px !important;
			border-radius: 14px !important;
		}
		.van-toast__icon {
			font-size: 32px !important;
		}
	}

	/* 主题相关样式 */
	[data-theme="dark"] {
		--color-background: var(--vt-c-black);
		--color-background-soft: var(--vt-c-black-soft);
		--color-background-mute: var(--vt-c-black-mute);
		--color-border: var(--vt-c-divider-dark-2);
		--color-border-hover: var(--vt-c-divider-dark-1);
		--color-heading: var(--vt-c-text-dark-1);
		--color-text: var(--vt-c-text-dark-2);

	}

	.page-container {
		width: 100%;
		margin: 0 auto;
	}

	.ft-h {
		height: 90px;
	}

	.page-wrapper-header {
		width: 100%;
		height: 46px;
		text-align: center;
		font-size: 16px;
		display: flex;
		align-items: center;

		.icon-box {
			width: 50px;
		}

		.title {
			display: flex;
			align-items: center;
			justify-content: center;
			flex: 1;
			overflow: hidden;
			height: 100%;

			span {
				margin-right: 50px;
			}
		}
	}

	.forms {
		padding: 24px 0;
		width: 100%;

		.form_step_box {
			padding: 20px;

			.form-group {
				margin-bottom: 20px;
				position: relative;
				box-sizing: border-box;

				.label-text {
					font-size: 14px;
					font-weight: 500;
					line-height: 21px;
					margin-bottom: 8px;
				}

				.form-control {
					border-radius: 4px;
					border: 1px solid #333;
					width: 100%;
					min-height: 45px;
					display: inline-block;
					color: #191d32;
					font-size: 14px;
					font-weight: 400;
					padding: 0 12px;
					line-height: 38px;
					background-color: #fff;
					box-sizing: border-box;

					.van-cell {
						padding: 10px 5px;
					}
				}
			}
		}

		.form_btn {

			.btn {
				width: 100%;
			}
		}
	}
</style>