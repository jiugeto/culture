<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiRent;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class RentController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '租赁列表';
        $this->crumb['category']['name'] = '租赁管理';
        $this->crumb['category']['url'] = 'rent';
    }

    public function index($genre=0,$type=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/rent';
        $apiRent = ApiRent::index($this->limit,$pageCurr,0,$genre,$type,0,0);
        if ($apiRent['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiRent['data']; $total = $apiRent['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
            'genre' => $genre,
            'type' => $type,
        ];
        return view('admin.rent.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.rent.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiRent = ApiRent::add($data);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/rent');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiRent['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.rent.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiRent = ApiRent::modify($data);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/rent');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiRent['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.rent.show', $result);
    }

    /**
     * 更新缩略图
     */
    public function setThumb(Request $request,$id)
    {
        if (!isset($request->url_ori)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        //判断老图片
        $apiRent = ApiRent::show($id);
        if ($apiRent['code']!=0) {
            echo "<script>alert('".$apiRent['msg']."');history.go(-1);</script>";exit;
        }
        if ($thumbOld=$apiRent['data']['thumb']) {
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
        $apiRent2 = ApiRent::setThumb($data);
        if ($apiRent2['code']!=0) {
            echo "<script>alert('".$apiRent2['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/rent');
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiRent = ApiRent::setShow();
    }






    /**
     * 收集数据
     */
    public function getData($request)
    {
        //日期验证
        $fromtime = $request->fromtime ? strtotime($request->fromtime) : 0;
        $totime = $request->totime ? strtotime($request->totime) : 0;
        if ((!$fromtime&&$totime) || ($fromtime&&!$totime)) {
            echo "<script>alert('起始、结束时间须同时选择！');history.go(-1);</script>";exit;
        } else if ($fromtime > $totime) {
            echo "<script>alert('结束时间不能早于起始时间！');history.go(-1);</script>";exit;
        }
        //获取用户信息
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        if (!in_array($apiUser['data']['isuser'],[7,50])) {
            echo "<script>alert('该用户不是租赁商！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'  => $request->name,
            'genre' => $request->genre,
            'type'  => $request->type,
            'intro' => $request->intro,
            'money' => $request->money,
            'fromtime'  => $fromtime,
            'totime'    => $totime,
            'uid'       =>  $apiUser['data']['id'],
            'area'      =>  $apiUser['data']['area'],
        ];
        return $data;
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiRent::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}