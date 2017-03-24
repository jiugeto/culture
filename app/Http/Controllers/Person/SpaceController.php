<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiBusiness\ApiDesign;
use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiOnline\ApiProduct;
use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiSign;
use App\Api\ApiUser\ApiWallet;

class SpaceController extends BaseController
{
    /**
     * 个人后台个人空间
     */

    protected $curr = 'space';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $apiGoods = ApiGoods::index(10,1,$this->userid,0,0,0,2);
        $apiProduct = ApiProduct::getProductsList(10,1,$this->userid,0,2);
        $apiDesign = ApiDesign::index(4,1,$this->userid,0,0,2,0);
        $apiWallet = ApiWallet::getWalletByUid($this->userid);
        $apiIntegral = ApiTalk::getIntegralList($this->userid);
        $result = [
            'frields'   =>  $this->getFrields(4),
            'goods'     =>  $apiGoods['code']==0 ? $apiGoods['data'] : [],
            'goodsNum'  =>  $apiGoods['code']==0 ? $apiGoods['pagelist']['total'] : 0,
            'products'  =>  $apiProduct['code']==0 ? $apiProduct['data'] : [],
            'productNum'    =>  $apiProduct['code']==0 ? $apiProduct['pagelist']['total'] : 0,
            'designs'   =>  $apiDesign['code']==0 ? $apiDesign['data'] : [],
            'designNum' =>  $apiDesign['code']==0 ? $apiDesign['pagelist']['total'] : 0,
            'signNum'   =>  $apiWallet['code']==0 ? $apiWallet['data']['sign'] : 0,
            'goldNum'   =>  $apiWallet['code']==0 ? $apiWallet['data']['gold'] : 0,
            'tipNum'    =>  $apiWallet['code']==0 ? $apiWallet['data']['tip'] : 0,
            'integralNum'   =>  $apiIntegral['code']==0 ? $apiIntegral['data']['integral'] : 0,
            'curr'      =>  $this->curr,
        ];
        return view('person.space.index', $result);
    }











    /**
     * 显示4个好友
     */
    public function getFrields($limit)
    {
        $rst = ApiPerson::getUserFrields($this->userid,$limit);
        return $rst['code']==0 ? $rst['data'] : [];
    }
}