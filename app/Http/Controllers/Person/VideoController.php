<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiBusiness\ApiGoods;

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
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        $prefix_url = DOMAIN.'person/video';
        $apiGoods = ApiGoods::index($this->limit,$pageCurr,$this->userid,0,0,0,2);
        if ($apiGoods['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiGoods['data']; $total = $apiGoods['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'curr' => $this->curr,
        ];
        return view('person.video.index', $result);
    }

//    public function pre($id)
//    {
//        $data = GoodsModel::find($id);
//        $videoid = $data->video_id ? $data->video_id : 0;
//        $result = [
//            'data'=> $data,
//            'video'=> VideoModel::find($videoid),
//            'uid'=> $this->userid,
//            'videoName'=> $data->name,
//        ];
//        return view('layout.videoPre', $result);
//    }
}