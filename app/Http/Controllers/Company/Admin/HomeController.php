<?php
namespace App\Http\Controllers\Company\Admin;

class HomeController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '企业管理首页';
        $this->list['func']['url'] = '';
    }

    public function index()
    {
        $result = [
            'menus'=> $this->list,
        ];
        return view('company.admin.home.index', $result);
    }
}