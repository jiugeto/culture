<?php
namespace App\Http\Controllers\Company;

class FirmController extends BaseController
{
    /**
     * 企业后台服务
     */

    public function __construct()
    {
        $this->list['func']['name'] = '服务项目';
        $this->list['func']['url'] = 'firm';
    }

    public function index()
    {
        $result = [
            'topmenus'=> $this->topmenus,
            'curr'=> 'firm',
        ];
        return view('company.firm.index', $result);
    }
}