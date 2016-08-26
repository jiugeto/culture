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
        'product'=> '作品',
        'design'=> '设计',
        'message'=> '留言',
        'frield'=> '好友',
//        'visitor'=> '访问',
//        'census'=> '统计',
        'sign'=> '签到',
        'skin'=> '皮肤',
    ];
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
        $this->userid = \Session::has('user.uid') ? \Session::get('user.uid') : redirect('/login');
        $userSpace = \App\Models\Base\UserSpaceModel::where('uid',$this->userid)->first();
        $this->user = \App\Models\UserModel::find($this->userid);
        $userlog = \App\Models\Admin\UserlogModel::where('uid',$this->userid)
            ->orderBy('id','asc')
            ->get();      //注册的记录
        $this->user->spaceTopBgImg = $userSpace->getPicUrl();
        $this->user->userlog = $userlog;
    }
}