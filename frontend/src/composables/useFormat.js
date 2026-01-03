/**
 * 格式化工具 Composable
 * 统一管理格式化函数，避免代码重复
 */

/**
 * 格式化金额，保留两位小数
 */
export function useFormatAmount() {
  const formatAmount = (val) => {
    if (val === undefined || val === null || val === '') return '0.00'
    const num = parseFloat(val)
    if (Number.isNaN(num)) return '0.00'
    return num.toFixed(2)
  }
  
  return { formatAmount }
}

/**
 * 格式化数字（通用）
 */
export function useFormatNumber() {
  const formatNumber = (val, decimals = 2) => {
    if (val === undefined || val === null || val === '') return '0.00'
    const num = parseFloat(val)
    if (Number.isNaN(num)) return '0.00'
    return num.toFixed(decimals)
  }
  
  return { formatNumber }
}
