<?php
namespace App\Http\Controllers\Company\Admin;

class BasicController extends BaseController
{
    /**
     * 企业后台基本设置
     */

    public function __construct()
    {
        $this->list['func']['name'] = '基本设置';
        $this->list['func']['url'] = 'basic';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
        ];
        return view('company.admin.basic.index', $result);
    }
}