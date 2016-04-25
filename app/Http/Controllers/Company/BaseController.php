<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 公司后台基础控制器
     */

    protected $topmenus = [
        'contact'=> '联系方式',
        'recruit'=> '招聘',
        'team'=> '团队',
        'brief'=> '花絮',
        'serve'=> '服务项目',
        'product'=> '产品',
        'home'=> '首页',
    ];
}