<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/28
 * Time: 15:23
 */

namespace app\api\validate;


use think\Exception;
use think\Request;
use think\Validate;

class BaseValidate extends  Validate {
    public function goCheck(){
        // 获取http传入的参数
        // 对这些参数进行校验
        $request = Request::instance();
        $params = $request->param();

        $result = $this->check($params);
        if(!$result){
            $error = $this->error;
            throw new Exception($error);
        }else{
            return true;
        }
    }

    protected $rule = [
        'id' => 'require|isPositiveInteger'
    ];
    protected function isPositiveInteger($value, $rule = '', $data='', $field=''){
        if(is_numeric($value) && is_int($value + 0) && ($value + 0) > 0){
            return true;
        }else{
            return false;
        }
    }

    protected function isNotEmpty($value, $rule = '', $data='', $field=''){
        if(empty($value)){
            return false;
        }else{
            return true;
        }
    }

    protected function isMobile($value){
        $rule = '^1(3|4|5|7|8)[0-9]\d{8}$^';
        $result = preg_match($rule, $value);
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function getDataByRule($arrays){
        if(array_key_exists('user_id', $arrays) ||
            array_key_exists('uid', $arrays)
        ){
            return '参数中包含有非法的参数名user_id或uid';
        }
        // 保存我们要的参数数组
        $newArray = [];
        foreach ($this->rule as $key => $value) {
            $newArray[$key] = $arrays[$key];
        }
        return $newArray;
    }
}