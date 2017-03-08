<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiComFunc;
use App\Api\ApiBusiness\ApiComModule;
use App\Api\ApiUser\ApiCompany;
use App\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;

class ComFuncController extends BaseController
{
    /**
     * 系统后台企业模块 Company Module
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['category']['name'] = '企业功能管理';
        $this->crumb['category']['url'] = 'comfunc';
        $this->crumb['']['name'] = '企业功能列表';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/comfunc';
        $apiFunc = ApiComFunc::index($this->limit,$pageCurr,0,0);
        if ($apiFunc['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiFunc['data']; $total = $apiFunc['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.comfunc.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
//        //记录数限制
//        if (count($this->getModules())>$this->firmNum-1) {
//            echo "<script>alert('已满".$this->firmNum."条记录！');history.go(-1);</script>";exit;
//        }
        $result = [
            'modules' => $this->getModules(),
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.comfunc.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        return redirect(DOMAIN.'admin/comfunc');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComFuncModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunc.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        return redirect(DOMAIN.'admin/comfunc');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiFunc = ApiComFunc::show($id);
        if ($apiFunc['code']!=0) {
            echo "<script>alert('".$apiFunc['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiFunc['data'],
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.comfunc.show', $result);
    }

    /**
     * ajax更新公司模块
     */
    public function setInit(Request $request)
    {
        if (AjaxRequest::ajax()) {
            $cname = $request->cname;
            if (!$cname) {
                echo json_encode(array('code'=>'-2', 'msg' => '参数有误！'));exit;
            }
            $apiCompany = ApiCompany::getOneByCname($cname);
            if ($apiCompany['code']!=0) {
                echo json_encode(array('code'=>'-3', 'msg' => '没有此公司！'));exit;
            }
            $apiFunc = ApiComFunc::setInit($apiCompany['data']['id']);
            if ($apiFunc['code']!=0) {
                echo json_encode(array('code'=>'-4', 'msg' => $apiFunc['msg']));exit;
            }
            $html = "";
            foreach ($apiFunc['data'] as $func) {
                $html .= "<option value='".$func['id']."'>".$func['name']."</option>";
            }
            echo json_encode(array('code'=>'0', 'data' => $html));exit;
//            $apiModule = ApiComModule::initModule($apiCompany['data']['id']);
//            if ($apiModule['code']!=0) {
//                echo json_encode(array('code'=>'-4', 'msg' => $apiModule['msg']));exit;
//            }
//            echo json_encode(array('code'=>'0', 'data' => $apiModule['data']));exit;
        }
        echo json_encode(array('code'=>'-1', 'msg' => '数据错误！'));exit;
    }

//    public function forceDelete($id)
//    {
//        ComFuncModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'admin/comfunc');
//    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if ($request->small && mb_substr($request->small,-1,1,'utf-8')!='|') {
            $request->small = $request->small.'|';
        }
        $data = [
            'name'=> $request->name,
            'module_id'=> $request->module_id,
            'intro'=> $request->intro,
            'small'=> $request->small,
        ];
        return $data;
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiComFunc::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }

    /**
     * 获取所有模块
     */
    public function getModules()
    {
        $apiModules = ApiComModule::getModulesByCid(0,2);
        return $apiModules['code']==0 ? $apiModules['data'] : [];
    }
}