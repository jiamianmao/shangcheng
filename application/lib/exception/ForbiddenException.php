<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/5/26
 * Time: 14:58
 */

namespace app\lib\exception;


class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '权限不够';
    public $errorCode = 10001;
}