<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
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
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $this->userid = \Session::get('user.uid');
        if (!\Session::has('user.cid')) { return redirect('/member/setting/auth'); }
        $this->cid = \Session::get('user.cid');
        $this->company = unserialize(\Session::get('user.company'));

        //企业页面header菜单 type_id==2
        $this->topmenus = LinkModel::where('cid',$this->cid)
                                ->where('type_id', 2)
                                ->orderBy('sort','desc')
                                ->get();
    }
}