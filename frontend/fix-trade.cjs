const fs = require('fs');
const path = require('path');
const dir = path.join('src', 'i18n', 'locales');

const translations = {
  al: { records: 'سجلات الطلبات', today_income: 'إيرادات هذه الجولة (USD)', auto_update: 'تحديث الإيرادات اليومية تلقائيًا', balance_tip: 'سيتم إضافة ربح كل تطبيق إلى إجمالي رصيد الأصول', start_single: 'بدء مطابقة واحدة' },
  de: { records: 'Bestellhistorie', today_income: 'Einnahmen dieser Runde (USD)', auto_update: 'Tägliche Einnahmen automatisch aktualisieren', balance_tip: 'Der Gewinn jeder App wird zum Gesamtvermögenssaldo hinzugefügt', start_single: 'Einzelnes Matching starten' },
  en: { records: 'Order Records', today_income: 'Round revenue (USD)', auto_update: 'Daily income auto update', balance_tip: 'Each app\'s profit will be added to the total asset balance', start_single: 'Single start matching' },
  es: { records: 'Registro de pedidos', today_income: 'Ingresos de esta ronda (USD)', auto_update: 'Actualización automática de ingresos diarios', balance_tip: 'Las ganancias de cada aplicación se agregarán al saldo total de activos', start_single: 'Iniciar coincidencia única' },
  ey: { records: 'Order Records', today_income: 'Round revenue (USD)', auto_update: 'Daily income auto update', balance_tip: 'Each app\'s profit will be added to the total asset balance', start_single: 'Single start matching' },
  fy: { records: 'Order Records', today_income: 'Round revenue (USD)', auto_update: 'Daily income auto update', balance_tip: 'Each app\'s profit will be added to the total asset balance', start_single: 'Single start matching' },
  han: { records: '주문 기록', today_income: '이번 라운드 수익 (USD)', auto_update: '일일 수익 자동 업데이트', balance_tip: '각 앱의 수익은 총 자산 잔액에 추가됩니다', start_single: '단일 매칭 시작' },
  it: { records: 'Registro ordini', today_income: 'Entrate del round (USD)', auto_update: 'Aggiornamento automatico entrate giornaliere', balance_tip: 'Il profitto di ogni app verrà aggiunto al saldo totale delle attività', start_single: 'Avvia corrispondenza singola' },
  ja: { records: '注文記録', today_income: '今ラウンドの収益 (USD)', auto_update: '日次収益の自動更新', balance_tip: '各アプリの利益は総資産残高に追加されます', start_single: '単一マッチング開始' },
  pu: { records: 'Registro de pedidos', today_income: 'Receita da rodada (USD)', auto_update: 'Atualização automática de receita diária', balance_tip: 'O lucro de cada app será adicionado ao saldo total de ativos', start_single: 'Iniciar correspondência única' },
  tai: { records: 'บันทึกคำสั่งซื้อ', today_income: 'รายได้ของรอบ (USD)', auto_update: 'อัปเดตรายได้รายวันอัตโนมัติ', balance_tip: 'กำไรของแต่ละแอปจะถูกเพิ่มเข้าไปในยอดรวมสินทรัพย์', start_single: 'เริ่มการจับคู่ครั้งเดียว' },
  tu: { records: 'Sipariş kayıtları', today_income: 'Bu tur geliri (USD)', auto_update: 'Günlük gelir otomatik güncelleme', balance_tip: 'Her uygulamanın karı toplam varlık bakiyesine eklenecektir', start_single: 'Tek eşleştirme başlat' },
  yn: { records: 'Hồ sơ đơn hàng', today_income: 'Doanh thu vòng này (USD)', auto_update: 'Cập nhật doanh thu hàng ngày tự động', balance_tip: 'Lợi nhuận của mỗi ứng dụng sẽ được thêm vào tổng số dư tài sản', start_single: 'Bắt đầu ghép đơn' }
};

const files = fs.readdirSync(dir).filter(f => f.endsWith('.json') && f !== 'zh.json');
for (const f of files) {
  const p = path.join(dir, f);
  const data = JSON.parse(fs.readFileSync(p, 'utf8'));
  const lang = f.replace('.json', '');
  const tr = translations[lang] || translations.en;
  
  if (data.trade) {
    if (data.trade.records === '订单记录') {
      data.trade.records = tr.records;
    }
    if (data.trade.today_income === '本轮收益(USD)' || data.trade.today_income === '今日收益(USD)') {
      data.trade.today_income = tr.today_income;
    }
    if (data.trade.auto_update === '每日收益自动更新') {
      data.trade.auto_update = tr.auto_update;
    }
    if (data.trade.balance_tip === '每个应用的利润将添加到总资产余额中') {
      data.trade.balance_tip = tr.balance_tip;
    }
    if (data.trade.start_single === '单次开始匹配') {
      data.trade.start_single = tr.start_single;
    }
  }
  
  fs.writeFileSync(p, JSON.stringify(data, null, 2), 'utf8');
  console.log('updated', f);
}

