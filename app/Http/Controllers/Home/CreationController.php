<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiOnline\ApiOrderPro;
use App\Api\ApiOnline\ApiProduct;
use App\Api\ApiUser\ApiWallet;

class CreationController extends BaseController
{
    /**
     * 网站前台创作窗口
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=1,$cate=0,$isOrder=0)
    {
        $rstWallet = ApiWallet::getWalletByUid($this->userid);
        $wallet = $rstWallet['code']==0 ? $rstWallet['data'] : [];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        if ($genre==1 && !$cate && !$isOrder) {
            $prefix_url = DOMAIN.'creation';
        } else {
            $prefix_url = DOMAIN.'creation/s/'.$genre.'/'.$cate.'/'.$isOrder;
        }
        if ($genre==1) {
            if (!$isOrder) {
                $apiProduct = ApiProduct::getProductsList($this->limit,$pageCurr,0,$cate);
            } else {
                $apiProduct = ApiOrderPro::index($this->limit,$pageCurr,0,$cate);
            }
        } elseif ($genre==2) {
            $apiProduct = ApiGoods::index($this->limit,$pageCurr,$this->userid,1,$cate,0,2);
        } else {
            $apiProduct = ApiGoods::index($this->limit,$pageCurr,$this->userid,2,$cate,0,2);
        }
        if (isset($apiProduct)&&$apiProduct['code']==0) {
            $datas = $apiProduct['data']; $total = $apiProduct['pagelist']['total'];
        } else {
            $datas = array(); $total = 0;
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'model' => $this->getModel(),
            'curr_menu' => 'creation',
            'genre' => $genre,
            'cate' => $cate,
            'isOrder' => $isOrder,
            'wallet' => $wallet,
        ];
        $view = $genre==1 ? 'index' : 'cus';
        return view('home.creation.'.$view, $result);
    }








    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiProduct = ApiProduct::getModel();
        return $apiProduct['code']==0 ? $apiProduct['model'] : [];
    }
}