<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 9:17
 */

namespace app\api\validate;


class Count extends BaseValidate {
    protected $rule = [
        'count' => 'isPositiveInteger|between:1,15'
    ];
}