<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiArea;
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
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/area';
        $apiArea = ApiArea::index($this->limit,$pageCurr);
        if ($apiArea['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiArea['data']; $total = $apiArea['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
//        dd($pagelist);
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

//    public function update(Request $request,$id){}
}