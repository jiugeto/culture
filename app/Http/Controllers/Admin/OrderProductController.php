<?php
namespace App\Http\Controllers\Admin;

use App\Models\Online\OrderProductModel;
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
            'datas'=> $this->query($isshow),
            'prefix_url'=> DOMAIN.'admin/orderpro',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isshow'=> $isshow,
        ];
        return view('admin.orderpro.index', $result);
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        OrderProductModel::where('id',$id)->update(['isshow'=> $isshow]);
        return redirect(DOMAIN.'admin/orderpro');
    }






    public function query($isshow)
    {
        if ($isshow=='') { $isshow = [0,1]; }
        if (is_array($isshow)) {
            $datas = OrderProductModel::orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = OrderProductModel::where('isshow',$isshow)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}