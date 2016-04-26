<?php
namespace App\Http\Controllers\Company\Admin;

class ContentController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        $this->list['func']['name'] = '内容设置';
        $this->list['func']['url'] = 'content';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->list,
        ];
        return view('company.admin.content.index', $result);
    }
}