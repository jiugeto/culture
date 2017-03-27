<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiAd;
use App\Api\ApiBusiness\ApiComFunc;
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
        $apiAd = ApiAd::index(10,1,$company['uid'],5,time(),time(),1,2);
        $apiGoods = ApiGoods::index(4,1,$company['uid'],0,0,0,2);
        $result = [
            'company' => $company['company'],
            'ppts' => $apiAd['code']==0 ? $apiAd['data'] : [],
            'firms' => $this->getFuncs($company['cid'],4,5),
            'news' => $this->getFuncs($company['cid'],8,3),
            'infos' => $this->getFuncs($company['cid'],8,4),
            'works' => $apiGoods['code']==0 ? $apiGoods['data'] : [],
            'parterners' => $this->getFuncs($company['cid'],5,5),
            'switchs' => $company['company']['layout'] ? unserialize($company['company']['layout']) : [],
            'skin' => $company['company']['skin'],
            'prefix_url' => $this->prefix_url,
            'topmenus' => $this->getTopMenu($cid),
            'footLinks' => $this->getFooter($cid),
        ];
        return view('company.home.index', $result);
    }

    /**
     * 企业服务 genre==2，type==5
     */
    public function getFuncs($cid,$limit,$genre)
    {
        $module = $this->getModuleId($cid,$genre);
        $apiComModule = ApiComFunc::index($limit,1,$cid,$module,2);
        return $apiComModule['code']==0 ? $apiComModule['data'] : [];
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