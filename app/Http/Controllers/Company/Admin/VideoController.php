<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Base\VideoModel;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    /**
     * 企业后台 视频管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '综合应用';
        $this->lists['category']['url'] = 'general';
        $this->lists['func']['name'] = '视频管理';
        $this->lists['func']['url'] = 'video';
        $this->model = new VideoModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.video.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.video.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'pics'=> $this->model->pics($this->userid),
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.video.create', $result);
    }

    public function store(Request $request)
    {
//        //视频上传处理
//        if($request->hasFile('url_ori')){  //判断文件存在
//            //验证图片大小
//            foreach ($_FILES as $pic) {
//                if ($pic['size'] > $this->uploadVideoSizeLimit) {
//                    echo "<script>alert(\"对不起，你上传的视频过大，请重新选择\");history.go(-1);</script>";exit;
//                }
//            }
//            $video = $request->file('url_ori');  //获取文件
//            $url = \App\Tools::uploadVideo($video);
//        }
//        if (!isset($url)) {
//            echo "<script>alert('对不起，您还没上传视频！');history.go(-1);</script>";exit;
//        }
        $data = $this->getData($request);
//        $data['url'] = isset($url)?$url:'';
        $data['created_at'] = date('Y-m-d H:i:s', time());
        VideoModel::create($data);
        return redirect(DOMAIN.'company/admin/video');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> VideoModel::find($id),
            'pics'=> $this->model->pics($this->userid),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.video.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        VideoModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'company/admin/video');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> VideoModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func'=> $this->lists['func']['url'],
        ];
        return view('company.admin.video.show', $result);
    }

    public function destroy($id)
    {
        VideoModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'company/admin/video');
    }

    public function restore($id)
    {
        VideoModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'company/admin/video');
    }

    public function forceDelete($id)
    {
        //同时销毁对应的视频
        $picModel = VideoModel::find($id);
        if (unlink(ltrim($picModel->url,'/')) && VideoModel::where('id',$id)->delete()) {
            echo "<script>alert('图片销毁成功！');window.location.href='".DOMAIN."company/admin/video/trash';</script>";exit;
        } else {
            echo "<script>alert('图片销毁失败！');window.location.href='".DOMAIN."company/admin/video/trash';</script>";exit;
        }
    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->url) {
            echo "<script>alert('视频地址必填！');history.go(-1);</script>";exit;
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
        $data = [
            'uid'=> $this->userid,
            'name'=> $request->name,
            'intro'=> $request->intro,
            'url'=> isset($url) ? $url : '',
            'url2'=> isset($url2) ? $url2 : '',
            'width'=> $request->width,
            'height'=> $request->height,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        $datas = VideoModel::where('uid',$this->userid)
            ->where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}