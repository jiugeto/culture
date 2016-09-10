<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Company\ComMainModel;
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
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'modules'=> $this->modules(),
            'layoutHomeSwitchs'=> $this->getLayoutHomeSwitchs(),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.layout.index', $result);
    }

    /**
     * 控制模块是否显示
     */
    public function isshow($id,$isshow)
    {
        ComModuleModel::where('id',$id)->update(['isshow'=> $isshow]);
        return redirect(DOMAIN.'company/admin/layout');
    }

    /**
     * 控制模块排序
     */
    public function sort($id,$sort)
    {
        ComModuleModel::where('id',$id)->update(['sort'=> $sort]);
        return redirect(DOMAIN.'company/admin/layout');
    }




    public function modules()
    {
        return ComModuleModel::whereIn('cid',[0,$this->cid])
            ->orderBy('sort','desc')
            ->orderBy('id','asc')
            ->get();
    }

    /**
     * 获取企业首页的功能显示列表
     */
    public function getLayoutHomeSwitchs()
    {
        $comMainModel = ComMainModel::where('cid',$this->cid)->first();
        return unserialize($comMainModel->layoutHome);
    }
}