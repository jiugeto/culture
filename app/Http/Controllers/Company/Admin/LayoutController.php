<?php
namespace App\Http\Controllers\Company\Admin;

class LayoutController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '页面布局';
        $this->list['func']['url'] = 'layout';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
        ];
        return view('company.admin.layout.index', $result);
    }
}