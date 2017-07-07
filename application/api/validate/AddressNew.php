<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/5
 * Time: 10:24
 */

namespace app\api\validate;


class AddressNew extends BaseValidate {
    // 这里需要特别注意的是，不去校验客户端发送过来的uid，
    // 因为我们的id是自增长的，很容易被才出来，为了防止客户端传回来别人的uid，导致别人的收货地址被覆盖
    protected $rule = [
        'name' => 'require|isNotEmpty',
        'mobile' => 'require|isMobile',
        'province' => 'require|isNotEmpty',
        'city' => 'require|isNotEmpty',
        'country' => 'require|isNotEmpty',
        'detail' => 'require|isNotEmpty'
    ];
}