<template>
  <div class="page-wrapper">
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
			<van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()"/>
			<div class="title"><span>{{t('mine.googleauth')}}</span></div>
		</section>
	</div>
  </div>
</template>
<script setup>
	import { ref } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { editPinApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
	
	const router = useRouter();
	const {t} = i18n.global; // 使用国际化配置语言
	const activeNames = ref(['1']);
	const goMine = () =>{
		router.push('/user');
	}
</script>	
<style scoped lang="scss">
	.page-wrapper{
		background-image: url('@/assets/help_bg_1.png'), url('@/assets/help_bg_2.png');
		background-repeat: no-repeat, no-repeat;
		background-size: 40%, 40%;
		background-position: 0 0, 100% 100%;
		background-color: #fff;
		min-height: 100dvh;
		overflow-x: hidden;
	}
	.page-wrapper-body {
		position: relative;
		z-index: 1;
		max-width: 520px;
		margin: 0 auto;
		padding: 14px 12px;
		padding-top: max(14px, env(safe-area-inset-top, 0px));
		padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
		min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
		overflow-x: hidden;
	}
	
</style>