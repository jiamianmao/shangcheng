<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/6
 * Time: 10:10
 */

namespace app\api\validate;


use think\Exception;

class OrderPlace extends BaseValidate {
    // 这个是对全部数据的一个校验规则，这个是自动去执行
    protected $rule = [
        'products' => 'checkProducts'
    ];

    // 定义子项的验证规则，这个是手动去执行
    protected $singleRule = [
        'product_id' => 'require|isPositiveInteger',
        'conut' => 'require|isPositiveInteger'
    ];

    protected function checkProducts($values){
        // 判断是否是数组
        if(!is_array($values)){
            throw new Exception('商品列表不是数组');
        }
        // 判断是否为空
        if(empty($values)){
            throw new Exception('商品列表不能为空');
        }

        // 对数组中子数组的参数进行验证
        foreach ($values as $value){
            $this->checkProduct($value);
        }

        return true;
    }

    // 把foreach里的业务逻辑提取出来
    protected function checkProduct($value){
        $validate = new BaseValidate($this->singleRule);
        $result = $validate->check($value);
        if($result){
            throw new Exception('商品列表参数错误');
        }
    }
}