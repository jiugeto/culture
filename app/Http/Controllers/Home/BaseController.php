<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
//use App\Models\LinkModel;
//use App\Tools;

class BaseController extends Controller
{
    /**
     * 前台页面基础控制器
     */
    protected $list= [
        'home'=> '首 页',
        'product'=> '产品样片',
        'creation'=> '在线作品',
        'storyboard'=> '故事分镜',
        'supply'=> '供应企业',
        'demand'=> '需求信息',
        'entertain'=> '娱乐频道',
        'rent'=> '租赁频道',
        'design'=> '设计频道',
        'about'=> '关于我们',
        'idea'=> '创意',
        'talk'=> '话题',
        'opinion'=> '用户意见',
    ];
    protected $number = [       //首页楼的序号
        1=>1,2,3,4,5,6,7,8,9,10,11,12,13
    ];
    protected $floors = [       //首页楼标题
        1=>'推荐创意',2=>'最新话题',3=>'在线创作',4=>'产品样片',5=>'供应单位',6=>'推荐产品',7=>'样片需求',8=>'娱乐信息',9=>'租赁信息',10=>'设计信息',11=>'实时数据',12=>'合作单位',13=>'用户心声'
    ];

    public function __construct()
    {
        parent::__construct();
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $this->userid = \Session::get('user.uid');
    }
}