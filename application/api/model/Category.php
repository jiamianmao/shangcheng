<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 10:40
 */

namespace app\api\model;


class Category extends BaseModel {

    protected  $hidden = ['delete_time', 'update_time', 'create_time'];

    public function img(){
        return $this->belongsTo('Image', 'topic_img_id', 'id');
    }
}