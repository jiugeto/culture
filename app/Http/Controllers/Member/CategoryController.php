<?php
namespace App\Http\Controllers\Member;

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
//        $this->model = new CategoryModel();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'menus'=> $this->list,
            'prefix_url'=> '/member/category',
        ];
        return view('member.category.index', $result);
    }





    /**
     * 查询方法
     */
    public function query()
    {
        return CategoryModel::paginate($this->limit);
    }
}