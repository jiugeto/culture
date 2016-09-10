<?php
namespace App\Http\Controllers\Company\Admin;

class InfoController extends BaseController
{
    /**
     * 企业后台 公司信息
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '公司信息';
        $this->lists['func']['url'] = 'info';
    }

    public function index()
    {
        $result = [
            'layout'=> $this->layout(),
            'basic'=> $this->basic(),
            'singles'=> $this->singles(),
            'links'=> $this->links(),
            'lists'=> $this->lists,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.info.index', $result);
    }




    //页面布局
    public function layout()
    {
    }

    //基本设置
    public function basic()
    {
    }

    //单页管理
    public function singles()
    {
    }

    //链接管理
    public function links()
    {
    }
}