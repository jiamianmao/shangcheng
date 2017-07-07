<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/30
 * Time: 15:21
 */

namespace app\api\service;


use think\Cache;
use think\Exception;
use think\Request;

class Token {

    public static function generateToken(){
        // 32个字符组成一组随机字符串
        $randChars = getRandChar(32);
        // 用三组字符串，进行md5加密
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        // salt 加盐
        $slat = config('secure.token_salt');
        return md5($randChars.$timestamp.$slat);
    }

    // 这里虽然暂时只是需要拿到uid，但是为了扩展性
    // 我们这里封装了一下，做个通用的方法
    public static function getCurrentTokenVar($key){
        $token = Request::instance()
            ->header('token');
        $vars = Cache::get($token);

        if(!$vars){
            return '缓存读取异常';
        }else{
            if(!is_array($vars)) {
                $vars = json_decode($vars, true);
            }
            if(array_key_exists($key, $vars)){
                return $vars[$key];
            }
            else{
                return '尝试获取的token并不存在';
            }
        }
    }

    public static function getCurrentUid(){
        // token
        $uid = self::getCurrentTokenVar('uid');
        return $uid;
    }

    // 用户和CMS管理都可以访问
    public static function needPrimaryScope(){
        $scope = self::getCurrentTokenVar('scope');
        if($scope) {
            if ($scope >= ScopeEnum::User) {
                return true;
            } else {
                throw new Exception('权限不够');
            }
        }else{
            throw new Exception('token过期或无效');
        }
    }

    // 只有用户才能访问的接口权限
    public static function needExclusiveScope(){
        $scope = self::getCurrentTokenVar('scope');
        if($scope) {
            if ($scope == ScopeEnum::User) {
                return true;
            } else {
                throw new Exception('权限不够');
            }
        }else{
            throw new Exception('token过期或无效');
        }
    }
}