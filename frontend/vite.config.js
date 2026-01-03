import { fileURLToPath, URL } from 'node:url'
import {defineConfig,loadEnv } from 'vite'
import vue from '@vitejs/plugin-vue'
import vueDevTools from 'vite-plugin-vue-devtools'
import Components from 'unplugin-vue-components/vite'
import { VantResolver } from 'unplugin-vue-components/resolvers'
import path from "path";

// https://vite.dev/config/
export default defineConfig(({mode}) => {
	const env = loadEnv(mode, process.cwd())
	// 开发环境中使用根路径，生产环境使用配置的 basePath
	const basePath = mode === 'development' ? '/' : (env.VITE_PUBLIC_PATH || '/h5/')
	return {
	  base: basePath,
	  plugins: [
		vue(),
		//vueDevTools()
		// Vant 按需引入，自动导入组件
		Components({
		  resolvers: [VantResolver()],
		  // 自动导入的组件类型声明
		  dts: true,
		}),
	  ],
	  server: {
		  port: env.VITE_PORT || 8080,// 设置服务启动端口号,
		  host: true,
		  open: true, // 自动打开浏览器
		  proxy: {
			  // 将请求代理到另一个服务器
			  '/api': {
				  target: env.VITE_PROXY_URL,// 这是你要跨域请求的地址前缀
				  changeOrigin: true,// 开启跨域
				  secure: false, // 不验证ssl
				  //rewrite: path => path.replace(/^\/api/, ''),//去除前缀api
			  }
		  }
	  },
	  resolve: {
		alias: {
			'~': path.resolve(__dirname, './'), // 设置别名
			'@': fileURLToPath(new URL('./src', import.meta.url))
		},
	  },
	  // 构建优化
	  build: {
		// 构建前清空输出目录
		emptyOutDir: true,
		// 启用 CSS 代码拆分
		cssCodeSplit: true,
		// 生产环境移除 console
		minify: 'terser',
		terserOptions: {
		  compress: {
			drop_console: true,
			drop_debugger: true,
		  },
		},
		// CSS 压缩配置
		cssMinify: 'esbuild',
		// 分包策略（按需引入后，vant 会自动拆分，不需要手动配置）
		rollupOptions: {
		  output: {
			manualChunks: {
			  'vue-vendor': ['vue', 'vue-router', 'pinia'],
			},
		  },
		},
	  },
	}
})