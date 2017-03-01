<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiStoryBoard;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class StoryBoardController extends BaseController
{
    /**
     * 系统后台演员管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '分镜列表';
        $this->crumb['category']['name'] = '分镜管理';
        $this->crumb['category']['url'] = 'storyboard';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'admin/storyboard';
        $apiSB = ApiStoryBoard::index($this->limit,$pageCurr,0,0,0);
        if ($apiSB['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiSB['data']; $total = $apiSB['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url'=> $prefix_url,
            'model' => $this->model,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.storyboard.index', $result);
    }

//    public function trash()
//    {
//        $curr['name'] = $this->crumb['trash']['name'];
//        $curr['url'] = $this->crumb['trash']['url'];
//        $result = [
//            'datas'=> $this->query($del=1),
//            'prefix_url'=> DOMAIN.'admin/storyboard/trash',
//            'model'=> $this->model,
//            'crumb'=> $this->crumb,
//            'curr'=> $curr,
//        ];
//        return view('admin.storyboard.index', $result);
//    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiSB = ApiStoryBoard::add($data);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/storyboard');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiSB = ApiStoryBoard::show($id);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiSB['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiSB = ApiStoryBoard::modify($data);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/storyboard');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiSB = ApiStoryBoard::show($id);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiSB['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.storyboard.show', $result);
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
        $apiSB = ApiStoryBoard::show($id);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiSB['data']['thumb']) {
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
        $apiSB2 = ApiStoryBoard::setThumb($data);
        if ($apiSB2['code']!=0) {
            echo "<script>alert('".$apiSB2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/design');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiSB = ApiStoryBoard::setShow($id,$isshow);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/storyboard');
    }

//    public function destroy($id)
//    {
//        StoryBoardModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'admin/storyboard');
//    }
//
//    public function restore($id)
//    {
//        StoryBoardModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'admin/storyboard/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        StoryBoardModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'admin/storyboard/trash');
//    }





    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        return array(
            'name'  =>  $request->name,
            'genre' =>  $request->genre,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'detail'    =>  $request->detail,
            'money'     =>  $request->money,
            'uid'       =>  $apiUser['data']['id'],
            'uname'     =>  $request->uname,
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiStoryBoard::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}