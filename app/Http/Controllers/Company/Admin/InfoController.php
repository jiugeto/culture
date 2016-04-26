<?php
namespace App\Http\Controllers\Company\Admin;

class InfoController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '公司信息';
        $this->list['func']['url'] = 'info';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
        ];
        return view('company.admin.info.index', $result);
    }
}