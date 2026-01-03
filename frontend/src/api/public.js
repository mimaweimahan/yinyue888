import { doRequest as request  } from '@/utils/request';

export function getConfig(data, auth = false) {
    return request.post('v1.index/config', data, auth);
}

export const loginApi    = (data) => request.post('/user/login', data); // 登陆
export const registerApi = (data) => request.post('/user/register', data); // 注册
export const logoutApi   = (data) => request.post('/user/logout', data); // 退出
export const editPassApi = (data) => request.post('/v1.user/pwd', data); // 修改密码
export const editPinApi  = (data) => request.post('/v1.user/pin', data); // 修改交易密码
export const noticeApi   = (data) => request.post('/v1.user/notice', data); // 个人公告
export const noticeSeeApi= (data) => request.post('/v1.user/see_notice', data); // 个人公告查看
export const homeNoticeApi = (data) => request.get('/notice/home', data); // 首页公告
export const noticeListApi = (data) => request.get('/notice/index', data); // 公告列表
export const noticeDetailApi = (data) => request.get('/notice/detail', data); // 公告详情

export const goodsIndexApi = (data) => request.get('/goods/index', data); // 首页商品
export const goodsTradingApi = (data) => request.get('/goods/trading', data); // 抢单商品

export const tradingDynamicsApi = (data) => request.get('/trading/dynamics', data); // 交易动态
export const tradingInfoApi     = (data) => request.get('/trading/info', data); // 抢单首页
export const tradingCreateApi   = (data) => request.post('/trading/create', data); // 提交抢单
export const tradingConfirmApi  = (data) => request.post('/trading/confirm', data); // 确认抢单
export const tradingListApi     = (data) => request.get('/trading/list', data); // 确认抢单

export const walletApi = (data) => request.get('/wallet/info', data); // 钱包数据
export const walletLogApi = (data) => request.get('/wallet/log', data); // 账户记录

export const userInfoApi = (data) => request.get('/v1.user/info', data); // 用户数据

export const kfUrlApi = (data) => request.get('/v1.user/kf', data); // 客服链接（登录后使用）
export const kfUrlByAccountApi = (data) => request.get('/v1.user/kf', data, { auth: false }); // 根据账号获取客服链接（不需要登录，传递email或phone参数）
export const appDownloadApi = (data) => request.get('/app_download/index', data); // APP下载
export const clauseIndexApi = (data) => request.get('/clause/index', data); // 条款列表
export const clauseDetailApi = (data) => request.get('/clause/detail', data); // 条款详情
export const eventIndexApi = (data) => request.get('/event/index', data); // 事件列表
export const eventDetailApi = (data) => request.get('/event/detail', data); // 事件详情
export const aboutIndexApi = (data) => request.get('/about/index', data); // 关于我们列表
export const aboutDetailApi = (data) => request.get('/about/detail', data); // 关于我们详情


export const teamInfoApi = (data) => request.get('/v1.team/index', data); // 团队首页
export const teamListApi = (data) => request.get('/v1.team/lst', data); // 团队列表


/*
资产API接口
*/
export const setAddressWithdrawApi = (data) => request.post('/v1.user/setaddress', data); // 设置提现地址
export const walletList = (data)  => request.post('/wallet/list', data); // 我的钱包列表
export const walletOut  = (data)  => request.post('/wallet/out', data); // 我的钱提现
export const rechargeApi = (data) => request.post('/v1.recharge/index', data); 
export const rechargeApprovalApi = (data) => request.post('/v1.recharge/approval', data); // 上传凭证