<template>
  <div class="page-wrapper">
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
			<van-icon name="arrow-left" class="icon-box" size="18"  @click="goMine()"/>
			<div class="title"><span>{{t('faq.title')}}</span></div>
		</section>
		<div class="banner">
			<img src="@/assets/help_top.png" width="100%"/>
		</div>
		<div class="help-box">
			<van-collapse v-model="activeNames" accordion>
				
			  <van-collapse-item :title="t('faq.Q1')" name="1">
			    {{t('faq.A1')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q2')" name="2">
			    {{t('faq.A2')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q3')" name="3">
			     <p>{{t('faq.A31')}}</p>
			     <p>{{t('faq.A32')}}</p>
			     <p>{{t('faq.A33')}}</p>
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q4')" name="4">
			    {{t('faq.A4')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q5')" name="5">
			    {{t('faq.A5')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q6')" name="6">
			    {{t('faq.A6')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q7')" name="7">
			    {{t('faq.A7')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q8')" name="8">
			    {{t('faq.A8')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q9')" name="9">
			    {{t('faq.A9')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q10')" name="10">
			    {{t('faq.A10')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q11')" name="11">
			    {{t('faq.A11')}}
			  </van-collapse-item>
			  
			  <van-collapse-item :title="t('faq.Q12')" name="12">
			    {{t('faq.A12')}}
			  </van-collapse-item>
			  
			</van-collapse>
		</div>
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
	if (window.history.length > 1) {
		router.back();
	} else {
		router.push('/');
	}
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
	.help-box{
		padding: 15px;
	}
	.van-collapse-item{
		box-shadow: 2px 4px 20px hsla(0, 0%, 46.3%, .2);
		border-radius: 5px !important;
		margin: 20px 0;
		overflow: hidden;
		.van-cell{
			border-radius: 5px !important;
		}
	}
</style>