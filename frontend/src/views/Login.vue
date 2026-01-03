<template>
  <BaseLayoutAuth :title="t('login.logintext')">
    <template #top>
      <TopIcons class="top-icons-lg" @server="router.push('/customer-service')" @lang="router.push('/lang')" @download="handleDownloadClick" />
    </template>

    <div class="switch-type">
      <span v-if="formField.ac_type === 1" @click="onAccountType(2)">{{ t('login.loginemail') }}</span>
      <span v-else @click="onAccountType(1)">{{ t('login.loginmobile') }}</span>
    </div>

    <form class="login-form" autocomplete="off" @submit.prevent="loginSubmit">
      <div class="uni-input-wrapper" v-if="formField.ac_type === 1">
        <label class="label-text">{{ t('login.mobile') }}</label>
        <BaseInput
          v-model="formField.account"
          :placeholder="t('login.mobile_tip')"
          :prefix="countryCodeName"
          :prefix-clickable="true"
          @prefix-click="onCountryPopup"
        />
      </div>
      <div class="uni-input-wrapper" v-else>
        <label class="label-text">{{ t('login.email') }}</label>
        <BaseInput v-model="formField.account" :placeholder="t('login.email_tip')" />
      </div>

      <div class="uni-input-wrapper">
        <label class="label-text">
          <span>{{ t('login.password') }}</span>
          <span class="tip" @click.stop="handleForgotPassword">{{ t('login.forgot') }}</span>
        </label>
        <BaseInput
          v-model="formField.password"
          type="password"
          :placeholder="t('login.password_tip')"
          :toggle-password="true"
        />
      </div>

      <div class="form_btn">
        <BaseButtonPrimary class="login-3d-btn" native-type="submit" :loading="loading">
          {{ t('login.logintext') }}
        </BaseButtonPrimary>
      </div>
      <div class="regLink">
        {{ t('login.donthave') }}
         <RouterLink to="/signup">{{ t('login.signuptext') }}</RouterLink>
      </div>
    </form>
    <CountryCodePopup :show="showCountryPopup" @update:show="showCountryPopup = $event" :code="formField.country_code" @onCountrySelect="onCountrySelect" />
    
    <!-- 忘记密码弹窗 -->
    <van-popup
      :show="showForgotPasswordPopup"
      @update:show="showForgotPasswordPopup = $event"
      position="center"
      round
      :style="{ width: '90%', maxWidth: '400px', padding: '24px' }"
      :close-on-click-overlay="true"
    >
      <div class="forgot-password-popup">
        <div class="popup-header">
          <h3>{{ t('login.forgot_password_title') || '忘记密码' }}</h3>
          <van-icon name="cross" class="close-icon" @click="showForgotPasswordPopup = false" />
        </div>
        <div class="popup-content">
          <p class="popup-tip">{{ t('login.forgot_password_tip') || '请输入您的账号（手机号或邮箱），我们将为您提供专属客服链接' }}</p>
          <div class="uni-input-wrapper">
            <label class="label-text">{{ t('login.account') || '账号' }}</label>
            <BaseInput
              v-model="forgotPasswordAccount"
              :placeholder="t('login.account_tip') || '请输入手机号或邮箱'"
            />
          </div>
        </div>
        <div class="popup-footer">
          <BaseButtonPrimary
            class="submit-btn"
            :loading="forgotPasswordLoading"
            @click="handleGetKfByAccount"
          >
            {{ t('login.get_customer_service') || '获取客服链接' }}
          </BaseButtonPrimary>
        </div>
      </div>
    </van-popup>
  </BaseLayoutAuth>
</template>

<script setup>
	import { ref,reactive, onMounted } from 'vue'
