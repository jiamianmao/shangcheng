<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/28
 * Time: 13:57
 */

namespace app\api\validate;


use think\Validate;

class Testvalite extends  Validate {
    protected $rule = [
        'name' => 'require|max:10',
        'email' => 'email'
    ];
}