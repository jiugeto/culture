<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiUser\ApiCompany;

class SupplyController extends BaseController
{
    /**
     * 网站前台供应企业
     */

    protected $curr = 'supply';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($genre=0)
    {
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'supply';
        $apiCompany = ApiCompany::getCompanyList($this->limit,$pageCurr,$genre);
        if ($apiCompany['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiCompany['data']; $total = $apiCompany['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'model' => $this->getModel(),
            'ads' => $this->ads(),
            'lists' => $this->list,
            'curr_menu' => $this->curr,
            'genre' => $genre,
        ];
        return view('home.supply.index', $result);
    }







    public function ads()
    {
        //adplace_id==2，前台供应页面右侧，limit==2
        $apiAd = ApiAd::index(2,1,0,2,0,0,1,2);
        return $apiAd['code']==0 ? $apiAd['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiCompany = ApiCompany::getModel();
        return $apiCompany['code']==0 ? $apiCompany['model'] : [];
    }
}