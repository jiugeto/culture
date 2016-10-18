<?php
namespace App\Http\Controllers\Admin;

use App\Models\Base\VideoModel;
use App\Models\Online\ProductVideoModel;

class ProductVideoController extends BaseController
{
    /**
     * 系统后台 离线动画
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '离线动画';
        $this->crumb['category']['name'] = '离线动画';
        $this->crumb['category']['url'] = 'proVideo';
        $this->model = new ProductVideoModel();
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/proVideo',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.proVideo.index', $result);
    }

    public function edit($id){}

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductVideoModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.proVideo.show', $result);
    }






    public function query()
    {
        $datas = ProductVideoModel::orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    public function pre($id)
    {
        $proVideo = ProductVideoModel::find($id);
        $result = [
            'video'=> VideoModel::find($proVideo->video_id),
            'videoName'=> $proVideo->name,
        ];
        return view('layout.videoPre', $result);
    }
}