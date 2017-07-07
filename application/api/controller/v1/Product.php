<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 9:14
 */

namespace app\api\controller\v1;


use app\api\validate\Count;
use app\api\model\Product as ProductModel;
use app\api\validate\IDMustBePositiveInt;

class Product {
    public function getRecent($count=15){
        (new Count())->goCheck();
        $products = ProductModel::getMostRecent($count);

        // 判断$product不存在
        if($products->isEmpty()){
            return '没有数据';
        }
        // 转换成数据集，可以便捷地隐藏 summary
        // $collection = collection($products);
        // $products = $collection->hidden(['summary']);
        // 也可以在database里也可以修改配置
        // 因为仅仅是这个控制器里不需要summary，其他地方可能还需要summary
        // 所以单独在控制器里隐藏summary
        $products = $products->hidden(['summary']);
        return $products;
    }

    public function getAllInCategory($id){
        (new IDMustBePositiveInt())->goCheck();
        $products = ProductModel::getProductsByCategoryID($id);
        if($products->isEmpty()){
            return '没有数据';
        }
        return $products;
    }

    public function getOne($id)
    {
        (new IDMustBePositiveInt())->goCheck();
        $product = ProductModel::getProductDetail($id);
        if (!$product)
        {
            return '异常';
        }
        return $product;
    }

    public function createOne()
    {
        $product = new ProductModel();
        $product->save(
            [
                'id' => 1
            ]);
    }

    public function deleteOne($id)
    {
        ProductModel::destroy($id);
        //        ProductModel::destroy(1,true);
    }
}