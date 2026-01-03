<template>
  <div class="page-wrapper">
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
			<van-icon name="arrow-left" class="icon-box" size="18"  @click="goMine()"/>
			<div class="title"><span>{{t('mine.safepass')}}</span></div>
		</section>
		<section class="forms">
			<div class="form_step_box">
				<div class="form-group">
					<div class="label-text">{{t('login.otranpass')}}</div>
					<div class="form-control">
						<van-field class="account" type="password" v-model="data.otranpass" :placeholder="t('login.otranpass_tip')" />
					</div>
				</div>
				<div class="form-group">
					<div class="label-text">{{t('login.ntranpass')}}</div>
					<div class="form-control">
						<van-field class="account" type="password" v-model="data.ntranpass" :placeholder="t('login.ntranpass_tip')" />
					</div>
				</div>
				<div class="form-group">
					<div class="label-text">{{t('login.ctranpass')}}</div>
					<div class="form-control">
						<van-field class="account" type="password" v-model="data.ctranpass" :placeholder="t('login.ctranpass_tip')" />
					</div>
				</div>
				<div class="form_btn">
					<van-button class="btn" type="theme" :loading="data.loading"  @click="doSubmit()">{{ t('common.save') }}</van-button>
				</div>
			</div>
		</section>
	</div>
  </div>
</template>
<script setup>
	import { reactive } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { editPinApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
	
	const router = useRouter();
	const {t} = i18n.global; // 使用国际化配置语言
	
	const data = reactive({
		'loading':false,
		'otranpass':'',
		'ntranpass':'',
		'ctranpass':''
	})
	
	const goMine = () =>{
		router.push('/user');
	}
	
	const doSubmit=()=>{
		if(!data.otranpass){
			showFailToast( t('serverCodes.802') )
			return false
		}
		if(!data.ntranpass){
			showFailToast( t('serverCodes.802') )
			return false
		}
		if(!data.ctranpass || data.ntranpass!=data.ctranpass){
			showFailToast( t('serverCodes.803') )
			return false
		}
		
		data.loading = true;
		editPinApi({
			'otranpass':data.otranpass,
			'ntranpass':data.ntranpass,
			'ctranpass':data.ctranpass
		}).then(res=>{
			showSuccessToast(res.msg);
			data.otranpass = '';
			data.ntranpass = '';
			data.ctranpass = '';
			data.loading = false;
		}).catch(e=>{
			data.loading = false;
			showFailToast(e.msg)
		})
	}
</script>	
<style scoped lang="scss">
	.page-wrapper{
		background-image: url('@/assets/help_bg_1.png'), url('@/assets/help_bg_2.png');
		background-repeat: no-repeat, no-repeat;
		background-size: 40%, 40%;
		background-position: 0 0, 100% 100%;
		background-color: #fff;
		min-height: 100vh;
	}
</style>
