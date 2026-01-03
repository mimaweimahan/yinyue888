const fs = require('fs');
const path = require('path');
const dir = path.join('src', 'i18n', 'locales');

const translations = {
  al: { lang_switch: 'إعدادات اللغة', today_profit: 'إيرادات هذه الجولة (USD)', withdraw_address: 'عنوان السحب', kyc: 'المصادقة', customer_service: 'خدمة العملاء' },
  de: { lang_switch: 'Spracheinstellungen', today_profit: 'Rundenerlös (USD)', withdraw_address: 'Auszahlungsadresse', kyc: 'KYC', customer_service: 'Kundenservice' },
  en: { lang_switch: 'Language Settings', today_profit: 'Round revenue (USD)', withdraw_address: 'Withdraw Address', kyc: 'KYC', customer_service: 'Customer Service' },
  es: { lang_switch: 'Configuración de idioma', today_profit: 'Ingresos de ronda (USD)', withdraw_address: 'Dirección de retiro', kyc: 'KYC', customer_service: 'Servicio al cliente' },
  ey: { lang_switch: 'Language Settings', today_profit: 'Round revenue (USD)', withdraw_address: 'Withdraw Address', kyc: 'KYC', customer_service: 'Customer Service' },
  fy: { lang_switch: 'Language Settings', today_profit: 'Round revenue (USD)', withdraw_address: 'Withdraw Address', kyc: 'KYC', customer_service: 'Customer Service' },
  han: { lang_switch: '언어 설정', today_profit: '라운드 수익 (USD)', withdraw_address: '출금 주소', kyc: 'KYC', customer_service: '고객 서비스' },
  it: { lang_switch: 'Impostazioni lingua', today_profit: 'Entrate round (USD)', withdraw_address: 'Indirizzo prelievo', kyc: 'KYC', customer_service: 'Servizio clienti' },
  ja: { lang_switch: '言語設定', today_profit: 'ラウンド収益 (USD)', withdraw_address: '出金アドレス', kyc: 'KYC', customer_service: 'カスタマーサービス' },
  pu: { lang_switch: 'Configurações de idioma', today_profit: 'Receita da rodada (USD)', withdraw_address: 'Endereço de saque', kyc: 'KYC', customer_service: 'Atendimento ao cliente' },
  tai: { lang_switch: 'Language Settings', today_profit: 'Round revenue (USD)', withdraw_address: 'Withdraw Address', kyc: 'KYC', customer_service: 'Customer Service' },
  tu: { lang_switch: 'Dil ayarları', today_profit: 'Tur geliri (USD)', withdraw_address: 'Para çekme adresi', kyc: 'KYC', customer_service: 'Müşteri hizmetleri' },
  yn: { lang_switch: 'Cài đặt ngôn ngữ', today_profit: 'Doanh thu vòng (USD)', withdraw_address: 'Địa chỉ rút tiền', kyc: 'KYC', customer_service: 'Dịch vụ khách hàng' }
};

const files = fs.readdirSync(dir).filter(f => f.endsWith('.json') && f !== 'zh.json');
for (const f of files) {
  const p = path.join(dir, f);
  const data = JSON.parse(fs.readFileSync(p, 'utf8'));
  const lang = f.replace('.json', '');
  const tr = translations[lang] || translations.en;
  
  if (data.lang && data.lang.lang_switch) {
    if (data.lang.lang_switch === '语言设置' || !data.lang.lang_switch) {
      data.lang.lang_switch = tr.lang_switch;
    }
  }
  
  if (data.mine) {
    if (data.mine.today_profit === '本轮收益 (USD)' || data.mine.today_profit === '本轮收益(USD)') {
      data.mine.today_profit = tr.today_profit;
    }
    if (data.mine.withdraw_address === '提现地址') {
      data.mine.withdraw_address = tr.withdraw_address;
    }
    if (data.mine.kyc === '实名认证') {
      data.mine.kyc = tr.kyc;
    }
    if (data.mine.customer_service === '客服') {
      data.mine.customer_service = tr.customer_service;
    }
  }
  
  fs.writeFileSync(p, JSON.stringify(data, null, 2), 'utf8');
  console.log('updated', f);
}

