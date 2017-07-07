<?php

namespace app\api\model;

use think\Model;

class BaseModel extends Model
{
    // 读取器
    // 把读取器放到基类里 而不放到image模型里，是因为当其他模型有url属性的时候，无法调用，所以放到基类里
    // 这里不是用public function getUrlAttr 因为如果直接用读取器，那么当所有使用url属性的地方都会自动转换成url地址
    // 但是有的时候可能就是一个字符串，不需要拼接成url地址，所以不太灵活。
    // 所以在基类里我们把它变成一个受保护的方法，当相应的模型需要的时候，再从基类里继承和调用
    // 相当于在基类定义一个方法  再相应的模型中形成读取器
    protected function prefixImgUrl($value, $data){
        // 因为在image表中有from是内链还是外链的扩展，所以我们这里需要进行一个判断
        // database中规定 from=1时为内链， from=2时为外链
        $finalUrl = $value;
        if($data['from'] == 1){
            $finalUrl = config('setting.img_prefix').$value;
        }
        return $finalUrl;
    }
}
