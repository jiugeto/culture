<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiComModule;
use App\Api\ApiUser\ApiCompany;
use Illuminate\Http\Request;

class ComModuleController extends BaseController
{
    /**
     * 系统后台企业模块 Company Module
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '企业模块列表';
        $this->crumb['category']['name'] = '企业模块管理';
        $this->crumb['category']['url'] = 'commodule';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/commodule';
        $apiModule = ApiComModule::index($this->limit,$pageCurr,0,0);
        if ($apiModule['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiModule['data']; $total = $apiModule['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commodule.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model' =>$this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commodule.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiModule = ApiComModule::add($data);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/commodule');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiModule = ApiComModule::show($id);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiModule['data'],
            'model' =>$this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commodule.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiModule = ApiComModule::modify($data);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/commodule');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiModule = ApiComModule::show($id);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiModule['data'],
            'model' =>$this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commodule.show', $result);
    }

//    public function forceDelete($id)
//    {
//        ComModuleModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'admin/commodule');
//    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $apiCompany = ApiCompany::getOneByCname($request->cname);
        if ($apiCompany['code']!=0) {
            echo "<script>alert('".$apiCompany['msg']."');history.go(-1);</script>";exit;
        }
        return array(
            'name'  =>  $request->name,
            'genre' =>  $request->genre,
            'intro' =>  $request->intro,
            'cid'   =>  $apiCompany['data']['id'],
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiComModule::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}