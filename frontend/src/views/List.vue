<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
      <section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goBack()" />
        <div class="title"><span>{{ t('trade.records') }}</span></div>
      </section>

      <section class="stats-section">
        <div class="stats-grid">
          <div class="stat-card">
            <div class="stat-value highlight">${{ parseFloat(data.task?.task_revenue??0).toFixed(2) }}</div>
            <div class="stat-label">{{ t('trade.this_income') }}</div>
			</div>
          <div class="stat-card">
            <div class="stat-value">${{ parseFloat(data.task?.total_revenue??0).toFixed(2) }}</div>
            <div class="stat-label">{{ t('trade.list.total_revenue') }}</div>
			</div>
          <div class="stat-card">
            <div class="stat-value">${{ parseFloat(data.task?.been_released??0).toFixed(2) }}</div>
            <div class="stat-label">{{ t('trade.list.been_released') }}</div>
			</div>
          <div class="stat-card">
            <div class="stat-value">${{ parseFloat(data.task?.be_released??0).toFixed(2) }}</div>
            <div class="stat-label">{{ t('trade.list.be_released') }}</div>
			</div>
		</div>
      </section>

      <section class="orders-section">
		<div class="tabnav">
          <button class="tab_item" :class="{ check: data.type==0 }" @click="onTabNav(0)">
            {{ t('trade.list.atv') }}
          </button>
          <button class="tab_item" :class="{ check: data.type==1 }" @click="onTabNav(1)">
            {{ t('trade.list.exp') }}
          </button>
			</div>

        <div class="list">
          <div v-if="data.listLoading" class="state-box">
            <van-loading size="28" color="#1ed760" />
			</div>
          <div v-else-if="data.orderList.length==0" class="state-box">
            <span>{{ t('common.norecord') }}</span>
		</div>

          <template v-else>
            <div v-for="(item,index) in data.orderList" :key="index" class="order-card">
              <div class="order-header">
                <span class="order-label">{{ t('trade.list.orderno') }}</span>
                <span class="order-no">{{ item.trade_no }}</span>
				</div>
              
              <div class="goods-info">
                <div class="goods-pic">
                  <van-image :src="getGoodsImageUrl(item.image)" fit="cover" />
					</div>
                <div class="goods-detail">
                  <div class="goods-title">{{ item.goods_name }}</div>
                  <div class="goods-num">x <span>{{ item.num }}</span></div>
					</div>
				</div>

              <div class="order-info">
                <div class="info-row">
                  <span class="info-label">{{ t('trade.list.amount') }}</span>
                  <span class="info-value">${{ item.price }}</span>
                </div>
                <div class="info-row">
                  <span class="info-label">{{ t('trade.list.total_amount') }}</span>
                  <span class="info-value">${{ item.total_price }}</span>
						</div>
                <div class="info-row">
                  <span class="info-label">{{ t('trade.list.profit') }}</span>
                  <span class="info-value profit">${{ item.profit }}</span>
						</div>
                <div class="info-row" v-if="item.need<0 && data.type==0">
                  <span class="info-label warning">{{ t('trade.list.need') }}</span>
                  <span class="info-value warning">${{ item.need }}</span>
						</div>
                <div class="info-row">
                  <span class="info-label">{{ t('trade.list.created_time') }}</span>
                  <span class="info-value time">{{ item.created_at }}</span>
						</div>
						</div>

              <div class="order-status">
                <img src="@/assets/ico_succ.png" alt="success" />
					</div>

              <div class="order-action" v-if="item.is_ready==0 && item.status==0">
                <van-button 
                  class="finish-btn" 
                  type="primary" 
                  :loading="data.loading" 
                  @click="onConfirm(item.id)"
                >
                  {{ t('trade.list.finish') }}
                </van-button>
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
      <FooterTabbar active="trade" />
	</div>
  </div>
