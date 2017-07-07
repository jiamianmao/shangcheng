<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/5
 * Time: 12:08
 */

namespace app\api\model;


class UserAddress extends BaseModel {
    protected $hidden = ['id', 'delete_time', 'user_id'];
}