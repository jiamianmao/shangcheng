<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 12:53
 */

namespace app\api\model;


class User extends  BaseModel {

    // 定义user和address的关联关系
    public function address() {
        return $this->hasOne('UserAddress', 'user_id', 'id');
    }

    public static function getByOpenID($openid){
        $user = self::where('openid', '=', $openid)
            ->find();
        return $user;
    }
}