</template>
<script setup>
	import { onMounted,ref,reactive } from 'vue'
	import { showSuccessToast,showFailToast} from 'vant'
	import { i18n } from "@/i18n";
	import { tradingInfoApi, tradingListApi, tradingConfirmApi } from "@/api/public"
	import FooterTabbar from '@/components/FooterTabbar.vue'
	import { useRouter } from 'vue-router'
	import { getGoodsImageUrl } from '@/utils/common'
	
	const router = useRouter()
	const {t} = i18n.global; // 使用国际化配置语言
	
	const goBack = () => {
		router.back()
	}
	const data = reactive({
		'listLoading':false,
		'loading':false,
		'orderList':[],
		'total':0, //总条数
		'page':1, //当前分页
		'perPage':10,//每页显示条数
		'type':0, //订单类型 0未完成，1已完成
		'task':{
			'task_revenue':0,//本轮收益
			'total_revenue':0,//总收益
			'been_released':0,//已释放累计金额
			'be_released':'0.0000'//待释放累计金额
		}
	});
	const onTabNav=(str)=>{
		data.page = 1
		data.type = str
		queryList()
	}
	
	const onPage=()=>{
		queryList()
	}
	
	const queryList=()=>{
		let opt = {
			type:data.type,
			page:data.page
		}
		data.listLoading = true
		tradingListApi(opt).then(res=>{
			data.listLoading  = false
			data.orderList    = res.data.data
			data.perPage      = res.data.per_page
			data.total        = res.data.total
			data.current_page = res.data.current_page
		}).catch(e=>{
			data.listLoading  = false
			console.log(e);
		})
	}
	
	const onConfirm = (id) =>{
		data.loading  = true
		tradingConfirmApi({order_id:id}).then(res=>{
			data.loading  = false
			data.task = res.data
			showSuccessToast( t('trade.success') );
			dataLoading()
		}).catch(e=>{
			data.loading = false
			showFailToast(e.msg)
			console.log(e);
		})
	}
	
	const dataLoading=()=>{
		tradingInfoApi().then(res=>{
			data.task  = res.data;
		})
		queryList();
	}
	
	onMounted(() => {
		dataLoading();
	})
	
</script>	
<style scoped lang="scss">
.page-wrapper {
  position: relative;
  min-height: 100dvh;
  background: #000;
  overflow: hidden;
  overflow-x: hidden;
	}
.page-bg {
  position: fixed;
  inset: 0;
  background: url('/images/home/bg-page.png') center/cover no-repeat;
  filter: blur(14px);
  opacity: 0.5;
  z-index: 0;
}
.page-mask {
  position: fixed;
  inset: 0;
  background: linear-gradient(180deg, rgba(0,0,0,0.75), rgba(0,0,0,0.92));
  z-index: 1;
}
.page-wrapper-body {
  position: relative;
  z-index: 2;
  max-width: 520px;
  margin: 0 auto;
  padding: 14px 12px;
  padding-top: max(14px, env(safe-area-inset-top, 0px));
  padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  color: #fff;
  min-height: calc(100dvh - env(safe-area-inset-top, 0px) - env(safe-area-inset-bottom, 0px));
}

.page-wrapper-header {
			width: 100%;
  height: 46px;
				text-align: center;
  font-size: 16px;
				display: flex;
				align-items: center;
  padding: 0 16px;
  .icon-box {
    width: 50px;
					color: #fff;
    cursor: pointer;
  }
  .title {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    overflow: hidden;
    height: 100%;
    span {
      margin-right: 50px;
      font-weight: 700;
      font-size: 17px;
    }
		}
	}
	
.stats-section {
  padding: 16px;
}
.stats-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 12px;
}
.stat-card {
  background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.04));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 14px;
  padding: 16px 12px;
			    text-align: center;
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.3);
			}
.stat-value {
  font-size: 18px;
  font-weight: 700;
  color: #fff;
  margin-bottom: 6px;
  line-height: 1.2;
		}
.stat-value.highlight {
  color: #ff4f76;
  font-size: 20px;
}
.stat-label {
  font-size: 12px;
  color: rgba(255,255,255,0.7);
  line-height: 1.2;
}

