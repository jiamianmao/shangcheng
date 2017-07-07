<?php
/**
 * Created by 七月.
 * Author: 七月
 * Date: 2017/4/24
 * Time: 4:26
 */

namespace app\lib\exception;


class BannerMissException extends BaseException
{
    public $code = 404;
    public $msg = '请求的Banner不存在';
    public $errorCode = 40000;
}