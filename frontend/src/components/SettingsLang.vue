<template>
	<div class="select-main">
		<div class="h-box lang-curr" @click="langShow=true">
			<div class="txt">
				<span :style="{'color':props.color}">{{settingsStore.langName}}</span>
			</div>
			<div class="down">
				<van-icon name="arrow-down" :color="props.color"/>
			</div>
		</div>
		<div class="lang-list" v-if="langShow">
			<template  v-for="(item, index) in langList" :key="item.lang">
				<div class="item" @click="handleLocaleChange(item)" :class="settingsStore.locale==item.lang?'cur':''" v-if="item.enable==true">{{item.name}}</div>
			</template>
		</div>
		<div class="mask" v-if="langShow" @click="langShow=false"></div>
	</div>
</template>

<script setup>
	import { ref, watch } from 'vue'
	import { useSettingsStore } from '@/stores/settings'
	import { i18n,getLangList } from '@/i18n'
	
    const langShow       = ref(false)
	const settingsStore  = useSettingsStore()
	const selectedLocale = ref(settingsStore.locale)
	const langList       = getLangList()
	
	const props = defineProps({
		color: {
			type: String,
			default: '#fff'
		}
	})

	// 监听语言变化
	watch(() => i18n.global.locale.value, (newLocale) => {
			selectedLocale.value = newLocale
		}
	)

	// 处理语言切换
	const handleLocaleChange = (item) => {
		selectedLocale.value = item.lang
		settingsStore.setLocale(item.lang,item.name)
		langShow.value = false
	}

	// 初始化时应用主题和字体大小
	settingsStore.applyTheme()
	settingsStore.setFontSize(settingsStore.fontSize)
</script>

<style scoped lang="scss">
	.select-main{
	    position: absolute;
	    right: 0;
	    top: 18px;
	    text-align: center;
	    font-size: 14px;
	    padding: 0;
	    z-index: 999998; 
	}
	
	.select-main .h-box{
	    display: flex;
	    flex-direction: row;
	    align-items: center;
	}
	
	.select-main .lang-curr{
	    padding: 0 10px;
	    height: 28px;
	    line-height: 28px;
	    border-radius: 5px;
	}
	
	.select-main .h-box .txt{
	    margin-left: 7px;
	    margin-right: 7px;
	}
	.select-main .h-box .down img{
		width: 16px;
		display: block;
	}
	
	.select-main .lang-list{
	    position: absolute;
	    top: 35px;
	    left: 0;
	    z-index: 999999;
	    color: #000;
	    background-color: #fff;
	    border: 1px solid rgba(0, 0, 0, .1);
	    border-radius: 8px;
	    box-shadow: 0 8px 20px rgba(0, 0, 0, .12);
	    -moz-box-sizing: border-box;
	    box-sizing: border-box;
	    max-height: 200px;
	    overflow: auto;
	    padding: 4px;
	    width: 100%;
		.item{
			cursor: pointer;
			font-size: 14px;
			font-weight: 700;
			height: 36px;
			line-height: 36px;
			overflow: hidden;
			border-radius: 8px;
			position: relative;
			text-align: center;
			white-space: nowrap;
			width: 100%;
			z-index: 1;
			box-sizing: border-box;
			color: rgba(0, 0, 0, .92);
		}
		.item.cur {
		    background-color: rgba(0, 0, 0, .08);
		}
	}
	.select-main .mask{
		position: fixed;
		z-index: 999;
		top: 0;
		right: 0;
		left: 0;
		bottom: 0;
		background: rgba(0, 0, 0, .5);
		background-color: initial;
	}
</style>