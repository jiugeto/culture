<?php
namespace App\Http\Controllers\Company;

class ContactController extends BaseController
{
    /**
     * 企业后台团队
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '联系方式';
        $this->list['func']['url'] = 'contact';
    }

    public function index($cid)
    {
        $mapkey = 'Tj1ciyqmG0quiNgpr0nmAimUCCMB5qMk';      //自己申请的百度地图api的key
        $company = $this->company($cid,$this->list['func']['url']);
//        $cid = $company['company']['id'];
//        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
//        $apiFunc = $this->getFuncs($cid,5,9,$pageCurr);
//        $data = $apiFunc['datas'][0];
        $result = [
            'data' => $company['company'],
//            'pagelist' => $apiFunc['pagelist'],
            'prefix_url' => $this->prefix_url,
            'ak' => $mapkey,
        ];
        return view('company.contact.index', $result);
    }
}