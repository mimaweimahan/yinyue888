<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()" />
        <div class="title"><span>{{ levelName }}</span></div>
		</section>

      <section class="team-list">
        <div class="state-box" v-if="data.loading">
          <van-loading size="28" color="#1ed760" />
        </div>
        <div class="state-box" v-else-if="data.dataList.length === 0">
          <span>{{ $t('common.norecord') }}</span>
        </div>

        <div v-else class="cards">
          <div class="card" v-for="(item, index) in data.dataList" :key="index">
            <div class="row">
              <span class="label">{{ t('team.email') }}</span>
              <span class="value">{{ item.account }}</span>
            </div>
            <div class="row">
              <span class="label">{{ t('team.affiliatereward') }}</span>
              <span class="value strong">${{ formatAmount(item.reward) }}</span>
            </div>
            <div class="row">
              <span class="label">{{ t('team.selfrecharge') }}</span>
              <span class="value strong">${{ formatAmount(item.recharge) }}</span>
            </div>
          </div>
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
	</div>
  </div>
</template>
<script setup>
import { ref,onMounted,reactive, computed } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { teamListApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter,useRoute } from 'vue-router';
	import { formatAmount } from '@/utils/common'
	const router = useRouter();
	const route  = useRoute();
	const {t} = i18n.global; // 使用国际化配置语言
	if(parseInt(route.query.level)<1){
		showFailToast(t('serverCodes.700'))
		router.push('/team')
	}
	const goMine = () =>{
		router.push('/team');
	}
	const data = reactive({
		'loading':false,
		'dataList':[],
		'total':0, //总条数
		'page':1, //当前分页
		'perPage':10,//每页显示条数
		'level': parseInt(route.query.level) || 1
	})

const levelName = computed(() => t(`team.team${data.level}`) || t('team.detail'))

	
	const onPage=()=>{
		queryList()
	}
	const queryList=()=>{
		let opt = {
			level:data.level,
			page:data.page
		}
		data.loading = true
		teamListApi(opt).then(res=>{
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
  padding-bottom: calc(80px + env(safe-area-inset-bottom, 0px));
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
.team-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}
.cards {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
.card {
  border-radius: 14px;
  padding: 12px 12px;
  background: linear-gradient(150deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border: 1px solid rgba(255,255,255,0.14);
  box-shadow: 0 10px 24px rgba(0,0,0,0.26);
  backdrop-filter: blur(8px);
}
.row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 12px;
  padding: 2px 0;
}
.label { color: #cfd6ff; font-size: 13px; }
.value { color: #fff; font-size: 13px; }
.value.strong { font-weight: 800; font-size: 15px; }
.state-box {
  border-radius: 14px;
  border: 1px solid rgba(255,255,255,0.12);
  background: rgba(255,255,255,0.04);
  padding: 18px 12px;
  text-align: center;
  color: #cfd6ff;
}
.page-box {
  padding: 10px 0 40px 0;
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
@media (max-width: 480px) {
  .page-wrapper-body { 
    padding: 14px 12px;
    padding-top: max(14px, env(safe-area-inset-top, 0px));
    padding-bottom: calc(78px + env(safe-area-inset-bottom, 0px));
  }
  .card { padding: 10px 10px; }
  .value.strong { font-size: 14px; }
	}
</style>