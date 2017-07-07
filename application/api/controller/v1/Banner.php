<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/28
 * Time: 13:27
 */

namespace app\api\controller\v1;

use app\api\validate\IDMustBePositiveInt;
use app\api\model\Banner as BannerModel;
use think\Exception;

class Banner {
    /**
     *   获取指定id的banner信息
     *   @url /banner/:id
     *   @http  GET
     *   @id   banner的id号
     */
    public function getBanner($id){

        // AOP 面向切面编程
        (new IDMustBePositiveInt())->goCheck();

        $banner = BannerModel::getBannerByID($id);

        if(!$banner){
            throw new Exception('内部错误');
        }
        return $banner;
    }























}