<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()" />
        <div class="title"><span>{{ t('mine.records') }}</span></div>
		</section>

		<section class="records">
			<div class="tabnav">
          <button class="tab_item" :class="{ check: data.tabnav === 1 }" @click="onTab(1)">{{ t('records.recharge') }}</button>
          <button class="tab_item" :class="{ check: data.tabnav === 2 }" @click="onTab(2)">{{ t('records.withdraw') }}</button>
          <button class="tab_item" :class="{ check: data.tabnav === 3 }" @click="onTab(3)">{{ t('records.rewards') }}</button>
          <button class="tab_item" :class="{ check: data.tabnav === 4 }" @click="onTab(4)">{{ t('records.commission') }}</button>
        </div>

        <div class="list">
          <div v-if="data.loading" class="state-box">
            <van-loading size="28" color="#1ed760" />
          </div>
          <div v-else-if="data.dataList.length === 0" class="state-box">
            <span>{{ $t('common.norecord') }}</span>
          </div>

          <template v-else>
            <div v-for="(item, index) in data.dataList" :key="index" class="card">
              <div class="row">
                <span class="label">{{ t('records.date') }}</span>
                <span class="value">{{ item.created_at }}</span>
              </div>
              <div class="row" v-if="data.tabnav === 4">
                <span class="label">{{ t('records.id') }}</span>
                <span class="value">{{ item.from_user_id }}</span>
              </div>
              <div class="row" v-if="data.tabnav < 4">
                <span class="label">{{ t('records.usdt') }}</span>
                <span class="value strong">{{ formatAmount(item.balance) }}</span>
              </div>
              <div class="row" v-else>
                <span class="label">{{ t('records.usdt') }}</span>
                <span class="value strong">{{ formatAmount(item.balance) }}</span>
			</div>
              <div class="row status-row" v-if="data.tabnav < 4">
                <span class="label">{{ t('records.status') }}</span>
                <span class="status-pill" :class="statusClass(item)" @click="onMarkShow(item)">
                  <span>{{ t(item.tips) }}</span>
                  <small v-if="item.mark && (item.status === 2 || item.status === -1)">{{ item.mark }}</small>
							</span>
              </div>
            </div>
          </template>
        </div>

        <div class="page-box" v-if="data.total > data.perPage">
          <van-pagination
            v-model="data.page"
            :total-items="data.total"
            :items-per-page="data.perPage"
            mode="simple"
            @change="onPage"
          >
					<template #prev-text>
						<van-icon name="arrow-left" />
					</template>
					<template #next-text>
						<van-icon name="arrow" />
					</template>
				</van-pagination>
			</div>
		</section>

      <div class="ft-h"></div>
      <FooterTabbar active="user" />
	</div>
  </div>
</template>
<script setup>
	import { reactive,onMounted } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { walletLogApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
import FooterTabbar from '@/components/FooterTabbar.vue'
import { formatAmount } from '@/utils/common'
	
	const router = useRouter();
	const {t} = i18n.global; // 使用国际化配置语言
	
	const data = reactive({
		'loading':false,
		'dataList':[],
		'total':0, //总条数
		'page':1, //当前分页
		'perPage':10,//每页显示条数
		'tabnav': 1,
		'otranpass':'',
		'ntranpass':'',
		'ctranpass':''
	})
	
	const goMine = () =>{
		router.push('/user');
	}
	
	const onTab=(v)=>{
		data.tabnav = v;
		queryList()
	}
	const onPage=()=>{
		queryList()
	}
	const queryList=()=>{
		let opt = {
			type:data.tabnav,
			page:data.page
		}
		data.dataList = [];
		data.loading  = true
		walletLogApi(opt).then(res=>{
			data.loading  = false
			data.dataList     = res.data.data
			data.perPage      = res.data.per_page
			data.total        = res.data.total
			data.current_page = res.data.current_page
		}).catch(e=>{
			data.loading  = false
			console.log(e);
		})
	}
	const onMarkShow=(item)=>{
		item.mark_show = !item.mark_show
	}


const statusClass = (item) => {
  if (item.status === 1) return 'ok'
  if (item.status === 0) return 'pending'
  if (item.status === 2 || item.status === -1) return 'fail'
  return ''
	}
	onMounted(() => {
		queryList();
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
  max-width: 720px;
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
.records { display: flex; flex-direction: column; gap: 14px; }
.tabnav {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 8px;
}
.tab_item {
  height: 40px;
  border-radius: 12px;
  border: 1px solid rgba(255,255,255,0.18);
  background: linear-gradient(150deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
  color: #fff;
  font-weight: 700;
  font-size: 15px;
  letter-spacing: 0.2px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  box-shadow: 0 6px 14px rgba(0,0,0,0.22);
	}
.tab_item.check {
  border-color: #1ed760;
  color: #1ed760;
  box-shadow: 0 0 14px rgba(30,215,96,0.28);
}
.tab_item:active { transform: scale(0.98); }
.list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.card {
  border-radius: 16px;
  padding: 12px 10px;
  background: linear-gradient(150deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border: 1px solid rgba(255,255,255,0.14);
  box-shadow: 0 10px 22px rgba(0,0,0,0.24);
  backdrop-filter: blur(8px);
}
.row {
			display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 2px 0;
}
.label {
  color: #cfd6ff;
  font-size: 13px;
}
.value {
  color: #fff;
  font-size: 13px;
}
.value.strong { font-weight: 800; font-size: 15px; }
.status-row { margin-top: 4px; }
.status-pill {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 6px 8px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
  border: 1px solid rgba(255,255,255,0.14);
  background: rgba(255,255,255,0.06);
  box-shadow: 0 6px 14px rgba(0,0,0,0.2);
}
.status-pill small {
  display: block;
  font-weight: 400;
  color: rgba(255,255,255,0.7);
}
.status-pill.ok { color: #1ed760; border-color: rgba(30,215,96,0.35); }
.status-pill.pending { color: #f3b23f; border-color: rgba(243,178,63,0.4); }
.status-pill.fail { color: #ff6b6b; border-color: rgba(255,107,107,0.45); }
.state-box {
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,0.12);
  background: rgba(255,255,255,0.04);
  padding: 18px 12px;
				text-align: center;
  color: #cfd6ff;
	}
.page-box {
  padding: 10px 0 60px 0;
  display: flex;
  justify-content: center;
}
:deep(.van-pagination__item) {
  color: #fff;
}
:deep(.van-pagination__item--prev),
:deep(.van-pagination__item--next) {
  width: 36px !important;
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
  .tab_item { font-size: 14px; height: 40px; }
  .value.strong { font-size: 14px; }
  .card { padding: 10px 10px; }
  .row { padding: 1px 0; }
  .status-pill { font-size: 12px; padding: 6px 8px; }
}
</style>