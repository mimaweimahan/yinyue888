<?php
/**
 * Explain: 产品模块
 */
namespace app\goods\model;
use app\agent\model\Orders;
use app\common\traits\ModelTrait;
use think\Model;
use function str2arr;

class Goods extends Model
{
    protected $append = ['link'];
    use ModelTrait;
    public function getImageAttr($value)
    {
        if(trim($value)){
            $image_url = thumb($value,300,300);
            if (!str_contains($image_url, 'http://') && !str_contains($image_url, 'https://')) {
                $domain = getCurrentDomain();
                $image_url = $domain.$image_url;
            }
            $value = $image_url;
        }
        return $value;
    }

    public function getPriceAttr($val)
    {
        if($val){
            return floatval($val);
        }
        return $val;
    }

    public function getLinkAttr($val,$data)
    {
        if(isset($data['product_id']) && $data['product_id']>0){
            return "https://shop.tiktok.com/view/product/{$data['product_id']}?region=US";
        }
        return $val;
    }

    /**
     * 获取分类
     */
    public function type()
    {
        return $this->hasOne(Type::class,'id', 'type_id')->bind(['type_name']);
    }

    /**
     * 新增之后
     */
    public static function onAfterInsert($data){
        if(!$data->product_id){
            self::update(['sort'=>$data->id,'product_id'=>$data->id],['id'=>$data->id]);
        }else{
            self::update(['sort'=>$data->id],['id'=>$data->id]);
        }
    }

    /**
     * 优化版：两次价格匹配并选择总金额最接近的结果
     *
     * @param float $inputPrice 传入的原始价格
     * @return array|bool 包含商品数据和数量的数组: ['product' => array, 'quantity' => int]
     */
    public static function findOptimalProduct($inputPrice,$uid)
    {
        // 验证输入有效性
        if ($inputPrice <= 0) {
            return false;
        }

        // 计算第二次匹配的价格（传入金额的一半）
        $halfPrice = $inputPrice / 2;

        // 第一次匹配：使用原始价格
        $firstMatch  = self::getMatchedProduct($inputPrice,$uid);

        // 第二次匹配：使用一半价格
        $secondMatch = self::getMatchedProduct($halfPrice,$uid);

        // 计算两次匹配的总金额与原始金额的差值
        $firstTotal  = $firstMatch['goods']['price'] * $firstMatch['num'];
        $secondTotal = $secondMatch['goods']['price'] * $secondMatch['num'];

        $firstDiff  = abs($firstTotal - $inputPrice);
        $secondDiff = abs($secondTotal - $inputPrice);

        // 选择差值更小的结果（更接近原始金额）
        if ($firstDiff <= $secondDiff) {
            return $firstMatch;
        } else {
            return $secondMatch;
        }
    }

    /**
     * 内部辅助方法：单次价格匹配并计算数量
     *
     * @param float $targetPrice 目标匹配价格
     * @return array|bool 匹配结果
     */
    public static function getMatchedProduct($targetPrice,$uid)
    {
        // 过滤已经抢过到商品
        $goods_ids = Orders::where('uid',$uid)->group('goods_id')->column('goods_id');

        $map[] = ['price','>',0];
        if($goods_ids){
            $map[] = ['id','not in',$goods_ids];
        }

        // 查找最接近目标价格的商品
        $product = self::where($map)->orderRaw("ABS(price - :target)", ['target' => $targetPrice])->find();

        if (empty($product)) {
           return false;
        }else{
            $product = $product->toArray();
        }

        // 计算数量（基于价格倍数关系，最小为1）
        $productPrice = $product['price'];
        $quantity = 1;

        if ($productPrice > 0) {
            // 计算目标价格是商品价格的倍数并取整
            $multiple = $targetPrice / $productPrice;
            $quantity = max(1, (int)round($multiple));
        }
        return [
            'goods' => $product,
            'num' => $quantity
        ];
    }
}