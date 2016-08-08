<?php

namespace App\Http\Controllers\Admin;

//use Illuminate\Http\Request;
use App\Http\Requests\Request;
use App\Models\RentModel;

class RentController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '租赁列表';
        $this->crumb['category']['name'] = '租赁管理';
        $this->crumb['category']['url'] = 'rent';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/admin/rent',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.rent.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.rent.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        RentModel::create($data);
        return redirect('/admin/rent');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> RentModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.rent.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        RentModel::where('id',$id)->update($data);
        return redirect('/admin/rent');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> RentModel::find($id),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.rent.show', $result);
    }





    /**
     * ===================
     * 以下是公用方法
     * ===================
     */

    /**
     * 收集数据
     */
    public function getData($request)
    {
        $data = [
            'name'=> $request->name,
            'genre'=> $request->genre,
            'type_id'=> $request->type_id,
            'intro'=> $request->intro,
            'price'=> $request->price,
            'sort'=> $request->sort,
        ];
        return $data;
    }

    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return RentModel::where('del',$del)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}