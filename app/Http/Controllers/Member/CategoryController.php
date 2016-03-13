<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    /**
     * 作品（产品）分类管理
     */

    public function __construct()
    {
        $this->list['func']['name'] = '类型管理';
        $this->list['func']['url'] = 'category';
        $this->list['create']['name'] = '添加类型';
        $this->model = new CategoryModel();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'menus'=> $this->list,
            'prefix_url'=> '/member/category',
            'curr'=> '',
        ];
        return view('member.category.index', $result);
    }

    public function trash()
    {
        $result = [
            'datas'=> $this->query($del=1),
            'menus'=> $this->list,
            'prefix_url'=> '/member/category/trash',
            'curr'=> 'trash',
        ];
        return view('member.category.index', $result);
    }

    public function create()
    {
        $result = [
            'menus'=> $this->list,
            'pidone'=> $this->model->pidone(),
        ];
        return view('member.category.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        CategoryModel::create($data);
        return redirect('/member/category');
    }

    public function edit($id)
    {
        $result = [
            'data'=> CategoryModel::find($id),
            'menus'=> $this->list,
            'pidone'=> $this->model->pidone(),
        ];
        return view('member.category.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        CategoryModel::where('id',$id)->update($data);
        return redirect('/member/category');
    }

    public function show($id)
    {
        $result = [
            'data'=> CategoryModel::find($id),
            'menus'=> $this->list,
        ];
        return view('member.category.show', $result);
    }

    public function destroy($id)
    {
        CategoryModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/category');
    }

    public function restore($id)
    {
        CategoryModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/category/trash');
    }

    public function forceDelete($id)
    {
        CategoryModel::where('id',$id)->delete();
        return redirect('/member/category/trash');
    }





    /**
     * ===========
     * 以下是公用方法
     * ===========
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //限制名称字符长度
        if (mb_strlen($data['name'])>=50) {
            echo "<script>alert('分类名称长度不能多于50个字符！');history.go(-1);</script>";exit;
        }
        $category = [
            'name'=> $data['name'],
            'pid'=> $data['pid'],
            'intro'=> $data['intro'],
        ];
        return $category;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return CategoryModel::where('del',$del)->paginate($this->limit);
    }
}