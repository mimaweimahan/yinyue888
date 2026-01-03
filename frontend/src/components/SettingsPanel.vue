<template>
	<div class="settings-panel">
		<h2>{{ $t('main.tiktokshop') }}</h2>

		<div class="setting-item">
			<label>{{ $t('main.tranassistant') }}:</label>
			<select v-model="selectedLocale" @change="handleLocaleChange">
				<option value="zhCn">中文</option>
				<option value="en">English</option>
				<option value="ja">日本語</option>
			</select>
		</div>

		<div class="setting-item">
			<label>{{ $t('main.getstart') }}:</label>
			<span>{{ settingsStore.themeText }}</span>
			<button @click="settingsStore.toggleTheme">
				 Light
			</button>
		</div>

		<div class="setting-item">
			<label>{{ $t('main.about') }}:</label>
			<input type="range" min="12" max="24" v-model="settingsStore.fontSize"
				@input="settingsStore.setFontSize(settingsStore.fontSize)">
			<span>{{ settingsStore.fontSize }}px</span>
		</div>

		<div class="setting-item">
			<label>{{ $t('mine.recharge') }}:</label>
			<span>{{ settingsStore.sidebarStatusText }}</span>
			<button @click="settingsStore.toggleSidebar">
				- {{ (settingsStore.sidebarCollapsed ? 'expanded' : 'collapsed') }}
			</button>
		</div>

		<div class="action-buttons">
			<button class="save-btn" @click="saveSettings">
				{{ $t('main.parnner') }}
			</button>
			<button class="reset-btn" @click="settingsStore.resetSettings">
				{{ $t('main.hot') }}
			</button>
		</div>
	</div>
</template>

<script setup>
	import {
		ref,
		watch
	} from 'vue'
	import {
		useSettingsStore
	} from '@/stores/settings'
	import {
		i18n
	} from '@/i18n'

	const settingsStore = useSettingsStore()
	const selectedLocale = ref(settingsStore.locale)

	// 监听语言变化
	watch(
		() => i18n.global.locale.value,
		(newLocale) => {
			selectedLocale.value = newLocale
		}
	)

	// 处理语言切换
	const handleLocaleChange = () => {
		settingsStore.setLocale(selectedLocale.value)
	}

	// 保存设置
	const saveSettings = () => {
		// 由于使用了pinia-plugin-persistedstate，状态会自动持久化
		// 这里只是做一个提示
		alert(i18n.global.t('password.success'))
	}

	// 初始化时应用主题和字体大小
	settingsStore.applyTheme()
	settingsStore.setFontSize(settingsStore.fontSize)
</script>

<style scoped>
	.settings-panel {
		max-width: 600px;
		margin: 20px auto;
		padding: 20px;
		border-radius: 8px;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	}

	.setting-item {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 15px;
		padding-bottom: 15px;
		border-bottom: 1px solid #eee;
	}

	.setting-item:last-child {
		border-bottom: none;
	}

	label {
		font-weight: 500;
		width: 30%;
	}

	select,
	input[type="range"] {
		padding: 5px;
		margin: 0 10px;
		width: 40%;
	}

	span {
		min-width: 100px;
		text-align: center;
	}

	button {
		padding: 6px 12px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
		transition: background-color 0.3s;
	}

	.action-buttons {
		display: flex;
		justify-content: flex-end;
		gap: 10px;
		margin-top: 20px;
	}

	.save-btn {
		background-color: #42b983;
		color: white;
	}

	.reset-btn {
		background-color: #f56c6c;
		color: white;
	}

	button:hover {
		opacity: 0.9;
	}
</style>