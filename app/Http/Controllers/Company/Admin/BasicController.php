<?php
namespace App\Http\Controllers\Company\Admin;

class BasicController extends BaseController
{
    /**
     * 企业后台基本设置
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '基本设置';
        $this->lists['func']['url'] = 'basic';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
//            'datas'=> $this->query($this->module),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.basic.index', $result);
    }
}