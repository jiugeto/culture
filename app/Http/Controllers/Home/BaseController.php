<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\BaseController as Controller;

class BaseController extends Controller
{
    /**
     * 前台页面基础控制器
     */
    protected $list= [
        'home' => '首 页',
        'active' => '最新活动',
        'product' => '产品样片',
        'creation' => '动画片段',
        'supply' => '供应企业',
        'demand' => '需求信息',
        'entertain' => '娱乐频道',
        'rent' => '租赁频道',
        'design' => '设计频道',
        'idea' => '故事脚本',
        'delivery' => '视频投放',
        'dub' => '配音频道',
    ];
    protected $number = [       //首页楼的序号
        1=>1,2,3,4,5,6,7,8,9,10,11,12,13
    ];
    protected $floors = [       //首页楼标题
        1=>'动画片段','产品样片','供应单位','推荐产品','样片需求','娱乐信息','租赁信息',
        8=>'设计作品','推荐故事','最新话题','实时数据','合作单位','用户心声',
    ];

    public function __construct()
    {
        parent::__construct();
        if (!\Session::has('user.uid')) { return redirect('/login'); }
        $this->userid = \Session::get('user.uid');
    }
}