<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/6
 * Time: 9:59
 */

namespace app\api\controller;


use think\Controller;
use app\api\service\Token as TokenService;

class BaseController extends Controller {
    protected function checkPrimaryScope(){
        TokenService::needPrimaryScope();
    }

    protected function checkExclusiveScope(){
        TokenService::needExclusiveScope();
    }
}