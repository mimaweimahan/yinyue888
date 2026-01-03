<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
      <section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()" />
        <div class="title"><span>{{ t('mine.withdraw') }}</span></div>
      </section>

      <article class="withdraw">
        <div class="balance-card">
          <div class="label">{{ t('mine.available') }} (USD)</div>
          <div class="value">{{ formatAmount(data.userInfo.balance) }}</div>
					</div>

        <div class="section">
				<div class="form-group">
            <div class="label-text">{{ t('withdraw.address') }}</div>
					<div class="form-control">
              <input
                class="base-input"
                type="text"
                v-model="data.address_withdraw"
                :placeholder="t('mine.enter_address')"
                readonly
              />
					</div>
				</div> 

				<div class="form-group">
            <div class="label-text">{{ t('withdraw.quantity') }}</div>
					<div class="form-control">
              <input
                class="base-input"
                type="number"
                inputmode="decimal"
                step="0.01"
                v-model="data.amount"
                placeholder="0.00"
              />
					</div>
            <div class="hint">{{ t('withdraw.amount') }} · {{ t('mine.available') }} ${{ formatAmount(data.userInfo.balance) }}</div>
				</div>

          <div class="net-switch">
            <span class="label">{{ t('withdraw.current') }}</span>
            <div class="chips">
              <button :class="{ active: data.ac_type === 1 }" @click="data.ac_type = 1">USDT-ERC20</button>
              <button :class="{ active: data.ac_type === 2 }" @click="data.ac_type = 2">USDT-TRC20</button>
						</div>
					</div>

          <div class="summary-bar">
            <div class="summary-item">
              <div class="s-label">{{ t('withdraw.amount') }}</div>
              <div class="s-value">${{ data.amount || '0.00' }}</div>
					</div>
            <div class="divider"></div>
            <div class="summary-item">
              <div class="s-label">{{ t('withdraw.fee') }}</div>
              <div class="s-value">${{ data.withdraw_fee || '0.00' }}</div>
					</div>
            <div class="divider"></div>
            <div class="summary-item">
              <div class="s-label">{{ t('withdraw.total') }}</div>
              <div class="s-value">${{ data.total_amount || '0.00' }}</div>
					</div>
				</div>
				
					<div class="form-group">
            <div class="label-text">{{ t('withdraw.pin') }}</div>
						<div class="form-control">
              <input
                class="base-input"
                type="password"
                v-model="data.security"
                :placeholder="t('withdraw.pin_tip')"
              />
					</div>
				</div>
				
          <div class="btns">
            <van-button class="btn" type="theme" block :loading="data.loading" @click="doSubmit">
              {{ t('withdraw.submit') }}
            </van-button>
          </div>

          <div class="tips">
            <span class="tit">
              {{ data.ac_type === 2 ? t('withdraw.erc_fee', { fee: data.erc_fee }) : t('withdraw.trc_fee', { fee: data.trc_fee }) }}
            </span>
            <p>{{ t('recharge.alarm_desc') }}</p>
            <p>{{ t('recharge.alarm_desc2') }}</p>
            <p>{{ t('withdraw.amount') }} ≥ {{ data.withdraw_min }} ，≤ {{ data.withdraw_max }}</p>
			</div>
		</div>
      </article>

      <div class="ft-h"></div>
      <FooterTabbar active="user" />
	</div>
  </div>
</template>
<script setup>
	import { onMounted, ref, reactive,watch,computed } from 'vue'
	import { useUserStore } from '@/stores/user'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { userInfoApi,walletOut } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
