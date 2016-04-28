<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComFirmModel;

class ComFirmController extends BaseController
{
    /**
     * 系统后台企业主体
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFirmModel();
        $this->crumb['']['name'] = '企业服务列表';
        $this->crumb['category']['name'] = '企业服务管理';
        $this->crumb['category']['url'] = 'comfirm';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/comfirm',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfirm.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.cominfo.create', $result);
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
            'name'=> $request->name,
            'detail'=> $request->detail,
            'title'=> $request->title,
            'intro'=> $request->intro,
            'small'=> $request->small,
            'pic_id'=> $request->pic_id?$request->pic_id:0,
            'isdefault'=> $request->isdefault,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return ComFirmModel::paginate($this->limit);
    }
}