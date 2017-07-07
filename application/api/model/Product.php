<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/29
 * Time: 16:57
 */

namespace app\api\model;


class Product extends  BaseModel {
    protected $hidden = [
        'delete_time', 'main_img_id', 'pivot', 'create_time', 'update_time', 'from', 'category_id'
    ];

    public function getMainImgUrlAttr($value, $data){
        return $this->prefixImgUrl($value, $data);
    }

    public static function getMostRecent($count){
        $products = self::limit($count)
            ->order('create_time desc')
            ->select();
        return $products;
    }

    public function properties()
    {
        return $this->hasMany('ProductProperty', 'product_id', 'id');
    }

    public function imgs()
    {
        return $this->hasMany('ProductImage', 'product_id', 'id');
    }

    public static function getProductsByCategoryID($categoryID){
        $products = self::where('category_id', '=', $categoryID)
                ->select();
        return $products;
    }

    public static function getProductDetail($id)
    {
        //千万不能在with中加空格,否则你会崩溃的
        //        $product = self::with(['imgs' => function($query){
        //               $query->order('index','asc');
        //            }])
        //            ->with('properties,imgs.imgUrl')
        //            ->find($id);
        //        return $product;

        $product = self::with(
            // 这里是对关联模型下面的关联属性进行排序
            [
                'imgs' => function ($query)
                {
                    $query->with(['imgUrl'])
                        ->order('order', 'asc');
                }])
            ->with('properties')
            ->find($id);
        return $product;
    }
}