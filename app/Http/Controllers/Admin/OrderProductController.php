<?php
namespace App\Http\Controllers\Admin;

use App\Models\OrderProductModel;
use Illuminate\Http\Request;

class OrderProductController extends BaseController
{
    /**
     * 系统后台 创作订单
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderProductModel();
        $this->crumb['']['name'] = '创作订单列表';
        $this->crumb['category']['name'] = '创作订单';
        $this->crumb['category']['url'] = 'orderpro';
    }

    public function index($isshow=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$isshow),
            'prefix_url'=> '/admin/orderpro',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'del'=> $del,
            'isshow'=> $isshow,
        ];
        return view('admin.orderpro.index', $result);
    }






    public function query($del,$isshow)
    {
        if ($del=='') { $del = [0,1]; }
        if ($isshow=='') { $isshow = [0,1]; }
        if (is_array($del)) {
            if (is_array($isshow)) {
                $datas = OrderProductModel::orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = OrderProductModel::where('isshow',$isshow)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        } else {
            if (is_array($isshow)) {
                $datas = OrderProductModel::where('del',$del)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            } else {
                $datas = OrderProductModel::where('del',$del)
                    ->where('isshow',$isshow)
                    ->orderBy('id','desc')
                    ->paginate($this->limit);
            }
        }
        return $datas;
    }
}