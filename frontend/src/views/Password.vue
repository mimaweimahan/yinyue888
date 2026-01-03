<template>
  <div class="page-wrapper">
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
			<van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()"/>
			<div class="title"><span>{{t('mine.loginpass')}}</span></div>
		</section>
		<section class="forms">
			<div class="form_step_box">
				<div class="form-group">
					<div class="label-text">{{t('login.opassword')}}</div>
					<div class="form-control">
						<van-field class="account" type="password" v-model="data.opassword" :placeholder="t('login.password_tip')" />
					</div>
				</div>
				<div class="form-group">
					<div class="label-text">{{t('login.npassword')}}</div>
					<div class="form-control">
						<van-field class="account" type="password" v-model="data.password" :placeholder="t('login.npassword_tip')" />
					</div>
				</div>
				<div class="form-group">
					<div class="label-text">{{t('login.cpassword')}}</div>
					<div class="form-control">
						<van-field class="account" type="password" v-model="data.password2" :placeholder="t('login.cpassword_tip')" />
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
	import { onMounted, reactive } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { editPassApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
	
	const router = useRouter();
	const {t} = i18n.global; // 使用国际化配置语言
	
	const data = reactive({
		'loading':false,
		'opassword':'',
		'password':'',
		'password2':''
	})
	
	const goMine = () =>{
		router.push('/user');
	}
	
	const doSubmit=()=>{
		if(!data.opassword){
			showFailToast( t('serverCodes.802') )
			return false
		}
		if(!data.password){
			showFailToast( t('serverCodes.802') )
			return false
		}
		if(!data.password2 || data.password!=data.password2){
			showFailToast( t('serverCodes.803') )
			return false
		}
		
		data.loading = true;
		editPassApi({
			'opassword':data.opassword,
			'password':data.password,
			'password2':data.password2
		}).then(res=>{
			showSuccessToast(res.msg);
			data.opassword = '';
			data.password = '';
			data.password2 = '';
			data.loading = false;
		}).catch(e=>{
			data.loading = false;
			showFailToast(e.msg || e.message || t('common.error'))
		})
	}
	
	onMounted(() => {
		
	})
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
