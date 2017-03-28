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
        $apiAd = ApiAd::index(10,1,$company['uid'],5,time(),time(),1,2);
        $apiGoods = ApiGoods::index(4,1,$company['uid'],0,0,0,2);
        $result = [
            'ppts' => $apiAd['code']==0 ? $apiAd['data'] : [],
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

//    /**
//     * 合作伙伴列表
//     */
//    public function parterner($cid)
//    {
//        $limit = 20;
//        $moduleid = 5;      //5代表合作伙伴
//        $company = $this->company($cid,$this->list['func']['url']);
//        $datas = ComFuncModel::where('cid',$company['cid'])
//            ->where('module_id',$moduleid)
//            ->paginate($limit);
//        $datas->limit = $limit;
//        $result = [
//            'datas'=> $datas,
//            'comMain'=> $this->getComMain($company['cid']),
//            'topmenus'=> $this->topmenus,
//            'prefix_url'=> $this->prefix_url,
//        ];
//        return view('company.home.parterner', $result);
//    }

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