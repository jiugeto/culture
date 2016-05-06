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
            'homes'=> $this->getHomes(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('company.admin.layout.index', $result);
    }

    /**
     * 控制模块是否显示
     */
    public function isshow($isshow)
    {
        $isshow = explode('-',$isshow);
        ComModuleModel::where('id',$isshow[0])->update(['isshow'=>$isshow[1]]);
        return redirect('/company/admin/layout');
    }

    /**
     * 控制模块排序
     */
    public function sort($sort)
    {
        $sort = explode('-',$sort);
        ComModuleModel::where('id',$sort[0])->update(['sort'=>$sort[1]]);
        return redirect('/company/admin/layout');
    }




    public function query()
    {
        return ComModuleModel::where('cid',$this->cid)
//            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->get();
    }

    /**
     * 获取企业首页的功能显示列表
     */
    public function getHomes()
    {
        return array(
//            'ppts'=> ,
//            'firms'=> ,
//            'news'=> ,
//            'products'=> ,
//            'parterners'=> ,
        );
    }
}