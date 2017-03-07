<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiCompany;
use Illuminate\Http\Request;

class ComMainController extends BaseController
{
    /**
     * 系统后台企业主体 company main
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '企业主体列表';
        $this->crumb['category']['name'] = '企业主体管理';
        $this->crumb['category']['url'] = 'commain';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/commain';
        $apiCompany = ApiCompany::getCompanyList($this->limit,$pageCurr,0);
        if ($apiCompany['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiCompany['data']; $total = $apiCompany['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commain.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiCompany = ApiCompany::show($id);
        if ($apiCompany['code']!=0) {
            echo "<script>alert('".$apiCompany['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiCompany['data'],
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        dd($request->all());
        $data = [
            'name'  =>  $request->name,
            'skin'  =>  $request->skin,
            'layout'    =>  $request->layout,
        ];
        return redirect(DOMAIN.'admin/commain');
    }

    /**
     * 更新logo
     */
    public function setLogo(Request $request,$id){}

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiCompany = ApiCompany::show($id);
        if ($apiCompany['code']!=0) {
            echo "<script>alert('".$apiCompany['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiCompany['data'],
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.commain.show', $result);
    }
}