import FooterTabbar from '@/components/FooterTabbar.vue'
import { formatAmount } from '@/utils/common'
	const router = useRouter();
	const {t} = i18n.global; // 使用国际化配置语言
	
	const data = reactive({
		'loading':false,
		'address_withdraw':'',
		'erc_fee':0,
		'trc_fee':0,
		'amount':'',
		'security':'',
		'ac_type': 1,
		'withdraw_fee':0,
		'withdraw_min':1,
		'withdraw_max':1,
		'total_amount':0,
		'userInfo':{'balance':0}
	})
	watch( () => data.amount,(newVal) => {
		if(data.ac_type == 2){
			data.withdraw_fee = data.erc_fee/100
		}else{
			data.withdraw_fee = data.trc_fee/100
		}
		let amount = parseFloat(newVal);
		if(amount>0){
			data.withdraw_fee = (amount*data.withdraw_fee).toFixed(2)
			data.total_amount = (amount-data.withdraw_fee).toFixed(2)
		}
	})
	
	watch( () => data.ac_type,(newVal) => {
		if(newVal == 2){
			data.withdraw_fee = data.erc_fee/100
		}else{
			data.withdraw_fee = data.trc_fee/100
		}
		
		let amount = parseFloat(data.amount);
		
		if(amount>0){
			data.withdraw_fee = (parseFloat(data.amount)*data.withdraw_fee).toFixed(2)
			data.total_amount = (parseFloat(data.amount)-data.withdraw_fee).toFixed(2)
		}
	})
	
	const loading  = ref(false)
	// 执行匹配
	const updateUser =()=>{
		userInfoApi().then(res=>{
			data.userInfo = res.data;
			data.address_withdraw = res.data.address_withdraw;
			data.erc_fee = res.data.withdraw_erc_fee*100;
			data.trc_fee = res.data.withdraw_trc_fee*100;
			data.withdraw_min = parseInt(res.data.withdraw_min);
			data.withdraw_max = parseInt(res.data.withdraw_max);
		}).catch(e=>{
			console.log(e);
		})
	}
	
	const goMine = () =>{
		router.push('/user');
	}

	
	const doSubmit=()=>{
		
		let balance = parseFloat(data.userInfo.balance);
		let amount  = parseFloat(data.amount);
		
		if(!amount){
			showFailToast(t('serverCodes.817'))
			return false
		}
		if(amount > balance){
			showFailToast(t('serverCodes.819'))
			return false
		}
		if(amount < data.withdraw_min){
			showFailToast(t('serverCodes.822'))
			return false
		}
		if(amount > data.withdraw_max){
			showFailToast(t('serverCodes.823'))
			return false
		}
		if(!data.security){
			showFailToast(t('serverCodes.828'))
			return false
		}
		let opt = {
			'amount':amount,
			'address':data.address_withdraw,
			'ac_type':data.ac_type,
			'security':data.security
		}
		data.loading = true;
		
		walletOut(opt).then(res=>{
			showSuccessToast(res.msg);
			data.amount = 0;
			data.security= '';
			updateUser();
			data.loading = false;
			router.push('/user');
		}).catch(e=>{
			data.loading = false;
			showFailToast({
				message:e.msg,
				duration:5000
			})
		})
	}
	
	onMounted(() => {
		updateUser()
	})
</script>	
<style scoped lang="scss">
.page-wrapper {
  position: relative;
  min-height: 100dvh;
  background: #000;
  color: #fff;
  overflow: hidden;
  overflow-x: hidden;
}
.page-wrapper::after {
  content: "";
  position: fixed;
  inset: 0;
  background: radial-gradient(120% 120% at 50% 80%, rgba(30, 215, 96, 0.18), transparent 60%);
  pointer-events: none;
  z-index: 0;
}
.page-bg {
  position: fixed;
  inset: 0;
  background: url('/images/home/bg-page.png') center/cover no-repeat;
  filter: blur(10px);
  opacity: 0.25;
  z-index: 0;
}
.page-mask {
  position: fixed;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0.75), rgba(0,0,0,0.9));
  pointer-events: none;
  z-index: 0;
	}
