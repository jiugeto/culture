<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiDesign;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class DesignController extends BaseController
{
    /**
     * 系统后台设计管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '设计列表';
        $this->crumb['category']['name'] = '设计管理';
        $this->crumb['category']['url'] = 'design';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'admin/design';
        $apiDesign = ApiDesign::index($this->limit,$pageCurr,0,0,0,0,0);
        if ($apiDesign['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiDesign['data']; $total = $apiDesign['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.design.index', $result);
    }

//    public function trash()
//    {
//        $curr['name'] = $this->crumb['trash']['name'];
//        $curr['url'] = $this->crumb['trash']['url'];
//        $result = [
//            'datas'=> $this->query($del=0),
//            'prefix_url'=> DOMAIN.'admin/design/trash',
//            'crumb'=> $this->crumb,
//            'curr'=> $curr,
//        ];
//        return view('admin.design.index', $result);
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
        return view('admin.design.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiDesign = ApiDesign::add($data);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/design');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiDesign = ApiDesign::show($id);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiDesign['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.design.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiDesign = ApiDesign::modify($data);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/design');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiDesign = ApiDesign::show($id);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiDesign['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.design.show', $result);
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
        $apiDesign = ApiDesign::show($id);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiDesign['data']['thumb']) {
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
        $apiDesign2 = ApiDesign::setThumb($data);
        if ($apiDesign2['code']!=0) {
            echo "<script>alert('".$apiDesign2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/design');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiDesign = ApiDesign::setShow($id,$isshow);
        if ($apiDesign['code']!=0) {
            echo "<script>alert('".$apiDesign['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/design');
    }






    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $userType = $apiUser['data']['isuser'];
        if ($userType==4) {
            $genre = 1;     //个人供应
        } else if (in_array($userType,[1,2])) {
            $genre = 2;     //个人需求
        } else if ($userType==8) {
            $genre = 3;     //公司供应，待添加
        } else if (in_array($userType,[3,5,6,7])) {
            $genre = 4;     //企业需求
        } else if ($userType==50) {
            $genre = 0;     //超级用户
        }
        return array(
            'name'  =>  $request->name,
            'genre' =>  $genre,
            'cate'  =>  $request->cate,
            'uid'   =>  $apiUser['data']['id'],
            'intro' =>  $request->intro,
            'detail'    =>  $request->detail,
            'money' =>  $request->money,
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiDesign::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}