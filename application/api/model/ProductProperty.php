<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/3
 * Time: 9:51
 */

namespace app\api\model;


class ProductProperty extends BaseModel {
    protected $hidden=['product_id', 'delete_time', 'id'];
}