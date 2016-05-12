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
        parent::__construct();
        $this->model = new CategoryModel();
        //面包屑处理
        $this->lists['func']['name'] = '分类管理';
        $this->lists['func']['url'] = 'category';
        $this->lists['create']['name'] = '添加类型';
        $this->lists['edit']['name'] = '修改分类';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/member/category',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.category.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/member/category/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.category.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'pidone'=> $this->model->pidone(),      //父ID一级
            'lists'=> $this->lists,
            'curr'=> $curr,
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
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> CategoryModel::find($id),
            'pidone'=> $this->model->pidone(),
            'lists'=> $this->lists,
            'curr'=> $curr,
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
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> CategoryModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
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