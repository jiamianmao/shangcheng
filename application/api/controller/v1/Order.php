<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/6
 * Time: 9:37
 */

namespace app\api\controller\v1;


use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use think\Controller;
use app\api\service\Token as TokenService;
use think\Exception;

class Order extends BaseController {
    // 用户在选择商品后，向API提交包含选择的商品的相关信息
    // API在接收到信息后，需要检查订单相关商品的库存
    // 有库存的话，把订单数据存入数据库中，并把下单成功返回给客户端
    // 客户端调用我们的支付接口，进行支付
    // 还需要再次进行库存量检测
    // 服务器这边就可以拉起微信支付接口进行支付
    // 微信会返回给客户端一个结果，并会返回给我们一个支付的结果（异步）
    // 成功： 进行库存量的检查(可省)及库存量的扣除

    protected  $beforeActionList = [
        'checkExclusiveScope' => ['only' => 'placeOrder']
    ];

    public function placeOrder(){
        (new OrderPlace())->goCheck();
        // 加/a是为了获取数组形式的数据
        $products = input('post.products/a');
        $uid = TokenService::getCurrentUid();
    }
}