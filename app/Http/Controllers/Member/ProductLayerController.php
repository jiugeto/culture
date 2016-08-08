<?php
namespace App\Http\Controllers\Member;

use App\Models\ProductLayerModel;
use Illuminate\Http\Request;

class ProductLayerController extends BaseController
{
    /**
     * 会员后台 产品动画
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '产品动画';
        $this->lists['func']['url'] = 'productlayer';
        $this->lists['create']['name'] = '添加动画';
        $this->model = new ProductLayerModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productlayer',
            'curr'=> $curr,
        ];
        return view('member.productlayer.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'lists'=> $this->lists,
            'prefix_url'=> '/member/productlayer/trash',
            'curr'=> $curr,
        ];
        return view('member.productlayer.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productlayer.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        ProductLayerModel::create($data);
        return redirect('/member/produvtlayer');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> $this->getOne($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.productlayer.edit', $result);
    }

    public function update(Request $request,$id){}





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = [
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return ProductLayerModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }

    public function getOne($id)
    {
        $data = ProductLayerModel::find($id);
        $fields = $data->field?explode('|',$data->field):[];
        if($fields) { unset($fields[count($fields)-1]); }
        $data->fields = $fields;
        $pers = $data->per?explode('|',$data->per):[];
        if($pers) { unset($pers[count($pers)-1]); }
        $data->pers = $pers;
        $data->per_num = count($pers);
        $values = $data->value?explode(',',$data->value):[];
        if($values) { unset($values[count($values)-1]); }
//        $data->values = $values;
        if ($values) {
            foreach ($values as $key=>$value) {
                if ($value) {
                    $value = explode('|',$value);
                    unset($value[count($value)-1]);
                    $vals[$key] = $value;
                }
            }
            $data->vals = isset($vals)?$vals:[];
        }
        return $data;
    }
}