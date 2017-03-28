<?php
namespace App\Http\Controllers\Company;

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
        $cid = $company['company']['id'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiFunc = $this->getFuncs($cid,5,5,$pageCurr);
        $result = [
            'datas' => $apiFunc['datas'],
            'pagelist' => $apiFunc['pagelist'],
            'prefix_url' => $this->prefix_url,
        ];
        return view('company.firm.index', $result);
    }
}