<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 10:39
 */

namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;

class Category {
    public function getAllCategories(){
        $catetories = CategoryModel::all([], 'img');
        if($catetories->isEmpty()){
            return '没有数据';
        }
        return $catetories;
    }
}