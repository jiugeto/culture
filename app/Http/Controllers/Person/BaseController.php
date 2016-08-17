<?php
namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * 个人后台基础控制器
     */

    protected $links = [
        'space'=> '空间首页',
        'pic'=> '相册',
        'user'=> '资料',
        'video'=> '视频',
        'works'=> '作品',
        'design'=> '设计',
        'message'=> '留言',
        'frield'=> '好友',
        'visitor'=> '访问',
        'census'=> '统计',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->userid = \Session::has('user.uid') ? \Session::get('user.uid') : redirect('/login');
        $this->user = \App\Models\UserModel::find($this->userid);
    }
}