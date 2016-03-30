<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\LinkModel;
use App\Tools;

class BaseController extends Controller
{
    /**
     * 前台页面基础控制器
     */
    protected $list= [
        'home'=> '首 页',
        'product'=> '产品样片',
        'creation'=> '在线作品',
        'supply'=> '供应单位',
        'demand'=> '需求信息',
        'entertain'=> '娱乐频道',
        'rent'=> '租赁频道',
        'design'=> '设计频道',
        'about'=> '关于我们',
    ];
}