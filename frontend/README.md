# 多语言音乐刷单项目文档

## 📋 目录

- [技术栈](#技术栈)
- [项目结构](#项目结构)
- [功能模块](#功能模块)
- [API 接口文档](#api-接口文档)
- [路由配置](#路由配置)
- [状态管理](#状态管理)
- [国际化支持](#国际化支持)
- [开发指南](#开发指南)

---

## 🛠 技术栈

### 核心框架
- **Vue 3.5.18** - 渐进式 JavaScript 框架
- **Vue Router 4.5.1** - 官方路由管理器
- **Pinia 3.0.3** - Vue 官方状态管理库
- **Vue I18n 11.1.11** - 国际化插件

### UI 组件库
- **Vant 4.9.21** - 轻量、可靠的移动端 Vue 组件库
- **unplugin-vue-components** - 按需自动引入组件

### 构建工具
- **Vite 7.0.6** - 下一代前端构建工具
- **@vitejs/plugin-vue** - Vue 单文件组件支持
- **Sass 1.66.1** - CSS 预处理器

### HTTP 请求
- **Axios 1.5.0** - 基于 Promise 的 HTTP 客户端

### 工具库
- **pinia-plugin-persistedstate 4.5.0** - Pinia 状态持久化插件
- **qrcode 1.5.4** - 二维码生成库
- **qs 6.11.2** - 查询字符串解析和序列化

### 代码规范
- **ESLint 9.31.0** - JavaScript 代码检查工具
- **eslint-plugin-vue 10.3.0** - Vue.js 的 ESLint 插件

---

## 📁 项目结构

```
tikshop-vue/
├── src/
│   ├── api/              # API 接口定义
│   │   └── public.js     # 公共 API 接口
│   ├── assets/           # 静态资源
│   ├── components/       # 公共组件
│   │   ├── BaseButtonPrimary.vue
│   │   ├── BaseInput.vue
│   │   ├── BasePageTransition.vue
│   │   ├── FooterTabbar.vue
│   │   ├── ProductCard.vue
│   │   └── ...
│   ├── composables/      # 组合式函数
│   ├── i18n/             # 国际化配置
│   │   ├── index.js
│   │   └── locales/      # 多语言文件
│   ├── router/           # 路由配置
│   │   └── index.js
│   ├── stores/           # Pinia 状态管理
│   │   ├── user.js       # 用户状态
│   │   └── settings.js   # 设置状态
│   ├── utils/            # 工具函数
│   │   ├── request.js    # HTTP 请求封装
│   │   ├── useWebSocket.js  # WebSocket 封装
│   │   └── common.js     # 通用工具函数
│   ├── views/            # 页面组件
│   │   ├── Index.vue     # 首页
│   │   ├── Trade.vue     # 交易页
│   │   ├── User.vue      # 我的页面
│   │   ├── Login.vue     # 登录页
│   │   ├── Signup.vue    # 注册页
│   │   └── ...
│   ├── App.vue           # 根组件
│   ├── main.js           # 入口文件
│   └── config.js         # 配置文件
├── package.json
└── vite.config.js
```

---

## 🎯 功能模块

### 1. 用户认证模块
- **登录** (`/login`)
  - 支持手机号/邮箱登录
  - 密码登录
  - 国家代码选择
- **注册** (`/signup`)
  - 用户注册
  - 验证码功能
- **退出登录** (`/user`)

### 2. 首页模块 (`/`)
- **顶部公告栏**
  - 显示最新公告标题
  - 右侧循环滑出动画
  - 点击跳转到公告列表
- **欢迎卡片**
  - 显示用户信息
  - 信用评分显示
- **快捷导航**
  - APP下载、证书、提现、充值、记录、团队等
- **视频播放器**
  - 嵌入式 iframe 播放器
- **交易动态滚动**
  - 实时显示交易动态
  - 滚动动画效果

### 3. 交易模块 (`/trade`)
- **轮播图展示**
  - 3D 卡片效果
  - 自动轮播
- **今日收益统计**
  - 实时更新
  - 动画效果
- **账户余额显示**
- **开始匹配按钮**
  - 单次匹配功能
  - 任务进度显示
- **订单记录查看**

### 4. 我的页面 (`/user`)
- **用户信息展示**
  - 头像、账号、信用评分
  - 邀请码（可复制）
  - 今日收益、可用余额
- **功能菜单**
  - 提现 (`/withdraw`)
  - 充值 (`/recharge`)
  - 账户记录 (`/records`)
  - 团队 (`/team`)
  - 提现地址设置
  - KYC认证 (`/authenticator`)
  - 安全码 (`/securitypin`)
  - 语言切换 (`/lang`)
  - 客服 (`/customer-service`)
- **个人公告弹窗**
  - 自动弹出未读公告
  - 确认后标记已读

### 5. 资产管理模块

#### 5.1 提现 (`/withdraw`)
- 提现金额输入
- 手续费计算
- 安全码验证
- 提现地址设置

#### 5.2 充值 (`/recharge`)
- 充值金额选择
- 支付方式选择
- 凭证上传
- 充值记录查看

#### 5.3 账户记录 (`/records`)
- 收支明细
- 记录筛选
- 分页加载

### 6. 团队模块

#### 6.1 团队首页 (`/team`)
- 团队统计信息
- 团队成员列表

#### 6.2 团队详情 (`/teamDetail`)
- 成员详细信息
- 收益统计

### 7. 安全设置模块

#### 7.1 修改密码 (`/password`)
- 当前密码验证
- 新密码设置
- 确认密码

#### 7.2 修改安全码 (`/securitypin`)
- 当前安全码验证
- 新安全码设置
- 确认安全码

#### 7.3 KYC认证 (`/authenticator`)
- 身份认证功能

### 8. 公告模块

#### 8.1 公告列表 (`/notice-list`)
- 显示所有公告
- 标题列表展示
- 点击查看详情

#### 8.2 公告详情 (`/notice-detail`)
- 完整公告内容
- 标题和正文展示

### 9. 其他功能

#### 9.1 语言切换 (`/lang`)
- 多语言支持
- 语言列表选择

#### 9.2 客服 (`/customer-service`)
- 客服链接跳转
- 在线客服功能

#### 9.3 帮助中心 (`/faq`)
- 常见问题
- 帮助文档

#### 9.4 邀请 (`/invite`)
- 邀请码展示
- 邀请链接生成

---

## 🔌 API 接口文档

### 请求封装

所有 API 请求通过 `@/utils/request.js` 封装，自动处理：
- Token 认证（通过 `Authorization` 头）
- 语言设置（通过 `lang` 头）
- 用户ID（通过 `uid` 头）
- 错误拦截和登录跳转

### 接口列表

#### 用户相关接口

##### 1. 用户登录
```javascript
import { loginApi } from '@/api/public'

// 请求参数
const params = {
  account: 'user@example.com',  // 账号（手机号或邮箱）
  password: 'password123',       // 密码
  country_code: '+86'            // 国家代码（可选）
}

// 调用示例
loginApi(params).then(res => {
  console.log('登录成功', res.data)
  // res.data 包含 userInfo 和 token
}).catch(e => {
  console.error('登录失败', e.msg)
})
```

**接口路径**: `POST /user/login`

**响应格式**:
```json
{
  "code": 1,
  "msg": "登录成功",
  "data": {
    "userInfo": {
      "uid": 123,
      "email": "user@example.com",
      "tel": "13800138000",
      "credit_score": 100,
      "balance": 1000.00,
      "invite": "ABC123"
    },
    "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9..."
  }
}
```

##### 2. 用户注册
```javascript
import { registerApi } from '@/api/public'

const params = {
  account: 'user@example.com',
  password: 'password123',
  password2: 'password123',
  country_code: '+86'
}

registerApi(params).then(res => {
  console.log('注册成功', res.msg)
})
```

**接口路径**: `POST /user/register`

##### 3. 退出登录
```javascript
import { logoutApi } from '@/api/public'

logoutApi({}).then(res => {
  console.log('退出成功', res.msg)
})
```

**接口路径**: `POST /user/logout`

##### 4. 获取用户信息
```javascript
import { userInfoApi } from '@/api/public'

userInfoApi({}).then(res => {
  console.log('用户信息', res.data)
})
```

**接口路径**: `GET /v1.user/info`

##### 5. 修改密码
```javascript
import { editPassApi } from '@/api/public'

const params = {
  opassword: 'old_password',  // 旧密码
  password: 'new_password',   // 新密码
  password2: 'new_password'   // 确认新密码
}

editPassApi(params).then(res => {
  console.log('修改成功', res.msg)
})
```

**接口路径**: `POST /v1.user/pwd`

##### 6. 修改安全码（交易密码）
```javascript
import { editPinApi } from '@/api/public'

const params = {
  otranpass: '123456',  // 当前安全码
  ntranpass: '654321',  // 新安全码
  ctranpass: '654321'   // 确认新安全码
}

editPinApi(params).then(res => {
  console.log('修改成功', res.msg)
})
```

**接口路径**: `POST /v1.user/pin`

#### 公告相关接口

##### 7. 首页公告
```javascript
import { homeNoticeApi } from '@/api/public'

// 获取首页公告（最多5条）
homeNoticeApi({ limit: 5 }).then(res => {
  console.log('首页公告', res.data)
  // res.data 是数组，包含公告列表
})
```

**接口路径**: `GET /notice/home`

**请求参数**:
- `limit` (number): 返回数量限制，默认5

**响应格式**:
```json
{
  "code": 1,
  "msg": "success",
  "data": [
    {
      "id": 1,
      "title": "公告标题",
      "content": "公告内容",
      "create_time_text": "2024-01-01 12:00:00",
      "show_home": 1
    }
  ]
}
```

##### 8. 公告列表
```javascript
import { noticeListApi } from '@/api/public'

// 获取所有公告
noticeListApi({ limit: 100 }).then(res => {
  console.log('公告列表', res.data)
})
```

**接口路径**: `GET /notice/index`

**请求参数**:
- `limit` (number): 返回数量限制
- `show_home` (number, 可选): 是否只显示首页公告，1=是，不传=全部

##### 9. 公告详情
```javascript
import { noticeDetailApi } from '@/api/public'

// 获取公告详情
noticeDetailApi({ id: 1 }).then(res => {
  console.log('公告详情', res.data)
})
```

**接口路径**: `GET /notice/detail`

**请求参数**:
- `id` (number): 公告ID

##### 10. 个人公告
```javascript
import { noticeApi } from '@/api/public'

noticeApi({}).then(res => {
  console.log('个人公告', res.data)
})
```

**接口路径**: `POST /v1.user/notice`

##### 11. 标记个人公告已读
```javascript
import { noticeSeeApi } from '@/api/public'

noticeSeeApi({ uid: 'notice_id' }).then(res => {
  console.log('已标记已读', res.msg)
})
```

**接口路径**: `POST /v1.user/see_notice`

#### 商品相关接口

##### 12. 首页商品
```javascript
import { goodsIndexApi } from '@/api/public'

goodsIndexApi({}).then(res => {
  console.log('首页商品', res.data)
})
```

**接口路径**: `GET /goods/index`

##### 13. 抢单商品
```javascript
import { goodsTradingApi } from '@/api/public'

goodsTradingApi({}).then(res => {
  console.log('抢单商品', res.data)
})
```

**接口路径**: `GET /goods/trading`

#### 交易相关接口

##### 14. 交易首页信息
```javascript
import { tradingInfoApi } from '@/api/public'

tradingInfoApi({}).then(res => {
  console.log('交易信息', res.data)
  // 包含任务信息、钱包信息、轮播图等
})
```

**接口路径**: `GET /trading/info`

**响应格式**:
```json
{
  "code": 1,
  "data": {
    "task": {
      "task_revenue": 100.50,
      "task_done": 5,
      "task_num": 10
    },
    "wallet": {
      "balance": 1000.00,
      "total_balance": 1500.00
    },
    "banner": [
      {
        "image": "https://example.com/banner.jpg",
        "title": "轮播图标题",
        "desc": "描述"
      }
    ]
  }
}
```

##### 15. 提交抢单
```javascript
import { tradingCreateApi } from '@/api/public'

const params = {
  goods_id: 1,      // 商品ID
  security: '123456' // 安全码
}

tradingCreateApi(params).then(res => {
  console.log('抢单成功', res.msg)
})
```

**接口路径**: `POST /trading/create`

##### 16. 确认抢单
```javascript
import { tradingConfirmApi } from '@/api/public'

const params = {
  order_id: 123,
  security: '123456'
}

tradingConfirmApi(params).then(res => {
  console.log('确认成功', res.msg)
})
```

**接口路径**: `POST /trading/confirm`

##### 17. 交易列表
```javascript
import { tradingListApi } from '@/api/public'

tradingListApi({ page: 1, limit: 20 }).then(res => {
  console.log('交易列表', res.data)
})
```

**接口路径**: `GET /trading/list`

##### 18. 交易动态
```javascript
import { tradingDynamicsApi } from '@/api/public'

tradingDynamicsApi({}).then(res => {
  console.log('交易动态', res.data)
})
```

**接口路径**: `GET /trading/dynamics`

#### 钱包相关接口

##### 19. 钱包信息
```javascript
import { walletApi } from '@/api/public'

walletApi({}).then(res => {
  console.log('钱包信息', res.data)
})
```

**接口路径**: `GET /wallet/info`

##### 20. 账户记录
```javascript
import { walletLogApi } from '@/api/public'

walletLogApi({ page: 1, limit: 20 }).then(res => {
  console.log('账户记录', res.data)
})
```

**接口路径**: `GET /wallet/log`

**请求参数**:
- `page` (number): 页码
- `limit` (number): 每页数量

##### 21. 钱包列表
```javascript
import { walletList } from '@/api/public'

walletList({}).then(res => {
  console.log('钱包列表', res.data)
})
```

**接口路径**: `POST /wallet/list`

##### 22. 提现
```javascript
import { walletOut } from '@/api/public'

const params = {
  amount: 100.00,      // 提现金额
  security: '123456'   // 安全码
}

walletOut(params).then(res => {
  console.log('提现成功', res.msg)
})
```

**接口路径**: `POST /wallet/out`

##### 23. 设置提现地址
```javascript
import { setAddressWithdrawApi } from '@/api/public'

const params = {
  address_withdraw: 'TRX地址或ERC地址'
}

setAddressWithdrawApi(params).then(res => {
  console.log('设置成功', res.msg)
})
```

**接口路径**: `POST /v1.user/setaddress`

#### 充值相关接口

##### 24. 充值首页
```javascript
import { rechargeApi } from '@/api/public'

rechargeApi({}).then(res => {
  console.log('充值信息', res.data)
})
```

**接口路径**: `POST /v1.recharge/index`

##### 25. 上传充值凭证
```javascript
import { rechargeApprovalApi } from '@/api/public'

const params = {
  recharge_id: 123,
  image: 'base64图片数据或图片URL'
}

rechargeApprovalApi(params).then(res => {
  console.log('上传成功', res.msg)
})
```

**接口路径**: `POST /v1.recharge/approval`

#### 团队相关接口

##### 26. 团队首页
```javascript
import { teamInfoApi } from '@/api/public'

teamInfoApi({}).then(res => {
  console.log('团队信息', res.data)
})
```

**接口路径**: `GET /v1.team/index`

##### 27. 团队列表
```javascript
import { teamListApi } from '@/api/public'

teamListApi({ page: 1, limit: 20 }).then(res => {
  console.log('团队列表', res.data)
})
```

**接口路径**: `GET /v1.team/lst`

#### 其他接口

##### 28. 客服链接
```javascript
import { kfUrlApi } from '@/api/public'

kfUrlApi({}).then(res => {
  console.log('客服链接', res.data.url)
})
```

**接口路径**: `GET /v1.user/kf`

##### 29. 系统配置
```javascript
import { getConfig } from '@/api/public'

getConfig({}, false).then(res => {
  console.log('系统配置', res.data)
})
```

**接口路径**: `POST v1.index/config`

---

## 🛣 路由配置

### 路由列表

| 路径 | 名称 | 组件 | 说明 | 需要登录 |
|------|------|------|------|---------|
| `/` | home | Index.vue | 首页 | ✅ |
| `/trade` | trade | Trade.vue | 交易页 | ✅ |
| `/list` | list | List.vue | 列表页 | ✅ |
| `/user` | user | User.vue | 我的页面 | ✅ |
| `/withdraw` | withdraw | Withdraw.vue | 提现 | ✅ |
| `/login` | login | Login.vue | 登录 | ❌ |
| `/signup` | signup | Signup.vue | 注册 | ❌ |
| `/lang` | lang | Lang.vue | 语言切换 | ❌ |
| `/password` | password | Password.vue | 修改密码 | ✅ |
| `/securitypin` | securitypin | Securitypin.vue | 修改安全码 | ✅ |
| `/faq` | faq | Faq.vue | 帮助中心 | ✅ |
| `/team` | team | Team.vue | 团队首页 | ✅ |
| `/teamDetail` | teamDetail | TeamDetail.vue | 团队详情 | ✅ |
| `/authenticator` | authenticator | Authenticator.vue | KYC认证 | ✅ |
| `/records` | records | Records.vue | 账户记录 | ✅ |
| `/recharge` | recharge | Recharge.vue | 充值 | ✅ |
| `/invite` | invite | Invite.vue | 邀请 | ✅ |
| `/customer-service` | customer-service | CustomerService.vue | 客服 | ✅ |
| `/notice-list` | notice-list | NoticeList.vue | 公告列表 | ✅ |
| `/notice-detail` | notice-detail | NoticeDetail.vue | 公告详情 | ✅ |

### 路由守卫

所有路由（除登录、注册、语言切换外）都需要登录验证：

```javascript
// 白名单路由（不需要登录）
const pulicRouterList = ['login', 'signup', 'lang']

// 路由守卫
router.beforeEach(async (to, from, next) => {
  if (pulicRouterList.includes(to.name)) {
    next();
  } else {
    const userStore = useUserStore()
    if (!userStore.isAuthenticated) {
      userStore.logout()
      next({name: 'login' })
    } else {
      next()
    }
  }
})
```

---

## 💾 状态管理

### Pinia Stores

#### 1. User Store (`stores/user.js`)

管理用户登录状态和信息：

```javascript
import { useUserStore } from '@/stores/user'

const userStore = useUserStore()

// 状态
userStore.token          // 用户 token
userStore.isLogin        // 是否登录
userStore.userInfo       // 用户信息对象

// Getters
userStore.isAuthenticated  // 是否已认证（等同于 isLogin）

// Actions
userStore.login(userData, token)      // 登录
userStore.updateUserInfo(userData)    // 更新用户信息
userStore.logout()                     // 退出登录
userStore.updateToken(str)            // 更新 token
```

**用户信息结构**:
```javascript
{
  uid: 123,
  email: 'user@example.com',
  tel: '13800138000',
  username: 'username',
  avatar: '头像URL',
  invite: '邀请码',
  credit_score: 100,
  balance: 1000.00,
  address_withdraw: '提现地址'
}
```

**持久化**: 用户信息和 token 会自动保存到 localStorage

#### 2. Settings Store (`stores/settings.js`)

管理应用设置：

```javascript
import { useSettingsStore } from '@/stores/settings'

const settingsStore = useSettingsStore()

// 状态
settingsStore.locale  // 当前语言设置

// Actions
settingsStore.setLocale('zh')  // 设置语言
```

---

## 🌍 国际化支持

### 支持的语言

项目支持多语言，语言文件位于 `src/i18n/locales/`：

- `zh.json` - 中文（简体）
- `en.json` - 英文
- `ja.json` - 日语
- `ko.json` - 韩语（han.json）
- `es.json` - 西班牙语
- `de.json` - 德语
- `fr.json` - 法语（fy.json）
- `it.json` - 意大利语
- `pt.json` - 葡萄牙语（pu.json）
- `ru.json` - 俄语（ey.json）
- `tr.json` - 土耳其语（tu.json）
- `th.json` - 泰语（tai.json）
- `vi.json` - 越南语（yn.json）
- `ar.json` - 阿拉伯语（al.json）

### 使用方式

```javascript
import { i18n } from '@/i18n'

const { t } = i18n.global

// 在模板中使用
{{ t('home.hello') }}

// 在脚本中使用
const message = t('common.save')
```

### 语言切换

```javascript
import { useSettingsStore } from '@/stores/settings'
import { i18n } from '@/i18n'

const settingsStore = useSettingsStore()

// 切换语言
settingsStore.setLocale('en')
i18n.global.locale.value = 'en'
```

---

## 🔧 开发指南

### 环境变量配置

创建 `.env` 文件：

```env
VITE_API_URL=https://api.example.com/api
VITE_PUBLIC_PATH=/h5/
VITE_WEBSCOKET_URL=wss://api.example.com/ws/
```

### 启动开发服务器

```bash
npm install
npm run dev
```

### 构建生产版本

```bash
npm run build
```

### 代码规范检查

```bash
npm run lint
```

### HTTP 请求封装

所有 API 请求统一使用 `@/api/public.js` 中定义的接口：

```javascript
import { userInfoApi } from '@/api/public'

// 自动携带 token、lang、uid
userInfoApi({}).then(res => {
  // res.code === 1 表示成功
  // res.data 包含数据
}).catch(e => {
  // e.msg 包含错误信息
})
```

### WebSocket 连接

项目使用 WebSocket 实现实时通信：

```javascript
import { useWebSocket } from '@/utils/useWebSocket'
import config from '@/config'

const { websocket, isConnected } = useWebSocket(config.baseWsUrl)

// 初始化连接
websocket.init()

// 发送消息
websocket.send({ type: 'ping', uid: user_id })

// 监听消息
websocket.on('message', (data) => {
  console.log('收到消息', data)
})

// 关闭连接
websocket.close()
```

### 组件使用规范

#### Vant 组件按需引入

项目配置了 `unplugin-vue-components`，Vant 组件会自动按需引入：

```vue
<template>
  <!-- 直接使用，无需 import -->
  <van-button type="primary">按钮</van-button>
  <van-field v-model="value" placeholder="输入框" />
</template>
```

#### 自定义组件

公共组件位于 `src/components/`，使用时需要导入：

```vue
<script setup>
import FooterTabbar from '@/components/FooterTabbar.vue'
import BaseInput from '@/components/BaseInput.vue'
</script>
```

### 样式规范

- 使用 **SCSS** 预处理器
- 组件样式使用 `<style scoped lang="scss">`
- 响应式设计使用 `@media` 查询
- 移动端适配使用 `env(safe-area-inset-top/bottom)`

### 工具函数

#### 金额格式化

```javascript
import { formatAmount } from '@/utils/common'

formatAmount(1000.5)  // "1000.50"
formatAmount(null)     // "0.00"
```

#### 复制到剪贴板

```javascript
import { copyValue } from '@/utils/common'

copyValue('要复制的文本')
```

#### 邮箱验证

```javascript
import { validateEmail } from '@/utils/common'

validateEmail('user@example.com')  // true/false
```

---

## 📱 移动端适配

### 视口设置

- 使用 `100dvh` 和 `100vh` 确保全屏显示
- 支持安全区域适配（iOS 刘海屏等）

### 响应式断点

- `@media (max-width: 600px)` - 移动端样式
- `@media (max-width: 480px)` - 小屏移动端
- `@media (max-width: 430px)` - 超小屏

### 横屏提示

当设备横屏时会显示提示，引导用户旋转屏幕。

---

## 🔐 安全特性

### Token 认证

- 所有需要登录的接口自动携带 `Authorization` 头
- Token 存储在 localStorage，页面刷新后自动恢复

### 路由守卫

- 未登录用户访问受保护路由会自动跳转到登录页
- Token 过期（状态码 410000/410001/410002）自动登出

### 密码安全

- 密码输入框使用 `type="password"` 隐藏输入
- 安全码（交易密码）独立管理
- 不支持文本选择（防止密码泄露）

---

## 📊 数据流

### 用户登录流程

```
1. 用户输入账号密码
2. 调用 loginApi
3. 成功后保存 userInfo 和 token 到 Pinia Store
4. Store 自动持久化到 localStorage
5. 跳转到首页
```

### API 请求流程

```
1. 调用 API 函数（如 userInfoApi）
2. request.js 自动添加 headers（token, lang, uid）
3. axios 发送请求
4. 响应拦截器处理：
   - code === 1: 返回 res.data
   - code !== 1: reject 错误信息
   - 状态码 410000/410001/410002: 自动跳转登录
5. 组件处理响应或错误
```

---

## 🎨 UI/UX 特性

### 设计风格

- 深色主题（黑色背景）
- 玻璃拟态效果（Glassmorphism）
- 渐变按钮和卡片
- 流畅的动画过渡

### 动画效果

- 页面切换过渡动画
- 按钮点击反馈
- 滚动动画
- 加载状态动画

### 交互反馈

- Toast 提示（成功/失败）
- Loading 加载状态
- 按钮禁用状态
- 表单验证提示

---

## 📝 注意事项

1. **API 响应格式**: 所有接口返回 `code === 1` 表示成功，否则为失败
2. **错误处理**: 使用 `catch` 捕获错误，错误对象包含 `msg` 字段
3. **Token 管理**: Token 会自动添加到请求头，无需手动处理
4. **语言切换**: 语言设置会影响 API 请求的 `lang` 头
5. **WebSocket**: 需要在组件挂载时初始化，卸载时关闭
6. **路由守卫**: 除白名单路由外，所有路由都需要登录
7. **状态持久化**: User Store 和 Settings Store 会自动持久化

---

## 🔄 更新日志

### 最新更新

- ✅ 修复安全码页面无法输入的问题
- ✅ 添加 loading 状态处理
- ✅ 优化公告列表和详情页面
- ✅ 实现首页公告右侧循环滑出动画
- ✅ 完善错误处理和调试信息显示

---

## 📞 技术支持

如有问题，请联系开发团队或查看项目文档。

