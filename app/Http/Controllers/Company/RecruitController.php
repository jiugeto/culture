<?php
namespace App\Http\Controllers\Company;

class RecruitController extends BaseController
{
    /**
     * 企业后台招聘
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '招聘';
        $this->list['func']['url'] = 'recruit';
    }

    public function index($cid)
    {
        $company = $this->company($cid,$this->list['func']['url']);
        $cid = $company['company']['id'];
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $apiFunc = $this->getFuncs($cid,5,7,$pageCurr);
        $result = [
            'datas' => $apiFunc['datas'],
            'pagelist' => $apiFunc['pagelist'],
            'prefix_url' => $this->prefix_url,
        ];
        return view('company.recruit.index', $result);
    }
}