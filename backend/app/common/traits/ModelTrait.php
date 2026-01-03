<?php
declare (strict_types = 1);
/**
 * Explain: 模型继承
 */
namespace app\common\traits;
use think\db\Query;
use think\Model;
trait ModelTrait
{
    public static function get($where)
    {
        if (!is_array($where)) {
            return self::find($where);
        } else {
            return self::where($where)->find();
        }
    }

    /**
     * 获取一条数据
     * @param $where
     * @param $field
     * @param $with
     * @param $order
     * @return array|Model|null
     */
    public static function getToArray($where,$field='',$with=[],$order='')
    {
        if (!is_array($where)) {
            $data = self::with($with)->field($field)->order($order)->find($where);
        }else{
            $data = self::with($with)->where($where)->field($field)->order($order)->find();
        }
        if($data){
            $data = $data->toArray();
        }
        return $data;
    }

    public static function all($function)
    {
        $query = self::newQuery();
        $function($query);
        return $query->select();
    }

    /**
     * 添加多条数据
     * @param $group
     * @param int $replace
     * @return mixed
     */
    public static function setAll($group, $replace = 0)
    {
        return self::insertAll($group, (int)$replace);
    }
		

    /**
     * 修改一条数据
     * @param $data
     * @param $id
     * @param $field
     * @return bool $type 返回成功失败
     */
    public static function edit($data, $id, $field = null)
    {
        $model = new self;
        if (!$field) $field = $model->getPk();
        $res = $model->update($data, [$field => $id]);
        if (isset($res->result))
            return 0 < $res->result;
        else if (isset($res['data']['result']))
            return 0 < $res['data']['result'];
        else
            return false !== $res;
    }

    /**
     * 查询一条数据是否存在
     * @param $map
     * @param string $field
     * @return bool 是否存在
     */
    public static function be($map, $field = '')
    {
        $model = (new self);
        if (!is_array($map) && empty($field)) $field = $model->getPk();
        $map = !is_array($map) ? [$field => $map] : $map;
        return 0 < $model->where($map)->count();
    }

    /**
     * 删除一条数据
     * @param $id
     * @return bool $type 返回成功失败
     */
    public static function del($id)
    {
        return false !== self::destroy($id);
    }

    /**
     * 获取列表（分页）
     * @param array $where
     * @param string $order
     * @param int $limit
     * @param array $params
     * @param array $with
     * @param string $field
     * @return mixed
     */
    public static function getListPage($where = [], $limit = 20,$order='id desc',$params=[],$with=[],$field=''){
        if (count($with)>0){
            return self::with($with)->where($where)->field($field)->order($order)->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
        }
        return self::where($where)->order($order)->field($field)->paginate(['list_rows' => $limit,'query' =>$params], false)->toArray();
    }

    /**
     * 获取列表（分页）
     * @param array $where
     * @param string $order
     * @param int $limit
     * @param array $params
     * @param array $with
     * @return mixed
     */
    public static function getListPageObj($where = [], $limit = 20,$order='id desc',$params=[],$with=[]){
        return self::where($where)->order($order)->paginate(['list_rows' => $limit,'query' =>$params], false);
    }

    /**
     * 获取列表
     * @param array $where
     * @param string $order
     * @param int $limit
     * @param array $with
     * @param string $field 字段
     * @return mixed
     */
    public static function getList($where = [], $limit = 0,$order='',$with=[],$field=''){
        if($limit>0 && count($with)>0){
            return self::with($with)->where($where)->field($field)->order($order)->limit($limit)->select()->toArray();
        }
        if($limit>0 && count($with)== 0) {
            return self::where($where)->field($field)->order($order)->limit($limit)->select()->toArray();
        }
        if($limit == 0 && count($with)>0){
            return self::with($with)->where($where)->field($field)->order($order)->select()->toArray();
        }
        return self::where($where)->field($field)->order($order)->select()->toArray();
    }

    /**
     * 字符串拼接
     * @param int|array $id
     * @param string $str
     * @return string
     */
    private static function get_field($id, $str = '|')
    {
        if (is_array($id)) {
            $sql = "";
            $i = 0;
            foreach ($id as $val) {
                $i++;
                if ($i < count($id)) {
                    $sql .= $val . $str;
                } else {
                    $sql .= $val;
                }
            }
            return $sql;
        } else {
            return $id;
        }
    }

