<?php
namespace App\Http\Controllers\Member;

use App\Models\Talk\TalksClickModel;
use App\Models\Talk\TalksCollectModel;
use App\Models\Talk\TalksFollowModel;
use App\Models\Talk\TalksModel;
use App\Models\Talk\TalksReportModel;
use App\Models\Talk\TalksShareModel;
use App\Models\Talk\TalksThankModel;

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

    public function index($index=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($index),
            'prefix_url'=> DOMAIN.'member/talk',
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'index'=> $index,
        ];
        return view('member.talk.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> TalksModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
       return view('member.talk.show', $result);
    }





    public function query($index)
    {
        $uid = $this->userid ? $this->userid : 0;
        //1click，2collect，3follow，4reply，5share，6thank
        if ($index) {
            if ($index==1) {
                $models = TalksClickModel::where('uid',$uid)->get();
            } elseif ($index==2) {
                $models = TalksCollectModel::where('uid',$uid)->get();
            } elseif ($index==3) {
                $models = TalksFollowModel::where('uid',$uid)->get();
            } elseif ($index==4) {
                $models = TalksReportModel::where('uid',$uid)->get();
            } elseif ($index==5) {
                $models = TalksShareModel::where('uid',$uid)->get();
            } elseif ($index==6) {
                $models = TalksThankModel::where('uid',$uid)->get();
            }
            $ids = array();
            if (isset($models)&&count($models)) {
                foreach ($models as $model) {
                    $ids[] = $model->talkid;
                }
            }
            $datas = TalksModel::whereIn('id',$ids)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = TalksModel::where('uid',$uid)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}