<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\FunctionModel;

class FunctionController extends BaseController
{
    /**
     * 系统后台所有细分功能的权限控制统一管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new FunctionModel();
        $this->crumb['']['name'] = '所有功能列表';
        $this->crumb['category']['name'] = '前台功能';
        $this->crumb['category']['url'] = 'function';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'admin/function',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.function.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> DOMAIN.'admin/function/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.function.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.function.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        FunctionModel::create($data);
        return redirect(DOMAIN.'admin/function');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> FunctionModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.function.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        FunctionModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/function');
    }

    public function destroy($id)
    {
        FunctionModel::where('id',$id)->update(['del'=>1]);
        return redirect(DOMAIN.'admin/function');
    }





    /**
     * ====================
     * 以下是公用方法
     * ====================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        $function = [
            'name'=> $data['name'],
            'intro'=> $data['intro'],
            'table_name'=> $data['table_name'],
            'action'=> $data['action'],
        ];
        return $function;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return FunctionModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}