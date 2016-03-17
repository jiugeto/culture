<?php
namespace App\Http\Controllers\Member;

use App\Tools;
use Illuminate\Http\Request;
use App\Models\CategoryModel;

class CategoryController extends BaseController
{
    /**
     * 作品（产品）分类管理
     */

    public function __construct()
    {
        $this->model = new CategoryModel();
        //面包屑处理
        $this->list['func']['name'] = '类型管理';
        $this->list['func']['url'] = 'category';
        $this->list['create']['name'] = '添加类型';
        $this->list['edit']['name'] = '修改分类';
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/member/category',
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.category.index', $result);
    }

    public function trash()
    {
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/member/category/trash',
            'menus'=> $this->list,
            'curr'=> 'trash',
        ];
        return view('member.category.index', $result);
    }

    public function create()
    {
        $result = [
            'pidone'=> $this->model->pidone(),
            'menus'=> $this->list,
            'curr'=> 'create',
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
            'pidone'=> $this->model->pidone(),
            'menus'=> $this->list,
            'curr'=> 'edit',
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
            'curr'=> 'show',
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
        $categorys = CategoryModel::where('del',$del)->paginate($this->limit);
//        $categorys = Tools::getChild($categorys);       //子分类放在父分类下面
        return $categorys;
    }
}