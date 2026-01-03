<template>
	<van-popup v-model:show="popupShow" ba position="bottom" @close="handleClose" :style="{ height: '70%', backgroundColor:'#f8f8f8' }">
		<div class="select-modal-box">
			<div class="search-box">
				<van-field v-model="searchQuery" left-icon="search" class="input" placeholder="Search country/region name or code" />
			</div>
			<div class="country-code-list">
				<div v-for="(item,index) in countryCodeItems" @click="onActiveCountryCode(item)" class="item" :class="curCode==item.code?'cur':''" >
					<span>{{item.name}}</span>
					<span>+{{item.code}}</span>
				</div>
				<div class="item"></div>
			</div>
		</div>
	</van-popup>
</template>
<!--Demo <CountryCode v-model:show="countryModel" /> -->
<script setup>
	import { ref, watch ,computed } from 'vue'
	import { countryCodeList } from '@/utils/countryCode' 
	const searchQuery  = ref('') //搜索词
	const active  = ref({}) //选择的数据
	
	// 定义自定义事件，用于通知父组件更新show值
	const emits = defineEmits(['update:show','update:code', 'onCountrySelect']) 
	const data  = countryCodeList()
	const props = defineProps({
		show: {
			type: Boolean,
			default: false
		},
		code: {
			type: String,
			default: ''
		}
	})
	
	const popupShow  = ref(props.show)
	const curCode    = ref(props.code) //选择的code
	// 监听父组件props变化，同步到子组件内部状态
	watch( () => props.show,(newVal) => {
	    popupShow.value = newVal
	})
	
	// 处理弹窗关闭事件
	const handleClose = () => {
	  // 通知父组件关闭弹窗
	  //console.log('popupShow',popupShow.value)
	  emits('update:show', false)
	  emits('update:code', curCode.value)
	}
	
	const countryCodeItems = computed(() => {
		if(searchQuery.value){
			// 判断输入是否为纯数字
			const isNumber = /^\d+$/.test(searchQuery.value);
			if(isNumber){
				return data.filter(item => {
					return item.code.toLowerCase().includes(searchQuery.value.toLowerCase())
				})
			}else{
				return data.filter(item => {
					return item.name.toLowerCase().includes(searchQuery.value.toLowerCase())
				})
			}
		}else{
			return data
		}
	})
	
	//代码选择
	const onActiveCountryCode = (item) =>{
		active.value  = item
		curCode.value = item.code
		popupShow.value = false
		emits('onCountrySelect', item)
	}
	
</script>

<style scoped lang="scss">
	.select-modal-box{
		height: 100%;
		.search-box{
			display: flex;
			align-items: center;
			padding: 10px 10px;
			.van-icon{ color: #ccc; }
			.input{
				border: 1px solid #ccc;
				border-radius: 3px;
				padding: 5px 10px;
			}
		}
		.country-code-list{
			width: 100%;
			height: calc(100% - 56px);
			overflow-y: auto;
			.item{
				display: flex;
				justify-content: space-between;
				padding: 10px 20px;
			}
			.item.cur{
				color: #009995;
			}
		}
	}
</style>