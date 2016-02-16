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
//        $this->model = new TypeModel();
        $this->model = TypeModel::where('del',0)->orderBy('id','desc')->get();
    }

    public function index($table_id=0)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '类型列表';
        $crumb['function']['url'] = '';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'datas'=> $this->query($table_id),
            'prefix_url'=> '/admin/type',
            'table_id'=> $table_id,
            'tableIds'=> $this->getTableIds(),
        ];
        return view('admin.type.index', $result);
    }

    public function create($table_name='')
    {
        $tablename = ''; $field = '';
        if ($table_name) {
            $tableIds = explode('-',$table_name);
            $tablename = $tableIds[0];
            $field = $tableIds[1];
        }
        $crumb = $this->crumb;
        $crumb['function']['name'] = '添加';
        $crumb['function']['url'] = 'type/create';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'table_name'=> $tablename,
            'field'=> $field,
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
        $crumb = $this->crumb;
        $crumb['function']['name'] = '编辑';
        $crumb['function']['url'] = 'type/edit';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> TypeModel::find($id),
        ];
        return view('admin.type.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        TypeModel::where('id',$id)->update($data);
        return redirect('/admin/type');
    }

    public function show($id)
    {
        $crumb = $this->crumb;
        $crumb['function']['name'] = '类型详情';
        $crumb['function']['url'] = 'type/show';
        $result = [
            'actions'=> $this->actions(),
            'crumb'=> $crumb,
            'data'=> TypeModel::find($id),
        ];
        return view('admin.type.show', $result);
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
        $models = [];
        foreach ($this->model as $v) {
            if ($v->table_name==$data['table_name']) {
                $models[] = $v;
                $data['table_id'] = $v->table_id;
            }
        }
        if (empty($models) && !empty($this->model)) {
             $maxTableId = TypeModel::where('del',0)
                ->orderBy('table_id','desc')
                ->first()->table_id;
            $data['table_id'] = $maxTableId + 1;
        }
        $type = [
            'name'=> $data['name'],
            'table_id'=> $data['table_id'],
            'table_name'=> $data['table_name'],
            'field'=> $data['field'],
            'intro'=> $data['intro'],
        ];
        return $type;
    }

    /**
     * 查询方法
     */
    public function query($table_id)
    {
        if ($table_id==0) {
            $datas = TypeModel::where('del', 0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = TypeModel::where([
                'del'=> 0,
                'table_id'=> $table_id,
            ])
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }

    /**
     * 收集table_id
     */
    public function getTableIds()
    {
        $tableIds = [];
        foreach ($this->model as $model) {
            $tableIds[$model->table_id] = $model->table_name;
        }
        array_unique($tableIds);
        return $tableIds;
    }
}