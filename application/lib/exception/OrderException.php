<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/27
 * Time: 16:07
 */

namespace app\lib\exception;


class OrderException extends BaseException
{
    public $code = 404;
    public $msg = '订单不存在，请检查ID';
    public $errorCode = 80000;
}