<?php
namespace App\Http\Controllers\Admin;

use App\Models\AreaModel;
use Illuminate\Http\Request;

class AreaController extends BaseController
{
    /**
     * 地区管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '地区列表';
        $this->crumb['category']['name'] = '地区管理';
        $this->crumb['category']['url'] = 'area';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'admin/area',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.area.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> AreaModel::find($id),
            'parents'=> AreaModel::all(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.area.edit', $result);
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
    public function query()
    {
        $datas = AreaModel::paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}