<template>
	<div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
		<div class="page-wrapper-body">
			<section class="page-wrapper-header">
				<van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()" />
				<div class="title"><span>{{ t('mine.recharge') }}</span></div>
			</section>

			<article class="recharge">
        <div class="balance-card">
          <div class="balance-info">
            <div class="label">{{ t('mine.available') }} (USD)</div>
            <div class="value">{{ formatAmount(userBalance) }}</div>
          </div>
          <van-button size="small" class="record-btn" @click="goRecords">{{ t('mine.records') }}</van-button>
        </div>

        <!-- 网络、币种选择区域暂注释保留 -->
        <!--
        <div class="section">
          <div class="section-title">{{ t('recharge.net') }}</div>
				<div class="tabnav">
            <div class="tab_item" v-for="item in data.list" :key="item.name" :class="data.net == item.name ? 'check' : ''" @click="netSelect(item)">
						<span>{{ item.title }}</span>
					</div>
				</div>

          <div class="section-title" v-if="data.currency.length > 0">{{ t('recharge.currency') }}</div>
				<div class="tabnav" v-if="data.currency.length > 0">
            <div class="tab_item" v-for="item in data.currency" :key="item.name" :class="data.currency_name == item.name ? 'check' : ''" @click="onSelect(item)">
						<img :src="item.icon" />
						<span>{{ item.name }}</span>
					</div>
				</div>
        </div>
        -->

        <div class="section">
          <!-- 收款二维码区域暂注释保留 -->
          <!--
          <div class="qrcode-card">
            <div class="i-scan">
              <img :src="data.qrCodeUrl" width="200" />
            </div>
            <div class="add" @click="copyValue(data.address)">
							<span class="text">{{ data.address }}</span>
						</div>
					</div>
          -->

					<div class="recharge-form">
						<div class="form-group">
              <div class="label-text">{{ t('recharge.amount') }}</div>
							<div class="form-control">
                <input
                  ref="amountRef"
                  class="amount-input"
                  type="number"
                  inputmode="decimal"
                  pattern="[0-9]*"
                  step="0.01"
                  v-model="data.amount"
                  :placeholder="t('recharge.amount_tip')"
                  autocomplete="off"
								/>
							</div>
						</div>

            <div class="preset-grid">
              <button
                v-for="preset in presetAmounts"
                :key="preset"
                type="button"
                class="preset-btn"
                @click="setAmount(preset)"
              >
                {{ preset }}
              </button>
            </div>
					</div>

					<div class="btns">
            <van-button class="btn" type="theme" block @click="submitForm">{{ t('recharge.submit_for_review') }}</van-button>
					</div>

					<div class="tips">
						<span class="tit">
							{{ t('recharge.alarm', { unit: data.currency_name }) }}
						</span>
						<div class="lab">
              <p>{{ data.tips }}</p>
							<p>{{ t('recharge.alarm_desc') }}</p>
							<p>{{ t('recharge.alarm_desc2') }}</p>
						</div>
					</div>
				</div>
			</article>

      <div class="ft-h"></div>
      <FooterTabbar active="user" />
		</div>
	</div>
</template>
<script setup>
	import axios from 'axios';
	import QRCode from 'qrcode';
import { onMounted, reactive, ref, watch, computed, nextTick } from 'vue'
	import { showToast } from 'vant'
