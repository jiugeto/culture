<?php
namespace App\Http\Controllers\Member;

use App\Models\TalksModel;

class TalkController extends BaseController
{
    /**
     * 会员后台 话题列表
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '话题列表';
        $this->lists['func']['url'] = 'talk';
//        $this->lists['create']['name'] = '设计发布';
        $this->model = new TalksModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'member/talk',
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.talk.index', $result);
    }





    public function query()
    {
        $uid = $this->userid ? $this->userid : 0;
        return TalksModel::where('uid',$uid)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}