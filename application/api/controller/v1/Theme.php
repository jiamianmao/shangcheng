<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/6/29
 * Time: 16:55
 */

namespace app\api\controller\v1;


use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\api\validate\IDMustBePositiveInt;

class Theme {
    /**
     *  @url  /theme?ids=id1,id2,id3,.....
     *  @return  一组theme模型
     */
    public function getSimpleList($ids=''){
        (new IDCollection())->goCheck();
        $ids = explode(',', $ids);
        $result = ThemeModel::with('topicImg,headImg')
                ->select($ids);
        if($result->isEmpty()){
            return '不存在';
        }
        return $result;
    }

    /**
     * @url /theme/:id
     */
    public function getComplexOne($id){
        (new IDMustBePositiveInt())->goCheck();
        $theme = ThemeModel::getThemeWithProducts($id);
        return $theme;
    }

}