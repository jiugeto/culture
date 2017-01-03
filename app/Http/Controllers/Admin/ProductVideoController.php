<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiUsers;
use App\Tools;
use App\Models\ProductVideoModel;
use Illuminate\Http\Request;

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
        $this->model = new ProductVideoModel();
    }

    public function index($genre=2)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($genre),
            'prefix_url'=> DOMAIN.'admin/provideo',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'genre'=> $genre,
        ];
        return view('admin.provideo.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.provideo.create', $result);
    }

    public function store(Request $request)
    {
        dd($request->all());
        $data = $this->getData($request);
        $data['created_at'] = time();
        //处理缩略图
        $rstThumb = Tools::getAddrByUploadImg($request,$this->uploadSizeLimit);
        if (!$rstThumb) {
            echo "<script>alert('没有图片！');history.go(-1);</script>";exit;
        }
        $data['thumb'] = $rstThumb;
        ProductVideoModel::create($data);
        return redirect(DOMAIN.'admin/provideo');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ProductVideoModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.provideo.edit', $result);
    }

    public function update(Request $request,$id)
    {
        dd($request->all());
        $data = $this->getData($request);
        $data['updated_at'] = time();
        //处理缩略图
        $model = ProductVideoModel::find($id);
        $rstThumb = Tools::getAddrByUploadImg($request,$this->uploadSizeLimit);
        if (!$rstThumb) {
            $thumb = $model->thumb;
        } else {
            $thumb = $rstThumb;
            if ($model->thumb) {
                unlink(ltrim($model->thumb,'/'));
            }
        }
        $data['thumb'] = $thumb;
        ProductVideoModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/provideo');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ProductVideoModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.provideo.show', $result);
    }

    /**
     * 设置是否显示
     */
    public function setIsShow($id,$isshow)
    {
        if (!$id || !in_array($isshow,[0,1,2])) {
            echo "<script>alert('参数有误！');history.go(-1);</script>";exit;
        }
        ProductVideoModel::where('id',$id)->update(['isshow'=> $isshow]);
        return redirect(DOMAIN.'admin/provideo');
    }

    /**
     * 清空数据表
     */
    public function clearTable()
    {
        if (env('APP_ENV')!='local' || env('APP_DEBUG')!='true' || \Session::get('admin.username')!='jiuge') {
            echo "<script>alert('没有权限！');history.go(-1);</script>";exit;
        }
        ProductVideoModel::truncate();
        return redirect(DOMAIN.'admin/provideo');
    }






    public function getData(Request $request)
    {
        //验证用户
        $rstUser = ApiUsers::getOneUserByUname($request->username);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
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
        return array(
            'name'  =>  $request->name,
            'genre' =>  $request->genre,
            'uid' =>  $rstUser['data']['id'],
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'linkType'  =>  $linkType,
            'link'  =>  $link,
        );
    }

    public function query($genre)
    {
        $datas = ProductVideoModel::where('genre',$genre)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
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
}