<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiProVideo;
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
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        if ($genre==1 && !$cate && !$isOrder) {
            $prefix_url = DOMAIN.'creation';
        } else {
            $prefix_url = DOMAIN.'creation/s/'.$genre.'/'.$cate.'/'.$isOrder;
        }
        $datas = $this->query($genre,$cate,$isOrder,$pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'=> $datas,
            'prefix_url'=> $prefix_url,
            'pagelist'=> $pagelist,
            'model'=> $this->getModel(),
            'curr_menu'=> 'creation',
            'genre'=> $genre,
            'cate'=> $cate,
            'isOrder'=> $isOrder,
            'wallet'=> $wallet,
        ];
        $view = $genre==1 ? 'index' : 'cus';
        return view('home.creation.'.$view, $result);
    }






    public function query($genre,$cate,$isOrder,$pageCurr)
    {
        if ($genre==1) {
            if (!$isOrder) {
                $rst = ApiProduct::getProductsList($this->limit,$pageCurr,0,$cate);
            } else {
                $rst = ApiOrderPro::index($this->limit,$pageCurr,0,$cate);
            }
        } elseif (in_array($genre,[2,3])) {
            $rst = ApiProVideo::index($this->limit,$pageCurr,$genre,$cate,0,2);
        }
        return $rst['code']==0?$rst['data']:[];
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