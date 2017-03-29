<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiGoods;

class HomeController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '企业首页';
        $this->list['func']['url'] = '';
    }

    public function index($cid=0)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $cid = $company['company']['id'];
        $pptNum = 10;
        $apiAd = ApiAd::index($pptNum,1,$company['uid'],5,time(),time(),1,2);
        $apiGoods = ApiGoods::index(4,1,$company['uid'],0,0,0,2);
        $result = [
            'ppts' => $apiAd['code']==0 ? $apiAd['data'] : [],
            'pptNum' => $pptNum,
            'firms' => $this->getFuncs($cid,4,5)['datas'],
            'news' => $this->getFuncs($cid,8,3)['datas'],
            'infos' => $this->getFuncs($cid,8,4)['datas'],
            'parterners' => $this->getFuncs($cid,5,5)['datas'],
            'works' => $apiGoods['code']==0 ? $apiGoods['data'] : [],
            'switchs' => $company['company']['layout'] ? unserialize($company['company']['layout']) : [],
            'prefix_url' => $this->prefix_url,
        ];
        return view('company.home.index', $result);
    }

    /**
     * 合作伙伴列表
     */
    public function getParternerList($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $cid = $company['company']['id'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiFunc = $this->getFuncs($cid,$this->limit,8,$pageCurr);
        $result = [
            'datas' => $apiFunc['datas'],
            'pagelist' => $apiFunc['pagelist'],
            'prefix_url' => $this->prefix_url,
            'limit' => $this->limit,
        ];
        return view('company.home.parterner', $result);
    }

//    /**
//     * 合作伙伴大列表
//     */
//    public function partShow($cid,$id)
//    {
//        $company = $this->company($cid,$this->list['func']['url']);
//        $result = [
//            'datas'=> ComFuncModel::find($id),
//            'topmenus'=> $this->topmenus,
//        ];
//        return view('company.home.partShow', $result);
//    }
}