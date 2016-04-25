<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 公司后台基础控制器
     */

    protected $topmenus = [
        'intro'=> '公司介绍',
        'contact'=> '联系方式',
        'recruit'=> '招聘',
        'team'=> '团队',
        'firm'=> '服务项目',
        'brief'=> '花絮',
        'product'=> '产品',
        'home'=> '首页',
    ];
}