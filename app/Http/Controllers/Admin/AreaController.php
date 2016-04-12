<?php
namespace App\Http\Controllers\Admin;

use App\Models\AreaModel;
//use Illuminate\Http\Request;

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
            'prefix_url'=> '/admin/area',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.area.index', $result);
    }





    /**
     * 查询方法
     */
    public function query()
    {
        return AreaModel::paginate($this->limit);
    }
}