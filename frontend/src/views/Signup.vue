<template>
  <BaseLayoutAuth
    :title="t('login.signuptext')"
    :subtitle="t('login.signuptext')"
    desc="Create an account to access more content"
  >
    <template #top>
      <TopIcons @server="router.push('/customer-service')" @lang="router.push('/lang')" @download="handleDownloadClick" />
    </template>

    <div class="switch-type">
      <span v-if="formField.ac_type === 1" @click="onAccountType(2)">{{ t('login.signupemail') || '邮箱注册' }}</span>
      <span v-else @click="onAccountType(1)">{{ t('login.signupmobile') || '手机号注册' }}</span>
    </div>

    <form class="login-form" autocomplete="off" @submit.prevent="doReg">
      <div class="uni-input-wrapper" v-if="formField.ac_type === 1">
        <label class="label-text">{{ t('login.mobile') }}</label>
        <BaseInput
          v-model="formField.phone"
          :placeholder="t('login.mobile_tip')"
          :prefix="countryCodeName"
          :prefix-clickable="true"
          @prefix-click="onCountryPopup"
        />
      </div>
      <div class="uni-input-wrapper" v-else>
        <label class="label-text">{{ t('login.email') }}</label>
        <BaseInput v-model="formField.email" :placeholder="t('login.email_tip')" />
      </div>

      <div class="uni-input-wrapper">
        <label class="label-text">{{ t('login.password') }}</label>
        <BaseInput v-model="formField.password" type="password" autocomplete="off" :placeholder="t('login.password_tip')" />
      </div>

      <div class="uni-input-wrapper">
        <label class="label-text">{{ t('login.cpassword') }}</label>
        <BaseInput v-model="formField.password2" type="password" autocomplete="off" :placeholder="t('login.password_tip')" />
      </div>

      <div class="uni-input-wrapper">
        <label class="label-text">{{ t('login.tranpass') }}</label>
        <BaseInput v-model="formField.tranpass" :placeholder="t('login.tranpass_tip')" />
      </div>

      <div class="uni-input-wrapper">
        <label class="label-text">{{ t('login.invite') }}</label>
        <BaseInput v-model="formField.invite" :placeholder="t('login.invite_tip')" />
      </div>

      <div class="form_btn">
        <BaseButtonPrimary native-type="submit">{{ t('login.signup') }}</BaseButtonPrimary>
      </div>
      <div class="regLink">
        <span class="regTip">{{ t('login.have') }}</span>
        <RouterLink to="/login">{{ t('login.login_now') }}</RouterLink>
      </div>
    </form>
    <CountryCodePopup :show="showCountryPopup" @update:show="showCountryPopup = $event" :code="formField.country_code" @onCountrySelect="onCountrySelect" />
  </BaseLayoutAuth>
</template>

