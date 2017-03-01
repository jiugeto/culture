<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiEntertain;
use App\Api\ApiBusiness\ApiGoods;
use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '娱乐列表';
        $this->crumb['category']['name'] = '娱乐管理';
        $this->crumb['category']['url'] = 'entertain';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $prefix_url = DOMAIN.'admin/entertain';
        $apiET = ApiEntertain::index($this->limit,$pageCurr,0,0,0,0);
        if ($apiET['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiET['data']; $total = $apiET['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.entertain.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.entertain.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiET = ApiEntertain::add($data);
        if ($apiET['code']!=0) {
            echo "<script>alert('".$apiET['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/entertain');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiET = ApiEntertain::show($id);
        if ($apiET['code']!=0) {
            echo "<script>alert('".$apiET['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiET['data'],
            'actors' => $this->getActors($apiET['data']['uid']),
            'works' => $this->getWorks($apiET['data']['uid']),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.entertain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiET = ApiEntertain::modify($data);
        if ($apiET['code']!=0) {
            echo "<script>alert('".$apiET['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/entertain');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiET = ApiEntertain::show($id);
        if ($apiET['code']!=0) {
            echo "<script>alert('".$apiET['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiET['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.entertain.show', $result);
    }

    /**
     * 更新缩略图
     */
    public function setThumb(Request $request,$id)
    {
        //判断老图片
        $apiET = ApiEntertain::show($id);
        if ($apiET['code']!=0) {
            echo "<script>alert('".$apiET['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiET['data']['thumb']) {
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
        $apiET2 = ApiEntertain::setThumb($data);
        if ($apiET2['code']!=0) {
            echo "<script>alert('".$apiET2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/entertain');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiET = ApiEntertain::setShow($id,$isshow);
        if ($apiET['code']!=0) {
            echo "<script>alert('".$apiET['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/entertain');
    }






    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        //判断用户、供求
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        if (in_array($apiUser['data']['isuser'],[6,50])) {
            $genre = 1;     //企业供应
        } else if (in_array($apiUser['data']['isuser'],[3,4,5,7,50])) {
            $genre = 2;     //企业需求
        } else {
            echo "<script>alert('该用户不是公司！');history.go(-1);</script>";exit;
        }
        //判断艺人、作品
        if (!isset($request->actor) || (isset($request->actor)&&!$request->actor)) {
            $staff = '';
        } else {
            $staff = implode(',',$request->actor);
        }
        if (!isset($request->work) || (isset($request->work)&&!$request->work)) {
            $work = '';
        } else {
            $work = implode(',',$request->work);
        }
        return array(
            'title' =>  $request->title,
            'intro' =>  $request->intro,
            'uid'   =>  $apiUser['data']['id'],
            'uname' =>  $request->uname,
            'genre' =>  $genre,
            'staff' =>  $staff,
            'work'  =>  $work,
        );
    }

    /**
     * 艺人列表
     */
    public function getActors($uid)
    {
        $apiStaff = ApiStaff::getStaffsByUid($uid,1,1);
        return $apiStaff['code']==0 ? $apiStaff['data'] : [];
    }

    /**
     * 作品列表
     */
    public function getWorks($uid)
    {
        $apiGoods = ApiGoods::getGoodsByUid($uid,4,0);
        return $apiGoods['code']==0 ? $apiGoods['data'] : [];
    }
}