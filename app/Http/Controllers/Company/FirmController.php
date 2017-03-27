<?php
namespace App\Http\Controllers\Company;

use App\Api\ApiBusiness\ApiComFunc;

class FirmController extends BaseController
{
    /**
     * 企业后台服务
     */

    protected $moduleid;
    protected $genre = 2;       //此处2代表公司服务

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '服务项目';
        $this->list['func']['url'] = 'firm';
    }

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $this->moduleid = $this->getModuleId($company['cid'],$this->genre);
        $prefix_url = DOMAIN.'c/'.$cid.'/firm';
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiComFunc = ApiComFunc::index($this->limit,$pageCurr,$cid,$this->moduleid,2);
        if ($apiComFunc['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiComFunc['data']; $total = $apiComFunc['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'company' => $company,
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $this->prefix_url,
            'topmenus' => $this->topmenus,
        ];
        return view('company.firm.index', $result);
    }
}