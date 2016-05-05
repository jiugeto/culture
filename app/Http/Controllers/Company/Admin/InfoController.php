<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComMainModel;

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
            'datas'=> $this->query(),
            'lists'=> $this->lists,
        ];
        return view('company.admin.info.index', $result);
    }




    public function query()
    {
        //页面布局
        //基本设置
        //扩展页面
    }
}