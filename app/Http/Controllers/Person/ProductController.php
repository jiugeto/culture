<?php
namespace App\Http\Controllers\Person;

use App\Models\ProductModel;
use App\Models\VideoModel;

class ProductController extends BaseController
{
    /**
     * 个人后台 视频列表
     */

    protected $curr = 'product';
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'person/product',
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.product.index', $result);
    }

//    public function pre($id)
//    {
//        $data = ProductModel::find($id);
//        $videoid = $data->video_id ? $data->video_id : 0;
//        $result = [
//            'data'=> $data,
//            'video'=> VideoModel::find($videoid),
//            'uid'=> $this->userid,
//        ];
//        return view('layout.videoPre', $result);
//    }





    public function query()
    {
        $uid = $this->userid ? $this->userid : 0;
        $datas = ProductModel::where('del',0)
            ->where('uid',$uid)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}