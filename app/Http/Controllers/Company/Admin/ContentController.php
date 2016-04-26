<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComFuncModel;

class ContentController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->list['func']['name'] = '内容设置';
        $this->list['func']['url'] = 'content';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->list,
        ];
        return view('company.admin.content.index', $result);
    }




    public function query()
    {
        return ComFuncModel::where('cid',$this->cid)->get();
    }
}