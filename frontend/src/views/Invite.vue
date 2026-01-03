<template>
  <div class="page-wrapper">
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
			<van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()"/>
			<div class="title"><span>{{t('mine.invitefriends')}}</span></div>
		</section>
		<div class="invite-box">
			<div class="banner">
				<img src="@/assets/invite_bg.png" width="90%"/>
			</div>
			<div class="code-box">
				<div class="content">
					<p class="b"><b>{{t('invite.desc')}}</b></p>
					<p class="b">
						{{t('invite.earn')}}
					</p>
					<div class="qr-con">
						<img :src="data.qrCodeUrl" width="160" />
					</div>
					<div class="url-box">
						<div class="box-title">{{t('invite.link')}}</div>
						<div class="url">{{data.inviteLink}}</div>
					</div>
					<div class="entered_form_btn">
						<van-button class="btn" type="red" @click="copyValue(data.inviteLink)">{{ t('invite.linkbtn') }}</van-button>
					</div>
				</div>
			</div>
			
		</div>
	</div>
  </div>
</template>
<script setup>
	import { reactive,ref,onMounted } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { editPinApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
	import { copyValue } from "@/utils/common"
	import { useUserStore } from '@/stores/user'
	import config from '@/config'
	import QRCode from 'qrcode';
	const router = useRouter();
	const userStore = useUserStore();
	
	const {t} = i18n.global; // 使用国际化配置语言
	const goMine = () =>{
		router.push('/user');
	}
	
	const data = reactive({
		qrCodeUrl:'',
		inviteLink:''
	});
	const size = ref(200);
	const margin = ref(2);
	onMounted(() => {
		const fullDomain = window.location.protocol + "//" + window.location.hostname+config.basePath;
		let link = fullDomain+'/signup?code='+userStore.userInfo.invite
		data.inviteLink = link
		
		QRCode.toDataURL(link, {
		  width: size.value,
		  margin: margin.value
		}).then(url=>{
			data.qrCodeUrl = url;
		})
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
	.invite-box{ padding: 15px; }
	.banner{
		text-align: center;
	}
	.code-box{
		margin-bottom: 20px;
		overflow: hidden;
		position: relative;
		text-align: center;
		.content{
			display: flex;
			flex-direction: column;
			.b{
				padding: 10px 20px;
				color: #000;
				font-size: 16px;
				font-style: normal;
				line-height: 1.5;
				b{ font-weight: bold;}
			}
		}
	}
	.url-box{
		.box-title{
			margin-bottom: 12px;
			color: #000;
			font-size: 15px;
			line-height: 1;
		}
		.url{
			margin-top: 20px;
			color: #27313c;
			font-size: 14px;
			font-style: normal;
			font-weight: 500;
			line-height: 1;
			word-break: break-all;
			border-radius: 5px;
			border: 1px solid #000;
			background: #fff;
			padding: 14px 10px;
		}
	}
	.entered_form_btn{
		margin-top: 15px;
		.btn{
			width: 100%;
		}
	}
</style>