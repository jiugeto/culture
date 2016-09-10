<?php
namespace App\Http\Controllers\Company\Admin;

class HomeController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '首页';
        $this->list['func']['url'] = '';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
            'curr_func'=> 'home',
        ];
        return view('company.admin.home.index', $result);
    }
}