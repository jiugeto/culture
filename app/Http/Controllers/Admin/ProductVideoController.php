<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiProVideo;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;
use App\Tools;

class ProductVideoController extends BaseController
{
    /**
     * 系统后台 离线动画
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '效果动画';
        $this->crumb['category']['name'] = '效果动画';
        $this->crumb['category']['url'] = 'provideo';
    }

    public function index($genre=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/provideo';
        $datas = $this->query($pageCurr,$genre);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
            'genre' => $genre,
        ];
        return view('admin.provideo.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.provideo.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiProVideo = ApiProVideo::add($data);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/provideo');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiProVideo = ApiProVideo::show($id);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiProVideo['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.provideo.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiProVideo = ApiProVideo::modify($data);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/provideo');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiProVideo = ApiProVideo::show($id);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiProVideo['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.provideo.show', $result);
    }

    /**
     * 设置缩略图
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        //判断老图片
        $apiProVideo = ApiProVideo::show($id);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiProVideo['data']['thumb']) {
            $thumbArr = explode('/',$thumbOld);
            unset($thumbArr[0]); unset($thumbArr[1]); unset($thumbArr[2]);
            $path = implode('/',$thumbArr);
        }
        $pathOld = isset($path) ? $path : '';
        //上传图片
        $rstArr=$this->uploadOnlyImg($request->url_ori,$pathOld);
        if ($rstArr['code']!=0) {
            echo "<script>alert('".$rstArr['msg']."');history.go(-1);</script>";exit;
        }
        $thumb = $rstArr['data'];
        $data = [
            'thumb' =>  isset($thumb) ? $thumb : '',
            'id'    =>  $id,
        ];
        $apiProVideo2 = ApiProVideo::setThumb($data);
        if ($apiProVideo2['code']!=0) {
            echo "<script>alert('".$apiProVideo2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/provideo');
    }

    /**
     * 设置视频链接
     */
    public function setLink(Request $request,$id)
    {
        //linkType：1Flash代码，2html代码，3通用代码，4其他网址链接
        $linkType = $request->linkType;
        $link = $request->link;
        if ($linkType==1 && mb_substr($link,mb_strlen($link)-4,4)!='.swf') {
            echo "<script>alert('Flash代码的格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==2 && mb_substr($link,0,6)!='<embed') {
            echo "<script>alert('html代码的格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==3 && mb_substr($link,0,7)!='<iframe') {
            echo "<script>alert('通用代码的格式有误！');history.go(-1);</script>";exit;
        } elseif ($linkType==4 && mb_substr($link,0,4)!='http') {
            echo "<script>alert('其他网址链接的格式有误！');history.go(-1);</script>";exit;
        }
        $data = [
            'id'    =>  $id,
            'linkType'  =>  $linkType,
            'link'  =>  $link,
        ];
        $apiProVideo = ApiProVideo::setLink($data);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/provideo');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiProVideo = ApiProVideo::setShow($id,$isshow);
        if ($apiProVideo['code']!=0) {
            echo "<script>alert('".$apiProVideo['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/provideo');
    }

//    /**
//     * 清空数据表
//     */
//    public function clearTable()
//    {
//        if (env('APP_ENV')!='local' || env('APP_DEBUG')!='true' || \Session::get('admin.username')!='jiuge') {
//            echo "<script>alert('没有权限！');history.go(-1);</script>";exit;
//        }
//        ProductVideoModel::truncate();
//        return redirect(DOMAIN.'admin/provideo');
//    }






    public function getData(Request $request)
    {
        //验证用户
        $rstUser = ApiUsers::getOneUserByUname($request->uname);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        return array(
            'name'  =>  $request->name,
            'genre' =>  $request->genre,
            'uid'   =>  $rstUser['data']['id'],
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
        );
    }

    public function query($pageCurr,$genre)
    {
        $apiProVideo = ApiProVideo::index($this->limit,$pageCurr,$genre,0,0,0);
        return $apiProVideo['code']==0 ? $apiProVideo['data'] : [];
    }

//    public function pre($id)
//    {
//        $proVideo = ProductVideoModel::find($id);
//        $result = [
//            'video'=> VideoModel::find($proVideo->video_id),
//            'videoName'=> $proVideo->name,
//        ];
//        return view('layout.videoPre', $result);
//    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiProVideo::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}