<script setup>
	import { ref,reactive, onMounted } from 'vue' 
	import SettingsLang from '@/components/SettingsLang.vue'
	import CountryCodePopup from '@/components/CountryCodePopup.vue'
  import BaseLayoutAuth from '@/components/BaseLayoutAuth.vue'
  import BaseInput from '@/components/BaseInput.vue'
  import BaseButtonPrimary from '@/components/BaseButtonPrimary.vue'
  import TopIcons from '@/components/TopIcons.vue'
	import { showToast,showFailToast } from 'vant';
	import { registerApi, appDownloadApi } from "@/api/public"
	import { safeOpenUrl } from '@/utils/common'
	import { i18n } from "@/i18n";
	import { useRouter,useRoute } from 'vue-router'
	import { useUserStore } from '@/stores/user'
	const {t} = i18n.global; // 使用国际化配置语言
	
	const router  = useRouter();
	const route   = useRoute();
	const loading = ref(false)
	const countryCodeName  = ref('AC +1')
	const showCountryPopup = ref(false)//显示国际代码
	const userStore = useUserStore()
	
	const formField = reactive({
		ac_type: 1, // 注册方式：1手机号，2邮箱
		email: '',
		phone: '',
		country_code: '1', //显示国际代码
		password: '',
		password2: '',
		tranpass: '',
		invite: route.query.code,
	})
	
	const onAccountType = (val) => {
		formField.ac_type = val;
		// 切换时清空对应的输入框
		if (val === 1) {
			formField.email = '';
		} else {
			formField.phone = '';
		}
	} 
	const onCountryPopup=()=>{
		showCountryPopup.value = true;
	}
	
	function onCountrySelect(data){
		countryCodeName.value  = data.abbreviation+' +'+data.code
		formField.country_code = data.code
	}
	const goto = (url)=>{
		// 使用 router.push 进行内部路由导航，更安全
		router.push(url)
	}
	const handleDownloadClick = async () => {
		try {
			const res = await appDownloadApi({})
			if (res?.code === 1 && Array.isArray(res?.data) && res.data.length > 0) {
				const downloadUrl = res.data[0]?.url
				if (downloadUrl) {
					safeOpenUrl(downloadUrl)
				} else {
					showFailToast(t('common.get_download_link_failed') || '获取下载链接失败')
				}
			} else {
				showFailToast(res?.msg || t('common.get_download_link_failed') || '获取下载链接失败')
			}
		} catch (e) {
			showFailToast(e?.msg || t('common.get_download_link_failed') || '获取下载链接失败')
		}
	}
	const doReg =()=>{
		// 根据注册方式验证不同的字段
		if(formField.ac_type === 1){
			// 手机号注册
			if(!formField.phone){
				showFailToast(t('login.mobile_tip'))
				return false
			}
		} else {
			// 邮箱注册
			if(!formField.email){
				showFailToast(t('login.email_tip'))
				return false
			}
		}
		
		if(!formField.password){
			showFailToast(t('login.password_tip'))
			return false
		}
		if(!formField.password2){
			showFailToast(t('login.cpassword_tip'))
			return false
		}
		if(!formField.tranpass){
			showFailToast(t('serverCodes.820'))
			return false
		}
		if(!formField.invite){
			showFailToast(t('login.invite_tip'))
			return false
		}
		if(formField.password!=formField.password2){
			showFailToast(t('serverCodes.803'))
			return false
		}
		
		// 准备提交数据，根据注册方式传递对应字段，没有值的字段传递空字符串（后端需要验证）
		const submitData = {
			ac_type: formField.ac_type,
			password: formField.password,
			password2: formField.password2,
			tranpass: formField.tranpass,
			invite: formField.invite || '', // 如果没有值，传递空字符串
		}
		
		// 根据注册方式添加对应的字段，没有值的字段传递空字符串
		if(formField.ac_type === 1){
			// 手机号注册：传递 phone 和 country_code，email 传递空字符串
			submitData.phone = formField.phone ? formField.phone.trim() : ''
			submitData.country_code = formField.country_code || ''
			submitData.email = '' // 手机号注册时，email 传递空字符串
		} else {
			// 邮箱注册：传递 email，phone 和 country_code 传递空字符串
			submitData.email = formField.email ? formField.email.trim() : ''
			submitData.phone = '' // 邮箱注册时，phone 传递空字符串
			submitData.country_code = '' // 邮箱注册时，country_code 传递空字符串
		}
		
		loading.value = true
		registerApi(submitData).then(res=>{
			loading.value = false
			console.log(res.msg);
			showToast(res.msg)
			userStore.login(res.data.userInfo,res.data.token)
			router.push('/');
		}).catch(e => {
			console.log(e);
			loading.value = false
			showFailToast(e.msg)
		})
	}
</script>

<style lang="scss">
	#app {
		background: #000;
		font-family: "Montserrat", "Arial", "Helvetica Neue", Helvetica, sans-serif;
	}

	.login-form {
		width: 100%;
		max-width: 340px;
		background: transparent;
		border-radius: 16px;
		padding: 0;
		box-sizing: border-box;
		margin-bottom: 12px;
	}

	.uni-input-wrapper {
		width: 100%;
		margin-bottom: 18px;
	}

	.label-text {
		color: #fff;
		font-size: 12px;
		margin-bottom: 6px;
		display: block;
		font-weight: 400;
		letter-spacing: 0.5px;
	}

	.form_btn {
		margin-top: 10px;
	}

	/* 输入字体/光标统一白色，适配深色背景 */
	.login-form input,
	.login-form textarea,
	.login-form .van-field__control {
		color: #fff;
		caret-color: #fff;
	}
	.login-form input::placeholder,
	.login-form textarea::placeholder,
	.login-form .van-field__control::placeholder {
		color: rgba(255,255,255,0.7);
	}

	.switch-type {
		color: #1ec765;
		cursor: pointer;
		font-size: 15px;
		font-weight: 600;
		line-height: 22px;
		text-align: right;
		margin-bottom: 12px;
	}

	.regLink {
		font-size: 13px;
		font-weight: 400;
		line-height: 20px;
		text-align: center;
		margin-top: 18px;
		color: #888;
		font-family: "Montserrat", "Arial", "Helvetica Neue", Helvetica, sans-serif;

		.regTip {
			color: #888;
			display: block;
			margin-bottom: 4px;
		}

		a {
			color: #1ec765;
			cursor: pointer;
			font-weight: 600;
			text-decoration: none;

			&:hover {
				text-decoration: underline;
			}
		}
	}
</style>