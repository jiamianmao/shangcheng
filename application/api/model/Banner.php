<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/28
 * Time: 16:14
 */

namespace app\api\model;


use think\Db;
use think\Model;

class Banner extends Model {
    protected $hidden = ['delete_time', 'update_time'];

    public function items(){
        // 一对多关联 hasMany('模型'， '外键', '主键')
        return $this->hasMany('BannerItem', 'banner_id', 'id');
    }
    public static function getBannerByID($id){

        $banner = self::with(['items', 'items.img'])
                    ->find($id);
        return $banner;
    }
}