.page-wrapper-body {
  position: relative;
  z-index: 1;
  padding: 16px;
  padding-top: max(16px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  max-width: 620px;
  margin: 0 auto;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
}
.page-wrapper-header {
		display: flex;
		align-items: center;
  gap: 10px;
  padding: 6px 2px 18px;
  .icon-box { color: #fff; }
  .title { font-size: 18px; font-weight: 700; color: #fff; }
}
.withdraw {
  display: flex;
  flex-direction: column;
  gap: 16px;
		}
.balance-card {
			display: flex;
			align-items: center;
  justify-content: space-between;
  padding: 16px 18px;
  border-radius: 16px;
  background: linear-gradient(145deg, rgba(255,255,255,0.12), rgba(255,255,255,0.03));
  border: 1px solid rgba(255,255,255,0.18);
  backdrop-filter: blur(12px);
  box-shadow: 0 12px 35px rgba(0,0,0,0.38);
}
.balance-card .label { font-size: 13px; color: #cfd6ff; }
.balance-card .value { margin-top: 6px; font-size: 28px; font-weight: 800; color: #fff; }
.section {
  background: linear-gradient(150deg, rgba(255,255,255,0.09), rgba(255,255,255,0.04));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 16px;
  padding: 16px 14px;
  box-shadow: 0 12px 28px rgba(0,0,0,0.3);
  backdrop-filter: blur(10px);
}
.form-group { margin-bottom: 16px; }
.label-text { color: #cfd6ff; font-size: 13px; margin-bottom: 8px; }
.form-control {
  background: rgba(75,75,75,0.55);
  border: 1px solid rgba(255,255,255,0.14);
  border-radius: 14px;
  padding: 6px 12px;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.05), 0 12px 28px rgba(0,0,0,0.32);
}
.base-input {
  width: 100%;
  background: transparent;
  border: none;
  outline: none;
				color: #fff;
  caret-color: #fff;
  font-size: 16px !important;
  font-weight: 700;
  line-height: 1.5;
  padding: 8px 2px;
			}
.base-input::placeholder { color: rgba(255,255,255,0.6); }
.hint {
  margin-top: 6px;
  color: rgba(255,255,255,0.6);
  font-size: 12px;
}
.net-switch {
				display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 10px 0 14px;
  .label { color: #cfd6ff; font-size: 13px; }
  .chips {
    display: inline-flex;
    gap: 10px;
  }
  .chips button {
    min-width: 118px;
    padding: 10px 14px;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.18);
    background: linear-gradient(150deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
    color: #fff;
					font-weight: 700;
    font-size: 14px;
    transition: all 0.2s ease;
    box-shadow: 0 8px 18px rgba(0,0,0,0.28);
  }
  .chips button.active {
    border-color: #1ed760;
    color: #1ed760;
    box-shadow: 0 0 14px rgba(30,215,96,0.28);
  }
  .chips button:active { transform: scale(0.98); }
				}
.summary-bar {
  display: flex;
  align-items: stretch;
  gap: 0;
  margin: 14px 0 8px;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(255,255,255,0.16);
  border-radius: 14px;
  overflow: hidden;
  overflow-x: hidden;
  box-shadow: 0 10px 24px rgba(0,0,0,0.26);
}
.summary-item {
  flex: 1;
  padding: 12px 10px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
.divider {
  width: 1px;
  background: rgba(255,255,255,0.12);
}
.s-label { color: #cfd6ff; font-size: 12px; margin-bottom: 6px; }
.s-value { color: #fff; font-weight: 800; font-size: 16px; }
.btns { margin-top: 18px; }
.btn {
				width: 100%;
  border-radius: 14px;
  height: 48px;
  background: linear-gradient(135deg, #11b411, #1ed760);
  color: #fff;
  border: none;
  box-shadow: 0 14px 32px rgba(30,215,96,0.28);
  transition: transform 0.16s ease, box-shadow 0.16s ease;
}
.btn:active {
  transform: translateY(1px);
  box-shadow: 0 8px 18px rgba(30,215,96,0.22);
}
.tips {
  margin-top: 18px;
  background: linear-gradient(150deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 14px;
  padding: 14px 12px;
  color: #8b8b8b;
  line-height: 1.5;
  backdrop-filter: blur(8px);
}
.tips .tit {
  display: block;
  color: #fff;
					font-weight: 700;
  margin-bottom: 6px;
}
.tips p {
  color: #cfd6ff;
  margin: 4px 0;
}
.ft-h {
  height: 20px;
}
@media (max-width: 480px) {
  .page-wrapper-body { 
    padding: 14px 12px;
    padding-top: max(14px, env(safe-area-inset-top, 0px));
    padding-bottom: calc(88px + env(safe-area-inset-bottom, 0px));
					}
  .balance-card { padding: 14px; }
  .base-input { font-size: 16px !important; }
  .summary-bar { margin: 12px 0 6px; }
  .summary-item { padding: 10px 8px; }
  .s-value { font-size: 15px; }
			}
</style>
