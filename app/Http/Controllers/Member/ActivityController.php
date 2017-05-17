<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiUser\ApiActivity;

class ActivityController extends BaseController
{
    /**
     * 最新活动
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '活动管理';
        $this->lists['func']['url'] = 'active';
//        $this->lists['create']['name'] = '添加艺人';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'member/active';
        $apiActivity = ApiActivity::getUsersByUid(20,$pageCurr,$this->userid);
        if ($apiActivity['code']!==0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiActivity['data']; $total = $apiActivity['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'genre' => 0,
        ];
        return view('member.active.index',$result);
    }

    public function getApply($act_id)
    {
        $data = [
            'act_id'=>  $act_id,
            'uid'   =>  $this->userid,
        ];
        $apiActivity = ApiActivity::getApply($data);
    }
}