<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OrderModel;

class OrderController extends BaseController
{
    /**
     * 系统后台 订单管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderModel();
        $this->crumb['']['name'] = '订单列表';
        $this->crumb['category']['name'] = '订单管理';
        $this->crumb['category']['url'] = 'order';
    }

    public function index($isshow=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$isshow),
            'prefix_url'=> DOMAIN.'admin/order',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'del'=> $del,
            'isshow'=> $isshow,
        ];
        return view('admin.order.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> OrderModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.order.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'status'=> $request->status,
            'del'=> $request->del,
            'isshow'=> $request->isshow,
            'updated_at'=> time(),
        ];
        OrderModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/order');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> OrderModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.order.show', $result);
    }






    public function query($del,$isshow)
    {
        if ($del=='') { $del = [0,1]; }
        if ($isshow=='') { $isshow = [0,1]; }
        if (is_array($del)) {
            if (is_array($isshow)) {
                $datas = OrderModel::orderBy('id','desc')->paginate($this->limit);
            } else {
                $datas = OrderModel::where('isshow',$isshow)->orderBy('id','desc')->paginate($this->limit);
            }
        } else {
            if (is_array($isshow)) {
                $datas = OrderModel::where('del',$del)->orderBy('id','desc')->paginate($this->limit);
            } else {
                $datas = OrderModel::where('del',$del)->where('isshow',$isshow)->orderBy('id','desc')->paginate($this->limit);
            }
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}