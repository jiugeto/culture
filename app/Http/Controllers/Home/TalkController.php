<?php
namespace App\Http\Controllers\Home;

use App\Models\TalksClickModel;
use App\Models\TalksCollectModel;
use App\Models\TalksFollowModel;
use App\Models\ThemeModel;
use App\Models\TalksModel;
use App\Models\TalksReportModel;
use App\Models\TalksShareModel;
use App\Models\TalksThankModel;
use App\Models\ThemeTalkModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class TalkController extends BaseController
{
    /**
     * 前台创意管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->userid = \Session::get('user.uid');
    }

    public function islogin()
    {
        if (!\Session::has('user.uid')) {
            echo "<script>alert('您还未登录，请先登录！');window.location.href='/login';</script>";exit;
        }
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'curr'=> '',
        ];
        return view('home.talk.index', $result);
    }

    /**
     * 自己的话题
     */
    public function mytalk()
    {
        $this->islogin();
        $result = [
            'datas'=> $this->query($this->userid),
            'curr'=> 'mytalk',
        ];
        return view('home.talk.index', $result);
    }

    public function query($uid=null)
    {
        if ($uid) {
            $datas = TalksModel::where('del',0)
            ->where('uid',$uid)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        } else {
            $datas = TalksModel::where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 关注的话题
     */
    public function follow()
    {
        $this->islogin();
        $follows = TalksFollowModel::where('uid',$this->userid)->get();
        if (count($follows)) {
            foreach ($follows as $follow) { $followIds[] = $follow->talkid; }
        }
        if (isset($followIds) && $followIds) {
            $datas = TalksModel::where('del',0)
                ->whereId('id',$followIds)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
            $datas->limit = $this->limit;
        }
        $result = [
            'datas'=> isset($datas) ? $datas : [],
            'curr'=> 'follow',
        ];
        return view('home.talk.index', $result);
    }

    /**
     * 收藏的话题
     */
    public function collect()
    {
        $this->islogin();
        $collects = TalksCollectModel::where('uid',$this->userid)->get();
        if (count($collects)) {
            foreach ($collects as $collect) { $collectIds[] = $collect->talkid; }
        }
        if (isset($collectIds) && $collectIds) {
            $datas = TalksModel::where('del',0)
                ->whereId('id',$collectIds)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $result = [
            'datas'=> isset($datas) ? $datas : [],
            'curr'=> 'collect',
        ];
        return view('home.talk.index', $result);
    }

//    /**
//     * 话题主题发现
//     */
//    public function theme()
//    {
//        $datas = ThemeModel::where(['isshow'=>1])
//            ->orderBy('sort','desc')
//            ->orderBy('id','desc')
//            ->paginate($this->limit * 2);
//        $datas->limit = $this->limit;
//        $result = [
//            'datas'=> $datas,
//            'curr'=> 'theme',
//        ];
//        return view('home.talk.theme', $result);
//    }

    /**
     * 我收藏的话题
     */
    public function themelist($themeid)
    {
        $result = [
            'datas'=> ThemeModel::where(['isshow'=>1, 'themeid'=>$themeid])
                                ->orderBy('sort','desc')
                                ->orderBy('id','desc')
                                ->paginate($this->limit * 2),
            'curr'=> 'themelist',
        ];
        return view('home.talk.themelist', $result);
    }

    /**
     * 收藏话题
     */
    public function tomycollect($talkid)
    {
        $data = [
            'talkid'=> $talkid,
            'uid'=> $this->userid,
            'created_at'=> date('Y-m-d H:i:s', time()),
        ];
        TalksCollectModel::create($data);
        return redirect('/talk/collect');
    }

    public function create()
    {
        $this->islogin();
        return view('home.talk.create');
    }

    public function store(Request $request)
    {
        $this->islogin();
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        TalksModel::create($data);
        return redirect('/talk');
    }

    public function edit($id)
    {
        $this->islogin();
        return view('home.talk.edit', array('data'=> TalksModel::find($id)));
    }

    public function update(Request $request,$id)
    {
        $this->islogin();
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        TalksModel::where('id',$id)->update($data);
        return redirect('/talk');
    }

    public function show($id)
    {
        $this->islogin();
        return view('home.talk.show', array('data'=>TalksModel::find($id)));
    }

    /**
     * 关注话题
     */
    public function tofollow($id)
    {
        $msg = '不能关注自己的话题';
        TalksFollowModel::create($this->tolimit($id,$msg));
        return redirect('/talk/follow');
    }

    /**
     * 感谢话题
     */
    public function tothank($id)
    {
        $msg = '不能感谢自己的话题';
        TalksThankModel::create($this->tolimit($id,$msg));
        return redirect('/talk/follow');
    }

    /**
     * 点赞话题
     */
    public function toclick($id)
    {
        $msg = '不能点赞自己的话题';
        TalksClickModel::create($this->tolimit($id,$msg));
        return redirect('/talk/follow');
    }

    /**
     * 分享话题
     */
    public function toshare($id)
    {
        $msg = '不能分享自己的话题';
        TalksShareModel::create($this->tolimit($id,$msg));
        return redirect('/talk/follow');
    }

    /**
     * 举报话题
     */
    public function toreport($id)
    {
        $msg = '不能举报自己的话题';
        TalksReportModel::create($this->tolimit($id,$msg));
        return redirect('/talk/follow');
    }

    /**
     * 收藏话题
     */
    public function tocollect($id)
    {
        $msg = '不能收藏自己的话题';
        TalksCollectModel::create($this->tolimit($id,$msg));
        return redirect('/talk/follow');
    }

    /**
     * 一些操作限制
     */
    public function tolimit($id,$msg)
    {
        $this->islogin();
        $talkModel = TalksModel::find($id);
        if ($this->userid==$talkModel->uid) { echo "<script>alert('".$msg."！');history.go(-1);</script>";exit; }
        return array(
            'talkid'=> $id,
            'uid'=> $this->userid,
        );
    }

    public function destroy($id)
    {
        $this->islogin();
        TalksModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/talk/follow');
    }

    public function restore($id)
    {
        $this->islogin();
        TalksModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/talk/follow');
    }

    public function forceDelete($id)
    {
        $this->islogin();
        TalksModel::where('id',$id)->delete();
        return redirect('/talk/follow');
    }




    public function getData(Request $request)
    {
        if (!$request->intro) { echo "<script>alert('内容不能为空！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'content'=> $request->intro,
            'uid'=> $this->userid,
        ];
        return $data;
    }
}