.orders-section {
  padding: 0 16px 20px;
}
.tabnav {
  display: flex;
  gap: 10px;
  margin-bottom: 16px;
}
.tab_item {
  flex: 1;
  height: 40px;
  border-radius: 10px;
  border: 1px solid rgba(255,255,255,0.15);
  background: rgba(30,30,35,0.6);
  color: rgba(255,255,255,0.7);
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
  backdrop-filter: blur(8px);
}
.tab_item.check {
  background: linear-gradient(135deg, #11b411, #1ed760);
  border-color: rgba(17,180,17,0.5);
  color: #fff;
  box-shadow: 0 4px 12px rgba(17,180,17,0.3);
}
.tab_item:active {
  transform: scale(0.98);
}

.list {
				display: flex;
  flex-direction: column;
  gap: 12px;
}
.state-box {
					display: flex;
					justify-content: center;
					align-items: center;
  min-height: 120px;
  background: rgba(255,255,255,0.05);
  border-radius: 12px;
  color: rgba(255,255,255,0.6);
  font-size: 14px;
}
.order-card {
  background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.04));
  border: 1px solid rgba(255,255,255,0.12);
  border-radius: 16px;
  padding: 16px;
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  box-shadow: 0 8px 24px rgba(0,0,0,0.3);
  position: relative;
}
.order-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(255,255,255,0.1);
  margin-bottom: 12px;
}
.order-label {
  font-size: 13px;
  color: rgba(255,255,255,0.7);
}
.order-no {
  font-size: 14px;
  font-weight: 600;
  color: #11b411;
}
.goods-info {
  display: flex;
  gap: 12px;
  margin-bottom: 14px;
}
.goods-pic {
  width: 70px;
  height: 70px;
  border-radius: 10px;
					overflow: hidden;
  flex-shrink: 0;
  border: 1px solid rgba(255,255,255,0.1);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}
.goods-pic :deep(.van-image) {
  width: 100%;
  height: 100%;
				}
.goods-detail {
					flex: 1; 
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  min-width: 0;
}
.goods-title {
  font-size: 15px;
  font-weight: 600;
  color: #fff;
  line-height: 1.4;
						display: -webkit-box;
  -webkit-line-clamp: 2;
						-webkit-box-orient: vertical;
						overflow: hidden;
  margin-bottom: 6px;
					}
.goods-num {
  font-size: 13px;
  color: rgba(255,255,255,0.7);
  span {
    font-weight: 600;
    color: #fff;
						}
					}
.order-info {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-bottom: 12px;
  padding: 12px;
  background: rgba(0,0,0,0.2);
  border-radius: 10px;
}
.info-row {
				display: flex;
				justify-content: space-between;
				align-items: center;
  font-size: 13px;
}
.info-label {
  color: rgba(255,255,255,0.7);
}
.info-value {
  color: #fff;
  font-weight: 600;
}
.info-value.profit {
  color: #1ed760;
}
.info-value.warning {
  color: #ff4444;
				}
.info-value.time {
  font-size: 12px;
  font-weight: 400;
  color: rgba(255,255,255,0.6);
}
.order-status {
  position: absolute;
  top: 16px;
  right: 16px;
  width: 50px;
  height: 50px;
				display: flex;
				align-items: center;
				justify-content: center;
  opacity: 0.8;
  img {
				width: 100%;
    height: 100%;
    object-fit: contain;
  }
}
.order-action {
  margin-top: 12px;
  padding-top: 12px;
  border-top: 1px solid rgba(255,255,255,0.1);
}
.finish-btn {
  width: 100%;
  height: 42px;
  background: linear-gradient(135deg, #11b411, #1ed760);
  border: none;
  border-radius: 10px;
  color: #fff;
  font-size: 15px;
  font-weight: 700;
  box-shadow: 0 4px 12px rgba(17,180,17,0.3);
}

.page-box {
  margin-top: 20px;
  display: flex;
  justify-content: center;
}
:deep(.van-pagination) {
  color: #fff;
}
:deep(.van-pagination__item) {
  color: rgba(255,255,255,0.8);
  background: rgba(255,255,255,0.1);
  border-color: rgba(255,255,255,0.2);
}
:deep(.van-pagination__item--active) {
  background: linear-gradient(135deg, #11b411, #1ed760);
  border-color: rgba(17,180,17,0.5);
  color: #fff;
}

.ft-h {
  height: 20px;
}

@media (max-width: 430px) {
  .stats-grid {
    gap: 10px;
  }
  .stat-card {
    padding: 14px 10px;
  }
  .stat-value {
    font-size: 16px;
  }
  .stat-value.highlight {
    font-size: 18px;
  }
  .stat-label {
    font-size: 11px;
  }
  .tab_item {
    height: 38px;
    font-size: 14px;
  }
  .order-card {
    padding: 14px;
  }
  .goods-pic {
    width: 60px;
    height: 60px;
  }
  .goods-title {
    font-size: 14px;
  }
  .info-row {
    font-size: 12px;
  }
  .order-status {
    width: 45px;
    height: 45px;
		}
	}
</style>