import { rechargeApi,rechargeApprovalApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
import { copyValue, formatAmount } from "@/utils/common"
	import { useUserStore } from '@/stores/user'
	import config from '@/config'
import FooterTabbar from '@/components/FooterTabbar.vue'
	const userStore = useUserStore();
	const { t } = i18n.global; // 使用国际化配置语言
	const router = useRouter();
const amountRef = ref(null)
	const goMine = () => {
		router.push('/user');
	}
const goRecords = () => {
  router.push('/records')
}
const userBalance = computed(() => userStore.userInfo?.balance || 0)
const presetAmounts = [10,20,50,100,200,500,1000,2000,5000,10000,20000,50000]
const setAmount = (val) => {
  data.amount = String(val)
  nextTick(() => {
    if (amountRef.value && amountRef.value.focus) {
      amountRef.value.focus()
    }
  })
}
	const userInfo = userStore.userInfo;
	const fileList = ref([]);
	// 上传状态
	const uploading = ref(false);
	const uploadSuccess = ref(false);
	const uploadError = ref(false);

	const data = reactive({
		'list': [],
		'currency': [],
		'fileList': [],
		'net': '',
		'currency_name': ',',
		'address': '',
		'qrCodeUrl': '',
		'tips': '',
		'address_type': '',
		'transaction_hash': '',
		'transfer_screenshot': '', //转账截图
		'amount':''//充值金额
	})
	const netSelect = (item) => {
		data.address = item.address
		if (item.currency) {
			data.currency = item.currency
			data.address = item.currency[0].address
			data.currency_name = item.currency[0].name
		} else {
			data.currency = [];
			data.currency_name = item.name;
		}
		data.address_type = item.name;
		data.net = item.name;
	}

	const onSelect = (item) => {
		data.address = item.address
		data.currency_name = item.name
	}

	watch(() => data.address, () => {
		if (data.address) {
			QRCode.toDataURL(data.address, {
				width: 200,
				margin: 2
			}).then(res => {
				data.qrCodeUrl = res;
			})
		}
	})


	// 读取文件后上传
	const handleAfterRead = async (file) => {
	  // 显示上传中状态
	  uploading.value = true;
	  uploadSuccess.value = false;
	  uploadError.value = false;

	  try {
	    // 创建FormData对象
	    const formData = new FormData();
	    // 将文件添加到FormData
	    formData.append('image', file.file);

	    // 发送请求到后端接口
	    const response = await axios.post(config.baseURL+'/upload/image', formData, {
			headers: {
				'Content-Type': 'multipart/form-data'
			},
			withCredentials: false
	    });

	    if (response.data.code === 200) {
	      // 上传成功，更新文件列表中的url为服务器返回的路径
	      file.url = response.data.data.url;
		  data.transfer_screenshot = response.data.data.url;
	      uploadSuccess.value = true;
	      // 3秒后关闭成功提示
	      setTimeout(() => {
	        uploadSuccess.value = false;
	      }, 3000);
	    } else {
	      throw new Error(response.data.msg );
	    }
	  } catch (error) {
	    console.error('上传失败:', error);
	    uploadError.value = true;

	    // 3秒后关闭错误提示
	    setTimeout(() => {
	      uploadError.value = false;
	    }, 3000);

	    // 从文件列表中移除上传失败的文件
	    fileList.value = fileList.value.filter(item => item.uid !== file.uid);
		
	  } finally {
	    uploading.value = false;
	  }
	};

	// 删除图片前的回调
	// eslint-disable-next-line no-unused-vars
	const handleBeforeDelete = (file) => {
	  // 可以在这里添加删除确认逻辑
	  return true; // 返回true允许删除，返回false阻止删除
	};

	// 点击预览图上的删除按钮
	const handleDelete = (item) => {
	  fileList.value = fileList.value.filter(file => file.uid !== item.uid);
	};

	const submitForm = () =>{
		const amt = String(data.amount || '').trim()
		if(!amt){
			return showToast(t('recharge.amount_tip'))
		}

		// 兜底必填字段，避免接口提示缺少参数
		const address_type = data.address_type || data.currency_name || 'USDT'
		const symbol = data.currency_name || 'USDT'
		const address = data.address || 'manual'

		const opt = {
			address,
			address_type,
			symbol,
			amount: amt,
			// 后端若要求提供，给出占位避免缺参
			transaction_hash: data.transaction_hash || 'manual',
			transfer_screenshot: data.transfer_screenshot || ''
		}

		rechargeApprovalApi(opt).then(res => {
			data.transaction_hash = '';
			data.transfer_screenshot = '';
			fileList.value = [];
			showToast(res.msg);
		setTimeout(() => openKf(), 800); // 成功提示后再跳转客服
		}).catch(e => {
			showToast(e.msg || 'Submit failed');
		})
	}

const openKf = () => {
  // 跳转到客服页面（使用路由跳转，在当前应用内打开）
  router.push('/customer-service')
	}

	onMounted(() => {
		rechargeApi().then(res => {
    const list = res?.data?.data || res?.data?.list || []
    data.list = list
    data.tips = res?.data?.tips || ''
    if (list && list.length) {
      netSelect(list[0])
    } else {
      // 兜底填充，避免提交缺参
      data.address = res?.data?.address || ''
      data.address_type = res?.data?.address_type || res?.data?.symbol || 'USDT'
      data.currency_name = res?.data?.currency_name || res?.data?.symbol || 'USDT'
    }
		}).catch(e => {
			console.log(e)
		})
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
	.recharge {
  display: flex;
  flex-direction: column;
  gap: 18px;
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
.balance-info .label { font-size: 13px; color: #cfd6ff; }
.balance-info .value { margin-top: 6px; font-size: 28px; font-weight: 800; color: #fff; }
.record-btn {
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.35);
  color: #fff;
  height: 34px;
  padding: 0 14px;
  background: linear-gradient(135deg, rgba(255,255,255,0.16), rgba(255,255,255,0.06));
  box-shadow: 0 10px 22px rgba(0,0,0,0.25);
}
.section {
  background: linear-gradient(150deg, rgba(255,255,255,0.09), rgba(255,255,255,0.04));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 16px;
  padding: 16px 14px;
  box-shadow: 0 12px 28px rgba(0,0,0,0.3);
  backdrop-filter: blur(10px);
		}
.section-title {
  color: #fff;
  font-weight: 700;
  margin-bottom: 12px;
}
		.tabnav {
			margin-bottom: 10px;
			display: flex;
			flex-wrap: wrap;
  gap: 8px;
}
			.tab_item {
  padding: 12px 10px;
				text-align: center;
				line-height: 1;
				cursor: pointer;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.22);
  color: #f5f5f5;
				display: flex;
				align-items: center;
				justify-content: center;
  gap: 8px;
  background: rgba(75,75,75,0.55);
  min-width: 96px;
}
.tab_item img { width: 22px; height: 22px; }
			.tab_item.check {
  color: #1ed760;
  border: 1px solid #1ed760;
  background: rgba(30,215,96,0.08);
  box-shadow: 0 0 18px rgba(30,215,96,0.25);
			}
.qrcode-card {
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 16px;
  padding: 18px 12px;
				text-align: center;
  background: rgba(255,255,255,0.03);
}
.qrcode-card .i-scan img { width: 200px; height: 200px; }
.qrcode-card .add { margin: 14px 12px 4px; }
.qrcode-card .text {
						display: block;
  background: rgba(0,0,0,0.6);
  padding: 14px 10px;
  border-radius: 12px;
						font-size: 12px;
						color: #fff;
  word-break: break-all;
}
.recharge-form { margin-top: 16px; }
.form-group { margin-bottom: 16px; }
.label-text { color: #cfd6ff; font-size: 13px; margin-bottom: 8px; }
.form-control {
  background: rgba(75,75,75,0.55);
  border: 1px solid rgba(255,255,255,0.14);
  border-radius: 14px;
  padding: 6px 12px;
  box-shadow: inset 0 1px 0 rgba(255,255,255,0.05), 0 12px 28px rgba(0,0,0,0.32);
}
.amount-input {
  width: 100%;
  background: transparent;
  border: none;
  outline: none;
  color: #fff;
  caret-color: #fff;
  font-size: 16px !important;
  font-weight: 700;
  line-height: 1.5;
  padding: 10px 4px;
}
.amount-input::placeholder {
  color: rgba(255,255,255,0.6);
}
.preset-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}
.preset-btn {
  height: 55px;
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,0.18);
  background: linear-gradient(150deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
  color: #fff;
  font-weight: 700;
  font-size: 20px;
  letter-spacing: 0.3px;
  transition: all 0.2s ease;
  box-shadow: 0 10px 22px rgba(0,0,0,0.32);
}
.preset-btn:hover {
  border-color: #1ed760;
  color: #1ed760;
  box-shadow: 0 0 14px rgba(30,215,96,0.28);
}
.preset-btn:active {
  transform: scale(0.98);
}
.btns { margin-top: 14px; }
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
  .amount-input { font-size: 16px !important; }
  .preset-btn { font-size: 18px; }
	}
</style>
