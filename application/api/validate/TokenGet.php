<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 12:44
 */

namespace app\api\validate;


class TokenGet extends  BaseValidate {
    protected  $rule = [
        'code' => 'require|isNotEmpty'
    ];

    protected  $message = [
        'code' => '没有code还想获取Token,做梦呢!'
    ];
}