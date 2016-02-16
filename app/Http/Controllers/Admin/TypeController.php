<?php
namespace App\Http\Controllers\Admin;

use App\Models\TypeModel;
use Illuminate\Http\Request;

class TypeController extends BaseController
{
    /**
     * 类型管理
     */

    /**
     * 面包屑导航
     */
    protected $crumb = [
        'main'=> [
            'name'=> '系统后台',
            'url'=> '',
        ],
        'category'=> [
            'name'=> '类型管理',
            'url'=> 'type',
        ],
    ];

    public function __construct()
    {
        $this->model = new TypeModel();
    }

    public function index()
    {
        $actions = $this->actions();
        $datas = TypeModel::paginate($this->limit);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '类型列表';
        $crumb['function']['url'] = '';
        $prefix_url = '/admin/type';
        return view('admin.type.index', compact(
            'actions','datas','crumb','prefix_url'
        ));
    }

    public function create($table_name='')
    {
        $actions = $this->actions();
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'type/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'table_name'=> $table_name,
        ];
        return view('admin.type.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        TypeModel::create($data);
        return redirect('/admin/type');
    }

    public function edit($id)
    {
        $actions = $this->actions();
        $data = TypeModel::find($id);
        $crumb = $this->crumb;
        $crumb['function']['name'] = '编辑';
        $crumb['function']['url'] = 'type/edit';
        return view('admin.type.edit', compact(
            'actions','data','crumb'
        ));
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        TypeModel::where('id',$id)->update($data);
        return redirect('/admin/type');
    }





    /**
     * ==========================
     * 以下是公用方法
     * ==========================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        $type = [
            'name'=> $data['name'],
            'intro'=> $data['intro'],
        ];
        return $type;
    }
}