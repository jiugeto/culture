<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Company\ComFunctionsModel;

class ComFunctionController extends BaseController
{
    /**
     * 系统后台会员的公司页面控制管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new ComFunctionsModel();
        $this->crumb['']['name'] = '企业功能列表';
        $this->crumb['category']['name'] = '企业功能管理';
        $this->crumb['category']['url'] = 'comfunction';
    }

    public function index($isdesault=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($isdesault),
            'prefix_url'=> '/admin/comfunction',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunction.index', $result);
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
        return view('admin.comfunction.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        ComFunctionsModel::create($data);
        return redirect('/admin/comfunction');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> ComFunctionsModel::find($id),
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunction.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        ComFunctionsModel::where('id',$id)->update($data);
        return redirect('/admin/comfunction');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> ComFunctionsModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.comfunction.show', $result);
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
    public function query($isdefault)
    {
        if ($isdefault) {
            $datas = ComFunctionsModel::where('isdefault',$isdefault)->paginate($this->limit);
        } else {
            $datas = ComFunctionsModel::paginate($this->limit);
        }
        return $datas;
    }
}