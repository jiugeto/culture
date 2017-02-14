<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiRent;

class RentController extends BaseController
{
    /**
     * 网站前台租赁频道
     */

    protected $curr = 'rent';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($type=0,$fromMoney=0,$toMoney=0)
    {
        //判断起始租金、结束租金
        if (!is_numeric($fromMoney) || !is_numeric($toMoney)) {
            echo "<script>alert('租金格式错误！');history.go(-1);</script>";exit;
        }
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'rent';
        $datas = $this->query($pageCurr,$type,$fromMoney,$toMoney);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'model' => $this->getModel(),
            'ads' => $this->ads(),
            'lists' => $this->list,
            'curr_menu' => $this->curr,
            'type' => $type,
            'fromMoney' => $fromMoney,
            'toMoney' => $toMoney,
        ];
        return view('home.rent.index', $result);
    }

    public function show($id)
    {
        $submenu['url'] = 'show';
        $submenu['name'] = '详情';
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'lists'=> $this->list,
            'data'=> $apiRent['data'],
            'curr_menu'=> $this->curr,
            'curr_submenu'=> $submenu,
            'uid'=> $apiRent['data']['uid'],
        ];
        return view('home.rent.show', $result);
    }




    public function query($pageCurr,$type,$fromMoney,$toMoney)
    {
        $apiRent = ApiRent::getRentsByMoney($this->limit,$pageCurr,$type,$fromMoney,$toMoney);
        return $apiRent['code']==0 ? $apiRent['data'] : [];
    }

    public function ads()
    {
        //adplace_id==4，前台租赁页面右侧，limit==3
        $apiAd = ApiAd::index(3,1,0,3,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiCompany = ApiRent::getModel();
        return $apiCompany['code']==0 ? $apiCompany['model'] : [];
    }
}