    /**
     * 条件切割
     * @param string $order
     * @param string $file
     * @return string
     */
    public static function setOrder($order, $file = '-')
    {
        if (empty($order)) return '';
        return str_replace($file, ' ', $order);
    }

    /**
     * 获取时间段之间的model
     * @param $where
     * @param null $model
     * @param string $prefix
     * @param string $data
     * @param string $field
     * @return ModelTrait|null
     */
    public static function getModelTime($where, $model = null, $prefix = 'add_time', $data = 'data', $field = ' - ')
    {
        if ($model == null) $model = new self;
        if (!isset($where[$data])) return $model;
        switch ($where[$data]) {
            case 'today':
            case 'week':
            case 'month':
            case 'year':
            case 'yesterday':
                $model = $model->whereTime($prefix, $where[$data]);
                break;
            case 'quarter':
                list($startTime, $endTime) = self::getMonth();
                $model = $model->where($prefix, '>', strtotime($startTime));
                $model = $model->where($prefix, '<', strtotime($endTime));
                break;
            case 'lately7':
                $model = $model->where($prefix, 'between', [strtotime("-7 day"), time()]);
                break;
            case 'lately30':
                $model = $model->where($prefix, 'between', [strtotime("-30 day"), time()]);
                break;
            default:
                if (strstr($where[$data], $field) !== false) {
                    list($startTime, $endTime) = explode($field, $where[$data]);
                    $model = $model->where($prefix, '>', strtotime($startTime));
                    $model = $model->where($prefix, '<', bcadd(strtotime($endTime), 86400, 0));
                }
                break;
        }
        return $model;
    }

    /**
     * 获取去除html去除空格去除软回车,软换行,转换过后的字符串
     * @param string $str
     * @return string
     */
    public static function HtmlToMbStr($str)
    {
        return trim(strip_tags(str_replace(["\n", "\t", "\r", " ", "&nbsp;"], '', htmlspecialchars_decode($str))));
    }

    /**
     * 截取中文指定字节
     * @param string $str
     * @param int $utf8len
     * @param string $chaet
     * @param string $file
     * @return string
     */
    public static function getSubstrUTf8($str, $utf8len = 100, $chaet = 'UTF-8', $file = '....')
    {
        if (mb_strlen($str, $chaet) > $utf8len) {
            $str = mb_substr($str, 0, $utf8len, $chaet) . $file;
        }
        return $str;
    }

    /**
     * 获取本季度 time
     * @param int|string $time
     * @param string $ceil
     * @return array
     */
    public static function getMonth($time = '', $ceil = 0)
    {
        if ($ceil != 0)
            $season = ceil(date('n') / 3) - $ceil;
        else
            $season = ceil(date('n') / 3);
        $firstday = date('Y-m-01', mktime(0, 0, 0, ($season - 1) * 3 + 1, 1, date('Y')));
        $lastday = date('Y-m-t', mktime(0, 0, 0, $season * 3, 1, date('Y')));
        return array($firstday, $lastday);
    }

    /**
     * 高精度 加法
     * @param $key
     * @param $incField // 相加的字段
     * @param $inc
     * @param null $keyField // id的字段
     * @param int $acc // 精度
     * @return bool
     */
    public static function bcInc($key, $incField, $inc, $keyField = null, $acc = 2)
    {
        if (!is_numeric($inc)) return false;
        $model = new self();
        if ($keyField === null) $keyField = $model->getPk();
        $result = self::where($keyField, $key)->find();
        if (!$result) return false;
        $new = bcadd($result[$incField], $inc, $acc);
        $result->$incField = $new;
        return false !== $result->save();
    }

    /**
     * 高精度 减法
     * @param $key
     * @param $decField // 相减的字段
     * @param $dec // 减的值
     * @param null $keyField // id的字段
     * @param bool $minus // 是否可以为负数
     * @param int $acc // 精度
     * @return bool
     */
    public static function bcDec($key, $decField, $dec, $keyField = null, $minus = false, $acc = 2)
    {
        if (!is_numeric($dec)) return false;
        $model = new self();
        if ($keyField === null) $keyField = $model->getPk();
        $result = self::where($keyField, $key)->find();
        if (!$result) return false;
        if (!$minus && $result[$decField] < $dec) return false;
        $new = bcsub($result[$decField], $dec, $acc);
        $result->$decField = $new;
        return false !== $result->save();
    }

    /**
     * @param null $model
     * @return ModelTrait|null
     */
    protected static function getSelfModel($model = null)
    {
        return $model == null ? (new self()) : $model;
    }

}