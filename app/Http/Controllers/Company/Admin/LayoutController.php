<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComModuleModel;

class LayoutController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '公司信息';
        $this->lists['category']['url'] = 'cominfo';
        $this->lists['func']['name'] = '页面布局';
        $this->lists['func']['url'] = 'layout';
    }

    public function index()
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'modules'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.layout.index', $result);
    }

    public function query()
    {
        return ComModuleModel::where('cid',$this->cid)->orderBy('sort','desc')->orderBy('id','desc')->get();
    }
}