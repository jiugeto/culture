<?php
namespace App\Http\Controllers\Company;

use App\Models\Company\ComFuncModel;
use App\Models\CompanyModel;

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
        $key = 'Tj1ciyqmG0quiNgpr0nmAimUCCMB5qMk';      //自己申请的百度地图api的key
        $company = $this->company($cid,$this->list['func']['url']);
        $result = [
            'data'=> CompanyModel::find($company['cid']),
            'comMain'=> $this->getComMain($company['cid']),
            'topmenus'=> $this->topmenus,
            'prefix_url'=> $this->prefix_url,
            'ak'=> $key,
        ];
        return view('company.contact.index', $result);
    }
}