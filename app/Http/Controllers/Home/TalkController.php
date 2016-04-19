<?php
namespace App\Http\Controllers\Home;

use App\Models\TalksModel;
use Illuminate\Http\Request;

class TalkController extends BaseController
{
    /**
     * 前台创意管理
     */

    public function __construct()
    {
        $this->userid = \Session::get('user.uid');
    }

    public function index()
    {
        $datas = TalksModel::where('del',0)
                    ->where('uid',$this->userid)
                    ->orderBy('sort','desc')
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
        $result = [
            'datas'=> $datas,
            'curr'=> '',
        ];
        return view('home.talk.index', $result);
    }

    public function follow()
    {
        $datas = TalksModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $result = [
            'datas'=> $datas,
            'curr'=> 'follow',
        ];
        return view('home.talk.index', $result);
    }

    public function create()
    {
        if (!$this->userid) { echo "<script>alert('您还未登陆/注册！');window.location.href='/login';</script>";exit; }
        return view('home.talk.create');
    }

    public function store(Request $request)
    {
        if (!$this->userid) { return redirect('/login'); }
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
//        dd($data);
        TalksModel::create($data);
        return redirect('/talk');
    }

    public function edit($id)
    {
        if (!$this->userid) { echo "<script>alert('您还未登陆/注册！');window.location.href='/login';</script>";exit; }
        return view('home.talk.edit', array('data'=> TalksModel::find($id)));
    }

    public function update(Request $request,$id)
    {
        if (!$this->userid) { return redirect('/login'); }
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        TalksModel::where('id',$id)->update($data);
        return redirect('/talk');
    }

    public function show($id)
    {
        return view('home.talk.show', array('data'=>TalksModel::find($id)));
    }

    /**
     * 关注话题
     */
    public function tofollow($id){}

    /**
     * 感谢话题
     */
    public function tothank($id){}

    /**
     * 点赞话题
     */
    public function toclick($id){}

    /**
     * 分享话题
     */
    public function toshare($id){}

    /**
     * 举报话题
     */
    public function toreport($id){}

    /**
     * 收藏话题
     */
    public function tocollect($id){}




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

//    public function query()
//    {
//        return TalksModel::where('del',0)
//            ->orderBy('sort','desc')
//            ->orderBy('id','desc')
//            ->paginate($this->limit);
//    }
}