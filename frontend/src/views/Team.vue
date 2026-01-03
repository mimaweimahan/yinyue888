<template>
  <div class="page-wrapper">
    <div class="page-bg"></div>
    <div class="page-mask"></div>
    <div class="page-wrapper-body">
		<section class="page-wrapper-header">
        <van-icon name="arrow-left" class="icon-box" size="18" @click="goMine()" />
        <div class="title"><span>{{ t('tabBar.team') }}</span></div>
		</section>

      <article class="team">
        <div class="summary-grid">
          <div class="s-card">
            <div class="s-label">{{ t('team.members') }}</div>
            <div class="s-value">{{ data.team_members }}</div>
				</div>
          <div class="s-card">
            <div class="s-label">{{ t('team.performance') }}</div>
            <div class="s-value">${{ formatAmount(data.team_performance) }}</div>
				</div>
          <div class="s-card">
            <div class="s-label">{{ t('team.withdraw') }}</div>
            <div class="s-value">${{ formatAmount(data.team_withdraw) }}</div>
				</div>
          <div class="s-card">
            <div class="s-label">{{ t('team.invested') }}</div>
            <div class="s-value">${{ formatAmount(data.team_invested) }}</div>
						</div>
					</div>
					
        <div class="reward-card">
          <div class="label">{{ t('team.reward') }}</div>
          <div class="txt">{{ data.level1_rate }}% - {{ data.level2_rate }}% - {{ data.level3_rate }}%</div>
					</div>
					
        <div class="levels">
          <div class="level-card" v-for="lv in [1,2,3]" :key="lv">
            <div class="header">
              <div class="title">{{ t(`team.team${lv}`) }}</div>
              <button class="link" @click="goDetail(lv)">{{ t('team.detail') }} <van-icon name="arrow" /></button>
						</div>
            <div class="stats">
								<div class="item">
                <div class="i-label">{{ t('team.num') }}</div>
                <div class="i-value">{{ data[`level${lv}_num`] || 0 }}</div>
								</div>
								<div class="item">
                <div class="i-label">{{ t('team.ratio') }}</div>
                <div class="i-value accent">{{ data[`level${lv}_rate`] || 0 }}%</div>
								</div>
								<div class="item">
                <div class="i-label">{{ t('team.bonus') }}</div>
                <div class="i-value">${{ formatAmount(data[`level${lv}_bonus`] || 0) }}</div>
								</div>
							</div>
						</div>
					</div>
      </article>
				
      <div class="ft-h"></div>
      <FooterTabbar active="team" />
	</div>
  </div>
</template>
<script setup>
	import { ref,onMounted } from 'vue'
	import { showToast,showSuccessToast,showLoadingToast,showFailToast } from 'vant'
	import { teamInfoApi,teamListApi } from "@/api/public"
	import { i18n } from "@/i18n";
	import { useRouter } from 'vue-router';
import FooterTabbar from '@/components/FooterTabbar.vue'
import { formatAmount } from '@/utils/common'
	const router = useRouter();
	const {t} = i18n.global; // 使用国际化配置语言
	
	const data = ref({
		'team_members':0,
		'team_performance':'0.00',
		'team_withdraw':'0.00',
		'team_invested':'0.00',
		'level1_rate':0,
		'level2_rate':0,
		'level3_rate':0,
		
		'level1_num':0,//1级人数
		'level2_num':0,//2级人数
		'level3_num':0,//3级人数
		
		'level1_bonus':0,//1级奖金
		'level2_bonus':0,//2级奖金
		'level3_bonus':0,//3级奖金
	})
	const goMine = () =>{
		router.push('/user');
	}
	const goDetail = (v) =>{
		router.push({ path: '/teamDetail', query: { level: v } });
	}


	onMounted(() => {
		teamInfoApi().then(res=>{
			data.value = res.data;
		}).catch(e=>{
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
.team {
  display: flex;
  flex-direction: column;
  gap: 16px;
		}
.summary-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
  gap: 10px;
}
.s-card {
  border-radius: 14px;
  padding: 12px 12px;
  background: linear-gradient(150deg, rgba(255,255,255,0.1), rgba(255,255,255,0.04));
  border: 1px solid rgba(255,255,255,0.14);
  box-shadow: 0 10px 24px rgba(0,0,0,0.26);
  backdrop-filter: blur(8px);
}
.s-label { color: #cfd6ff; font-size: 13px; margin-bottom: 6px; }
.s-value { color: #fff; font-weight: 800; font-size: 20px; }
.reward-card {
  border-radius: 14px;
  padding: 12px 12px;
  background: linear-gradient(150deg, rgba(30,215,96,0.16), rgba(255,255,255,0.05));
  border: 1px solid rgba(30,215,96,0.3);
			    color: #fff;
  box-shadow: 0 10px 24px rgba(30,215,96,0.25);
}
.reward-card .label { font-size: 13px; color: #cfd6ff; }
.reward-card .txt { margin-top: 6px; font-size: 18px; font-weight: 800; letter-spacing: 0.4px; }
.levels {
			    display: flex;
  flex-direction: column;
  gap: 12px;
}
.level-card {
  border-radius: 16px;
  padding: 12px 12px;
  background: linear-gradient(150deg, rgba(255,255,255,0.08), rgba(255,255,255,0.03));
  border: 1px solid rgba(255,255,255,0.14);
  box-shadow: 0 12px 28px rgba(0,0,0,0.28);
  backdrop-filter: blur(8px);
}
.level-card .header {
					display: flex;
					align-items: center;
  justify-content: space-between;
  gap: 10px;
  margin-bottom: 10px;
			}
.level-card .title { font-size: 16px; font-weight: 800; color: #fff; }
.link {
  background: transparent;
  border: none;
  color: #1ed760;
  font-weight: 700;
  display: inline-flex;
  align-items: center;
  gap: 4px;
				    cursor: pointer;
}
.stats {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 8px;
}
.item {
  border-radius: 12px;
  padding: 10px 8px;
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.12);
  box-shadow: 0 8px 18px rgba(0,0,0,0.22);
}
.i-label { color: #cfd6ff; font-size: 12px; margin-bottom: 6px; }
.i-value { color: #fff; font-weight: 800; font-size: 16px; }
.i-value.accent { color: #1ed760; }
.ft-h { height: 20px; }
@media (max-width: 480px) {
  .page-wrapper-body { 
    padding: 14px 12px;
    padding-top: max(14px, env(safe-area-inset-top, 0px));
    padding-bottom: calc(90px + env(safe-area-inset-bottom, 0px));
  }
  .summary-grid { grid-template-columns: repeat(2, 1fr); }
  .s-value { font-size: 18px; }
  .stats { grid-template-columns: repeat(3, 1fr); }
  .item { padding: 10px 6px; }
  .i-value { font-size: 15px; }
	}
</style>