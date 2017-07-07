<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/3
 * Time: 9:51
 */

namespace app\api\model;

use think\Model;
class ProductImage extends  BaseModel {

    protected $hidden = ['img_id', 'delete_time', 'product_id'];

    public function imgUrl()
    {
        return $this->belongsTo('Image', 'img_id', 'id');
    }
}