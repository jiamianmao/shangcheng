<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/17
 * Time: 15:48
 */

namespace app\lib\exception;


class CategoryException extends BaseException
{
    public $code = 404;
    public $msg = '指定类目不存在，请检查参数';
    public $errorCode = 50000;
}