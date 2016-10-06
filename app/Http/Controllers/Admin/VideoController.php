<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Base\VideoModel;

class VideoController extends BaseController
{
    /**
     * 系统后台视频管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new VideoModel();
        $this->crumb['']['name'] = '视频列表';
        $this->crumb['category']['name'] = '视频管理';
        $this->crumb['category']['url'] = 'video';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/video',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.video.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
       return view('admin.video.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        VideoModel::create($data);
        return redirect(DOMAIN.'admin/video');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> VideoModel::find($id),
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.video.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        VideoModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/video');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> VideoModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.video.show', $result);
    }

    public function pre($id)
    {
        $result = [
            'video'=> VideoModel::find($id),
        ];
        return view('layout.videoPre', $result);
    }





    /**
     * =================
     * 一下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->link) {
            echo "<script>alert('视频链接信息必填！');history.go(-1);</script>";exit;
        } elseif (!strstr($request->link,'?') || !strstr($request->link,'&')) {
            echo "<script>alert('视频链接信息格式有误！');history.go(-1);</script>";exit;
        }
        $links = explode('?',$request->link);
        $video = [
            'name'=> $request->name,
            'pic_id'=> $request->pic_id,
            'url'=> $links[0],
            'url2'=> $links[1],
            'intro'=> $request->intro,
        ];
        return $video;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        $datas = VideoModel::where('del',0)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    /**
     * 视频上传方法
     */
    public function uploadWay()
    {
        $curr['name'] = '视频上传方法';
        $curr['url'] = 'uploadWay';
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.video.uploadWay', $result);
    }
}