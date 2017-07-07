<?php
/**
 * Created by PhpStorm.
 * User: zhulihulian
 * Date: 2017/7/5
 * Time: 10:23
 */

namespace app\api\controller\v1;


// 客户端需要给服务器发送地址信息和代表用户标识的uid信息
use app\api\controller\BaseController;
use app\api\model\User as UserModel;
use app\api\service\Token as TokenService;
use app\api\validate\AddressNew;
use think\Exception;

class Address extends BaseController {

    protected $beforeActionList = [
        'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
    ];

    public function createOrUpdateAddress(){
        // 不用这种方法是因为我们需要拿到这个数组
        // (new AddressNew())->goCheck();
        $validate = new AddressNew();
        $validate->goCheck();
        // 根据Token来获取uid
        // 根据uid来查找用户数据，判断用户是否存在，如果不存在抛出异常
        // 如果用户存在，获取从客户端传来的地址信息
        // 根据用户地址信息是否存在，从而判断是添加地址还是更新地址

        $uid = TokenService::getCurrentUid();
        $user = UserModel::get($uid);
        if(!$user){
            throw new Exception('当前用户不存在');
        }
        // 这样处理是为了防止客户端多传字段来覆盖我们的字段值
        // 参数过滤
        $dataArray = $validate->getDataByRule(input('post.'));
        $userAddress = $user->address;
        // 这里在useraddress模型中添加数据 有两个思路
        // 1，把user当做主表（主模型），把useraddress当做从表（关联模型），在useraddress添加数据就是关联模型添加数据
        // 2，把user和useraddress当做2个模型来看待，那么就可以直接使用模型的create方法了
        if(!$userAddress){
            $user->address()->save($dataArray);
        }else{
            $user->address->save($dataArray);
        }
        return 'success';
    }
}