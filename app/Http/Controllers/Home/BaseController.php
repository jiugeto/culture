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
//    protected $list= [
//        'home'=> '首 页',
//        'product'=> '产品样片',
//        'creation'=> '在线作品',
//        'supply'=> '供应企业',
//        'demand'=> '需求信息',
//        'entertain'=> '娱乐频道',
//        'rent'=> '租赁频道',
//        'design'=> '设计频道',
//        'about'=> '关于我们',
//    ];
    protected $number = [       //首页楼的序号
        1,2,3,4,5,6,7,8,9,10,11,12
    ];
    protected $floors = [       //首页楼标题
        1=>'推荐创意','最新话题','在线创作','特色产品','推荐产品','样片需求','租赁信息','设计信息','实时数据','合作单位','用户心声'
    ];
}