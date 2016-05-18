<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    /**
     * 系统后台视频管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new CategoryModel();
        $this->crumb['']['name'] = '产品类型列表';
        $this->crumb['category']['name'] = '产品类型管理';
        $this->crumb['category']['url'] = 'category';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/category',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.category.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> '/admin/category/trash',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.category.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'pcates'=> CategoryModel::where('pid', 0)->get(),      //暂时父级pid==0
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.category.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        return redirect('/admin/category');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> CategoryModel::find($id),
            'pcates'=> CategoryModel::where('pid', 0)->get(),      //暂时父级pid==0
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.category.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        CategoryModel::where('id',$id)->update($data);
        return redirect('/admin/category');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
//            'actions'=> $this->actions(),
            'data'=> CategoryModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.category.show', $result);
    }

    public function destroy($id)
    {
        CategoryModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/admin/category');
    }

    public function restore($id)
    {
        CategoryModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/admin/category/trash');
    }

    public function forceDelete($id)
    {
        CategoryModel::where('id',$id)->delete();
        return redirect('/admin/category/trash');
    }





    /**
     * =================
     * 一下是公用方法
     * =================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        $video = [
            'name'=> $data['name'],
            'pid'=> $data['pid'],
            'intro'=> $data['intro'],
        ];
        return $video;
    }

    /**
     * 查询方法
     */
    public function query()
    {
        return CategoryModel::orderBy('id','desc')->paginate($this->limit);
    }
}