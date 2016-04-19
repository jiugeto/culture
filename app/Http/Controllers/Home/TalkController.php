<?php
namespace App\Http\Controllers\Home;

use App\Models\TalksModel;
use Illuminate\Http\Request;

class TalkController extends BaseController
{
    /**
     * 前台创意管理
     */

    public function index()
    {
        return view('home.talk.index', array('datas'=> $this->query()));
    }

    public function show($id)
    {
        return view('home.talk.show', array('data'=>TalksModel::find($id)));
    }

    /**
     * 关注话题
     */
    public function follow($id){}

    /**
     * 感谢话题
     */
    public function thank($id){}

    /**
     * 点赞话题
     */
    public function click($id){}

    /**
     * 分享话题
     */
    public function share($id){}

    /**
     * 举报话题
     */
    public function report($id){}

    /**
     * 收藏话题
     */
    public function collect($id){}

    public function query()
    {
        return TalksModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}