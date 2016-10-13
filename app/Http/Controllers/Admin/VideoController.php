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
            'pics'=> $this->model->pics(),
            'curr'=> $curr,
        ];
       return view('admin.video.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        dd($data);
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
        $data = VideoModel::find($id);
        $result = [
            'video'=> $data,
            'videoName'=> $data->name,
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
        if (!$request->pic_id) {
            echo "<script>alert('缩略图必选！');history.go(-1);</script>";exit;
        } elseif (!$request->link) {
            echo "<script>alert('视频链接信息必填！');history.go(-1);</script>";exit;
        } elseif (!strstr($request->link,'?') || !strstr($request->link,'&')) {
            echo "<script>alert('视频链接信息格式有误！');history.go(-1);</script>";exit;
        }
        //url处理
        if (strstr($request->url,'?')) {
            $urls = explode('?',$request->url);
            $url = $urls[0];
            $url_2 = explode('&',$urls[1]);
            if (strstr($urls[1],'width') && strstr($urls[1],'height')) {
                unset($url_2[count($url_2)-1]); unset($url_2[count($url_2)-1]);
            }
            if (strstr($urls[1],'auto_play')) { unset($url_2[count($url_2)-2]); }
            $url2 = implode('&',$url_2);
        }
        //视频门户网判断
        if (strstr($request->url,'letv.com')) {
            $urlSel = 1;
        } elseif (strstr($request->url,'qq.com')) {
            $urlSel = 2;
        } elseif (strstr($request->url,'youku.com')) {
            $urlSel = 3;
        }
        $video = [
            'name'=> $request->name,
            'pic_id'=> $request->pic_id,
            'intro'=> $request->intro,
            'urlSel'=> $urlSel,
            'url'=> isset($url) ? $url : '',
            'url2'=> isset($url2) ? $url2 : '',
            'width'=> $request->width,
            'height'=> $request->height,
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