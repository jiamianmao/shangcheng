<?php

namespace app\api\model;

use think\Model;

class Image extends BaseModel
{
    // 这里不用$hidden  用$visible更方便一些
    protected $visible = ['url'];

    // 读取器  方法名固定  get+属性+Attr
    public function getUrlAttr($value, $data){
        return $this->prefixImgUrl($value, $data);
    }
}
