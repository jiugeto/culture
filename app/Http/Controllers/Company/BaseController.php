<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\ComMainModel;
use App\Models\Company\ComModuleModel;
use App\Models\CompanyModel;
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
//        if (!\Session::has('user.uid')) { return redirect('/login'); }
//        $this->userid = \Session::get('user.uid');
//        if (!\Session::has('user.cid')) { return redirect('/member/setting/auth'); }
//        $this->cid = \Session::get('user.cid');
//        $this->company = unserialize(\Session::get('user.company'));
//
//        //企业页面header菜单 type_id==2
//        $this->getComModules();
//        $this->topmenus = LinkModel::where('cid',$this->cid)
//                                ->where('type_id', 2)
//                                ->where('isshow', 1)
//                                ->orderBy('sort','desc')
//                                ->orderBy('id','desc')
//                                ->get();
    }

    public function company($cid)
    {
        //判断cid
        if (!$cid && !\Session::has('user.cid')) {
            echo "<script>alert('参数错误，或者没有权限！');history.go(-1);</script>";exit;
        } elseif ($cid && !\Session::has('user.cid')) {
            $this->cid = $cid;
            $this->company = CompanyModel::find($cid);
            $this->userid = $this->company->uid;
        }elseif (!$cid && \Session::has('user.cid')) {
            $this->userid = \Session::get('user.uid');
            $this->cid = \Session::get('user.cid');
            $this->company = unserialize(\Session::get('user.company'));
        }
        $this->getComModules($this->cid);
        $this->topmenus = LinkModel::where('cid',$this->cid)
            ->where('type_id', 2)
            ->where('isshow', 1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->get();
        return array(
            'uid'=> $this->userid,
            'cid'=> $this->cid,
            'company'=> $this->company,
            'topmenus'=> $this->topmenus,
        );
    }

    /**
     * 公司基本信息
     */
    public function getComMain($cid)
    {
        return ComMainModel::where('cid',$this->cid)->first();
    }

    /**
     * 企业页面模块获取更新
     */
    public function getComModules($cid)
    {
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