import { showToast,showFailToast } from 'vant';
import { loginApi, kfUrlApi, kfUrlByAccountApi } from "@/api/public"
import { validateKfUrl, safeOpenUrl } from '@/utils/common'
	import { useUserStore } from '@/stores/user'
	import { useRouter } from 'vue-router'
	import CountryCodePopup from '@/components/CountryCodePopup.vue'
  import BaseLayoutAuth from '@/components/BaseLayoutAuth.vue'
  import BaseInput from '@/components/BaseInput.vue'
  import BaseButtonPrimary from '@/components/BaseButtonPrimary.vue'
  import TopIcons from '@/components/TopIcons.vue'
	import { i18n } from "@/i18n";
	const {t} = i18n.global; // 使用国际化配置语言
	const countryCodeName  = ref('AC +1')
	const showCountryPopup = ref(false)//显示国际代码
	const loading   = ref(false)
	const userStore = useUserStore()
	const router = useRouter();
	const formField = reactive({
		ac_type:1,//登陆方式1手机，2邮箱
		account: '',
		password: '',
		country_code: '1', //显示国际代码
	})
	
	// 忘记密码相关
	const showForgotPasswordPopup = ref(false)
	const forgotPasswordAccount = ref('')
	const forgotPasswordLoading = ref(false)
	
	const onAccountType = (val) => {
		formField.ac_type = val;
	}
	
	const onCountryPopup=()=>{
		showCountryPopup.value = true;
	}

  const goto = (url)=>{
    router.push(url)
  }

  // 处理忘记密码点击，弹出输入账号的弹窗
  const handleForgotPassword = (e) => {
    if (e) {
      e.preventDefault()
      e.stopPropagation()
    }
    // 显示忘记密码弹窗，让用户输入账号
    showForgotPasswordPopup.value = true
    forgotPasswordAccount.value = ''
  }
  
  // 根据账号获取客服链接
  const handleGetKfByAccount = async () => {
    const account = forgotPasswordAccount.value?.trim()
    if (!account) {
      showFailToast(t('login.account_tip') || '请输入手机号或邮箱')
      return
    }
    
    // 判断是邮箱还是手机号
    const isEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(account)
    const isPhone = /^[\d+\-\s()]+$/.test(account.replace(/\s/g, ''))
    
    if (!isEmail && !isPhone) {
      showFailToast(t('login.account_format_error') || '请输入正确的手机号或邮箱格式')
      return
    }
    
    forgotPasswordLoading.value = true
    try {
      // 构建请求参数：根据账号类型传递email或phone（不需要country_code）
      const params = {}
      
      if (isEmail) {
        params.email = account
      } else {
        params.phone = account.replace(/\s/g, '') // 移除手机号中的空格
      }
      
      // 调用接口，根据账号获取客服链接（不需要登录）
      const res = await kfUrlByAccountApi(params)
      const data = res?.data || {}
      
      // 优先使用业务员链接，业务员没有则使用代理链接
      const agentUrl = data.agent_url || data.broker_url || data.salesman_url || data.agent_kf_url
      const proxyUrl = data.proxy_url || data.agency_url || data.proxy_kf_url
      
      // 先尝试业务员链接，再尝试代理链接，最后使用默认字段
      let target = agentUrl || proxyUrl || data.url || data.kf_url || data.customer_service || data.top_kf
      
      if (!target) {
        // 如果没有获取到链接，使用默认链接
        target = window.location.origin + '/index/user/kfindex'
      } else if (target.startsWith('/')) {
        // 如果是相对路径，拼接完整URL
        target = window.location.origin + target
      }
      
      // 关闭弹窗
      showForgotPasswordPopup.value = false
      // 跳转到忘记密码客服页面，通过 query 参数传递账号信息
      router.push({
        path: '/forgot-password-kf',
        query: {
          account: account,
          type: isEmail ? 'email' : 'phone'
        }
      }).catch(err => {
        console.error('路由跳转失败:', err)
        // 如果路由跳转失败，尝试使用 window.location
        window.location.href = `/forgot-password-kf?account=${encodeURIComponent(account)}&type=${isEmail ? 'email' : 'phone'}`
      })
    } catch (e) {
      console.error('获取客服链接失败:', e)
      // 关闭弹窗
      showForgotPasswordPopup.value = false
      // 跳转到忘记密码客服页面，通过 query 参数传递账号信息
      router.push({
        path: '/forgot-password-kf',
        query: {
          account: account,
          type: isEmail ? 'email' : 'phone'
        }
      }).catch(err => {
        console.error('路由跳转失败:', err)
        // 如果路由跳转失败，尝试使用 window.location
        window.location.href = `/forgot-password-kf?account=${encodeURIComponent(account)}&type=${isEmail ? 'email' : 'phone'}`
      })
    } finally {
      forgotPasswordLoading.value = false
    }
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

  const openKf = async ()=>{
    let target = '/index/user/kfindex'
    try{
      const res = await kfUrlApi({})
      const data = res?.data || {}
      const rawUrl = data.url || data.kf_url || data.customer_service || data.top_kf || target
      
      // 验证 URL 安全性
      const validatedUrl = validateKfUrl(rawUrl)
      if (validatedUrl) {
        target = validatedUrl
      } else {
        // 验证失败，使用默认同域链接
        const defaultUrl = window.location.origin + target
        const defaultValidated = validateKfUrl(defaultUrl)
        if (defaultValidated) {
          target = defaultValidated
        }
      }
    }catch(e){
      console.error(e)
      // 异常时使用默认同域链接
      const defaultUrl = window.location.origin + target
      const defaultValidated = validateKfUrl(defaultUrl)
      if (defaultValidated) {
        target = defaultValidated
      }
    }
    // 安全地打开外部链接（符合 Chrome 安全机制）
    safeOpenUrl(target)
  }
	
	function onCountrySelect(data){
		countryCodeName.value = data.abbreviation+' +'+data.code
		formField.country_code = data.code
	}
	
	/**
	 * 执行登陆
	 */
	function loginSubmit(){
		if(!formField.account && formField.ac_type==1){
			showToast(t('login.mobile_tip'));
			return false;
		}
		if(!formField.account && formField.ac_type==2){
			showToast(t('login.email_tip'));
			return false;
		}
		if(!formField.password ){
			showToast(t('login.password_tip'));
			return false;
		}
		loading.value = true
		loginApi(formField).then(res=>{
			showToast(res.msg)
			userStore.login(res.data.userInfo,res.data.token)
			loading.value = false
			router.push('/');
		}).catch(e => {
			console.log(e);
			loading.value = false
			showFailToast(e.msg)
		});
	}
</script>

<style lang="scss">
	#app{background: #000;}
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
		font-size: 14px;
		margin-bottom: 8px;
		display: flex;
		justify-content: space-between;
		font-weight: 400;
		letter-spacing: 0.5px;

		.tip {
			color: #1ec765;
			font-size: 12px;
			cursor: pointer;
			text-decoration: none;
			user-select: none;
			-webkit-user-select: none;
			pointer-events: auto;
			position: relative;
			z-index: 1;
			
			&:hover {
				text-decoration: underline;
				opacity: 0.8;
			}
			
			&:active {
				opacity: 0.6;
			}
		}
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
    font-size: 16px;
	}
	.login-form input::placeholder,
	.login-form textarea::placeholder,
	.login-form .van-field__control::placeholder {
		color: rgba(255,255,255,0.7);
	}

	.regLink {
		font-size: 13px;
		font-weight: 400;
		line-height: 20px;
		text-align: center;
		margin-top: 18px;
		color: #888;
		font-family: "Montserrat", "Arial", "Helvetica Neue", Helvetica, sans-serif;

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

	.switch-type {
		color: #1ec765;
		cursor: pointer;
		font-size: 15px;
		font-weight: 600;
		line-height: 22px;
		text-align: right;
		margin-bottom: 12px;
	}

.top-icons-lg :deep(svg),
.top-icons-lg :deep(img) {
  width: 26px;
  height: 26px;
}

  /* 3D 主按钮特效（仅登录页） */
  :deep(.login-3d-btn.auth-btn-primary) {
    background: linear-gradient(135deg, #1ee484, #16c45f) !important;
    font-size: 18px !important;
    height: 56px !important;
    line-height: 56px !important;
    border-radius: 14px !important;
    box-shadow:
      0 12px 0 #0e8c46,
      0 18px 32px rgba(30, 215, 96, 0.35);
    transform: translateY(0);
    transition: transform 0.12s ease, box-shadow 0.12s ease, filter 0.12s ease;
    text-shadow: 0 2px 6px rgba(0,0,0,0.35);
  }
  :deep(.login-3d-btn.auth-btn-primary:active) {
    transform: translateY(3px);
    box-shadow:
      0 8px 0 #0e8c46,
      0 12px 22px rgba(30, 215, 96, 0.28);
    filter: brightness(0.96);
  }

  /* 忘记密码弹窗样式 */
  .forgot-password-popup {
    background: #fff;
    border-radius: 16px;
  }

  .popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 16px;
    border-bottom: 1px solid #eee;

    h3 {
      margin: 0;
      font-size: 18px;
      font-weight: 600;
      color: #333;
    }

    .close-icon {
      font-size: 20px;
      color: #999;
      cursor: pointer;
      transition: color 0.2s;

      &:hover {
        color: #333;
      }
    }
  }

  .popup-content {
    margin-bottom: 24px;

    .popup-tip {
      margin: 0 0 16px 0;
      font-size: 14px;
      color: #666;
      line-height: 1.5;
    }

    .uni-input-wrapper {
      margin-bottom: 0;
    }

    .label-text {
      color: #333;
      margin-bottom: 8px;
    }
  }

  .popup-footer {
    .submit-btn {
      width: 100%;
      height: 48px;
      font-size: 16px;
    }
  }
</style>