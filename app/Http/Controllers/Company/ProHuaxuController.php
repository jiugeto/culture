<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiGoodsHuaxu;

class ProHuaxuController extends BaseController
{
    /**
     * 企业后台产品
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index($cid,$cate=0)
    {
        $list['func']['name'] = '产品';
        $list['func']['url'] = 'product';
        $company = $this->company($cid,$list['func']['url']);
        $uid = $company['company']['uid'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiHuaxu = ApiGoodsHuaxu::index($this->limit,$pageCurr,0,$uid,0);
        if ($apiHuaxu['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiHuaxu['data']; $total = $apiHuaxu['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$this->prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $this->prefix_url,
            'model' => $this->getModel(),
            'curr' => $list['func']['url'],
            'cate' => $cate,
        ];
        return view('company.huaxu.index', $result);
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiGoodsHuaxu::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}