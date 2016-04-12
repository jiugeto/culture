<?php
namespace App\Http\Controllers\Admin;

use App\Models\GoodsModel;

class GoodsController extends BaseController
{
    /**
     * 系统后台作品（制作公司和设计师的）管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new GoodsModel();
        $this->crumb['']['name'] = '作品列表';
        $this->crumb['category']['name'] = '用户作品';
        $this->crumb['category']['url'] = 'goods';
    }

    public function index($type=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($type),
            'prefix_url'=> '/admin/goods',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'types'=> $this->model['types'],
            'type'=> $type,
        ];
        return view('admin.goods.index', $result);
    }





    /**
     * 查询方法
     */
    public function query($type=0)
    {
        if ($type) {
            $datas = GoodsModel::where('del',0)
                ->where('type',$type)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = GoodsModel::where('del',0)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}