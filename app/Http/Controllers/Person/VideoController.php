<?php
namespace App\Http\Controllers\Person;

use App\Models\GoodsModel;
use App\Models\Base\VideoModel;

class VideoController extends BaseController
{
    /**
     * 个人后台 视频列表
     */

    protected $curr = 'video';
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'person/video',
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.video.index', $result);
    }

    public function pre($id)
    {
        $data = GoodsModel::find($id);
        $videoid = $data->video_id ? $data->video_id : 0;
        $result = [
            'data'=> $data,
            'video'=> VideoModel::find($videoid),
            'uid'=> $this->userid,
        ];
        return view('layout.videoPre', $result);
    }





    public function query()
    {
        $uid = $this->userid ? $this->userid : 0;
        $datas = VideoModel::where('del',0)
            ->where('uid',$uid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}