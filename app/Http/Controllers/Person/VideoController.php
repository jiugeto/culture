<?php
namespace App\Http\Controllers\Person;

use App\Models\GoodsModel;
use App\Models\VideoModel;

class VideoController extends BaseController
{
    /**
     * 个人后台 视频列表
     */

    public function index(){}

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
}