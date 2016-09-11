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

    public function index($m=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'modules'=> $this->modules(),
            'layoutHomeSwitchs'=> $this->getLayoutHomeSwitchs(),
            'comMain'=> ComMainModel::where('cid',$this->cid)->first(),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
            'm'=> $m,   //0模块，1首页
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

    /**
     * 控制公司首页信息显示
     */
    public function layoutHomeSwitch($key,$switch)
    {
        $comMainModel = ComMainModel::where('cid',$this->cid)->first();
        $layoutHome = $comMainModel->layoutHome;
        if ($layoutHome) {
            $arrs = unserialize($layoutHome);
            foreach ($arrs as $karr=>$arr) {
                if($arr['key']==$key) { $arrs[$karr]['value'] = $switch; }
            }
        }
        $arrResult = (isset($arrs)&&$arrs) ? serialize($arrs) : $comMainModel->layoutHome;
        ComMainModel::where('cid',$this->cid)->update(['layoutHome'=> $arrResult]);
        return redirect(DOMAIN.'company/admin/layout/m/1');
    }

    /**
     * 公司页面皮肤更换
     */
    public function setSkin($skin)
    {
        ComMainModel::where('cid',$this->cid)->update(['skin'=> $skin]);
        return redirect(DOMAIN.'company/admin/layout/m/1');
    }




    /**
     * 公司首页模块
     */
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