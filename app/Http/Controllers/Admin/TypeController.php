<?php
namespace App\Http\Controllers\Admin;

use App\Models\TypeModel;
use Illuminate\Http\Request;

class TypeController extends BaseController
{
    /**
     * 类型管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = TypeModel::where('del',0)->orderBy('id','desc')->get();
        $this->crumb['']['name'] = '类型列表';
        $this->crumb['category']['name'] = '类型管理';
        $this->crumb['category']['url'] = 'type';
    }

    public function index($table_id=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($table_id),
            'prefix_url'=> DOMAIN.'admin/type',
            'table_id'=> $table_id,
            'tableIds'=> $this->getTableIds(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'table_name'=> $tablename,
            'field'=> $field,
            'crumb'=> $this->crumb,
        ];
        return view('admin.type.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        TypeModel::create($data);
        return redirect(DOMAIN.'admin/type');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> TypeModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.type.edit', $result);
    }

    public function update(Request $request, $id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        TypeModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/type');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> TypeModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
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