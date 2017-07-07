<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/17
 * Time: 13:19
 */

namespace app\lib\exception;


class ProductException extends BaseException
{
    public $code = 404;
    public $msg = '指定的商品不存在，请检查参数';
    public $errorCode = 20000;
}