<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiUser\ApiUsers;
use App\Http\Controllers\BaseController as Controller;
use App\Models\Base\AreaModel;
use Session;

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
        $this->user = $this->user($this->userid);
        $this->user['headImg'] = $this->getUrlByPicId($this->user['head']);
        $this->user['spaceTopBgImg'] = $this->userPicUrl($this->userid);
    }

    /**
     * 用户信息
     */
    public function user($uid)
    {
        $rstUser = ApiUsers::getOneUser($uid);
        if ($rstUser['code']==0) { $rstUser['data']['areaName'] = AreaModel::getAreaStr($rstUser['data']['area']); }
        return $rstUser['code']==0 ? $rstUser['data'] : [];
    }

    /**
     * 用户参数
     */
    public function userParam($uid)
    {
        $userParam = ApiUsers::getParamByUid($uid);
        return $userParam['code']==0 ? $userParam['data'] : [];
    }

    /**
     * 个人后台顶部背景图
     */
    public function userPicUrl($uid)
    {
        $userSpace = $this->userParam($uid);
        $spaceTopBgImg = $userSpace?$userSpace['per_top_bg_img']:'';
        if ($spaceTopBgImg) { $picUrl = $this->getUrlByPicId($spaceTopBgImg); }
        return isset($picUrl) ? $picUrl : '';
    }

    /**
     * 个人头像
     */
    public function getUrlByPicId($pic_id)
    {
        $picModel = PicModel::find($pic_id);
        return $picModel?$picModel->getUrl():'';
    }
}