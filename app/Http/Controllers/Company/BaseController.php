<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\ComMainModel;
use App\Models\Company\ComModuleModel;
use App\Models\LinkModel;

class BaseController extends Controller
{
    /**
     * 公司后台基础控制器
     */

    protected $topmenus = [
//        'contact'=> '联系方式',
//        'recruit'=> '招聘',
//        'team'=> '团队',
//        'firm'=> '服务项目',
//        'part'=> '花絮',
//        'product'=> '产品',
//        'about'=> '关于公司',
//        'home'=> '首页',
    ];

    public function __construct()
    {
        parent::__construct();
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $this->userid = \Session::get('user.uid');
        if (!\Session::has('user.cid')) { return redirect('/member/setting/auth'); }
        $this->cid = \Session::get('user.cid');
        $this->company = unserialize(\Session::get('user.company'));

        //企业页面header菜单 type_id==2
//        dd($this->getComModules());
        $this->getComModules();
        $this->topmenus = LinkModel::where('cid',$this->cid)
                                ->where('type_id', 2)
                                ->where('isshow', 1)
                                ->orderBy('sort','desc')
                                ->orderBy('id','desc')
                                ->get();
//        $this->topmenus['company'] = $this->getComMain();
    }

    /**
     * 公司基本信息
     */
    public function getComMain()
    {
        $mainModel = ComMainModel::where('cid',$this->cid)->first();
        $mainModel0 = ComMainModel::where('cid',0)->first();
        if (!$mainModel) {
            $companyModel = \App\Models\CompanyModel::find($this->cid);
            $main = [
                'uid'=> $this->userid,
                'cid'=> $this->cid,
                'name'=> $companyModel->name,
                'title'=> $mainModel0->title,
                'keyword'=> $mainModel0->keyword,
                'description'=> $mainModel0->description,
                'logo'=> $mainModel0->logo,
                'sort'=> $mainModel0->sort,
                'istop'=> $mainModel0->istop,
                'isshow'=> $mainModel0->isshow,
                'created_at'=> date('Y-m-d H:i:s', time()),
            ];
            ComMainModel::create($main);
        }
        return ComMainModel::where('cid',$this->cid)->first();
    }

    /**
     * 企业页面模块获取更新
     */
    public function getComModules()
    {
        //假如没有。即可生成默认记录
        $moduleModels = ComModuleModel::where('cid',$this->cid)->get();
        $moduleModels0 = ComModuleModel::where('cid',0)->get();
        //有则补充记录
        if (count($moduleModels) && count($moduleModels)<count($moduleModels0)) {
            foreach ($moduleModels0 as $key=>$moduleModel) {
                if ($moduleModels0[$key]->cid!=$this->cid) {
                    $module = [
                        'cid'=> $this->cid,
                        'name'=> $moduleModel->name,
                        'genre'=> $moduleModel->genre,
                        'intro'=> $moduleModel->intro,
                        'sort'=> $moduleModel->sort,
                        'isshow'=> $moduleModel->isshow,
                        'created_at'=> date('Y-m-d H:i:s', time()),
                    ];
                    ComModuleModel::create($module);
                }
            }
        }
        //无则生成一组记录
        if (!count($moduleModels)) {
            foreach (ComModuleModel::where('cid',0)->get() as $moduleModel) {
                $module = [
                    'cid'=> $this->cid,
                    'name'=> $moduleModel->name,
                    'genre'=> $moduleModel->genre,
                    'intro'=> $moduleModel->intro,
                    'sort'=> $moduleModel->sort,
                    'isshow'=> $moduleModel->isshow,
                    'created_at'=> date('Y-m-d H:i:s', time()),
                ];
                ComModuleModel::create($module);
            }
        }
        return ComModuleModel::where('cid',$this->cid)->get();
    }

    /**
     * 获取所属模块id
     */
    public function getModuleId($genre)
    {
        $moduleModel = ComModuleModel::where('cid',$this->cid)->where('genre',$genre)->first();
        if (!$moduleModel) { $moduleModel = ComModuleModel::where('cid',0)->where('genre',$genre)->first(); }
        return $moduleModel->id;
    }
}