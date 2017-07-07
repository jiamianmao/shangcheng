<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/6
 * Time: 10:30
 */

namespace app\api\service;


use app\api\model\Product;
use app\api\model\UserAddress;
use think\Exception;

class Order {
    // 订单的商品列表，也就是客户端传过来的products参数
    protected $oProducts;

    // 真实的商品信息（包括库存）
    protected $products;

    protected  $uid;

    public function place($uid, $oProducts){
        // 对oProducts和products做个对比
        // 前者是传递过来的，后者是从数据库查询的
        $this->oProducts = $oProducts;
        $this->products = $this->getProductsByOrder($oProducts);
        $this->uid = $uid;
        $status = $this->getOrderStatus();
        if(!$status['pass']){
            $status['order_id'] = -1;
            return $status;
        }

        // 开始创建订单
        $orderSnap = $this->snapOrder();

    }

    // 生成订单快照
    private function snapOrder($status){
        $snap = [
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatus' => [],
            'snapAddress' => null,
            'snapName' => '',
            'snapImg' => ''
        ];

        $snap['orderPrice'] = $status['orderPrice'];
        $snap['totalCount'] = $status['totalCount'];
        $snap['pStatus'] = $status['pStatusArray'];
        $snap['snapAddress'] = json_encode($this->getUserAddress());
        $snap['snapName'] = $this->products[0]['name'];
        $snap['snapImg'] = $this->products[0]['main_img_url'];
        if(count($this->products)>1){
            $snap['snapName'] .= '等';
        }
    }

    private function getUserAddress(){
        $userAddress = UserAddress::where('uuer_id', '=', 'uid')
                -find();
        if($userAddress){
            throw new Exception('用户收货地址不存在，下单失败');
        }
        return $userAddress->toArray();
    }

    private function getOrderStatus(){
        $status = [
            'pass' => true,
            'orderPrice' => 0,
            'totalCount' => 0,
            'pStatusArray' => []
        ];

        foreach ($this->oProducts as $oProduct){
            $pStatus = $this->getProductStatus(
                $oProduct['product_id'], $oProduct['count'], $this->products
            );
            if(!$pStatus['haveStock']){
                $status['pass'] = false;
            }
            $status['orderPrice'] += $pStatus['totalPrice'];
        }
    }

    private function getProductStatus($oPID, $oCount, $products){

        $pIndex = -1;

        $pStatus = [
            'id' => null,
            'haveStock' => false,
            '$Count' => 0,
            'name' => '',
            'totalPrice' => 0
        ];

        for($i = 0; $i < count($products); $i++){
            if($oPID == $products[$i]['id']){
                $pIndex = $i;
            }
        }

        if($pIndex == -1){
            throw new Exception('订单不存在，请检查ID');
        }else{
            $product = $products[$pIndex];
            $pStatus['id'] = $products['id'];
            $pStatus['name'] = $products['name'];
            $pStatus['count'] = $oCount;
            $pStatus['totalPrice'] = $product['price'] * $oCount;
            if($product['stock'] - $oCount >=0){
                $pStatus['haveStock'] = true;
            }
        }
        return $pStatus;
    }

    private function getProductsByOrder($oProducts){
        // 千万不要用循环去查询，只有弱鸡才用这个
//        foreach ($oProducts as $oProduct){
//
//        }

        // 这里是拿到所有的商品id
        $oPIDs = [];
        foreach ($oProducts as $item){
            array_push($oPIDs, $item['product_id']);
        }
        $products = Product::all($oPIDs)
                ->visible(['price', 'id', 'stock', 'name', 'main_img_url'])
                ->toArray();
    }
}