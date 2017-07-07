<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/16
 * Time: 6:08
 */

namespace app\lib\exception;


class ThemeException extends BaseException
{
    public $code = 404;
    public $msg = '指定主题不存在，请检查主题ID';
    public $errorCode = 30000;
}