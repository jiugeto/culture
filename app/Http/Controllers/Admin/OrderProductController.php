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

    public function index($isshow=0,$status=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($isshow,$status),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'admin/orderpro',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isshow'=> $isshow,
            'status'=> $status,
        ];
        return view('admin.orderpro.index', $result);
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        if (!$isshow) { echo "<script>alert('参数有误！');history.go(-1);</script>";exit; }
        OrderProductModel::where('id',$id)->update(['isshow'=> $isshow]);
        return redirect(DOMAIN.'admin/orderpro');
    }

    /**
     * 设置状态
     */
    public function setStatus($id,$status)
    {
        if (!$status) { echo "<script>alert('参数有误！');history.go(-1);</script>";exit; }
        OrderProductModel::where('id',$id)->update(['status'=> $status]);
        return redirect(DOMAIN.'admin/orderpro');
    }

    /**
     * 编辑视频
     */
    public function edit($id)
    {
//        $curr['name'] = $this->crumb['edit']['name'];
        $curr['name'] = '视频处理';
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> OrderProductModel::find($id),
            'pics'=> $this->model->pics(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.orderpro.edit', $result);
    }






    public function query($isshow,$status)
    {
        if ($isshow && $status) {
            $datas = OrderProductModel::where('isshow',$isshow)
                ->where('status',$status)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif (!$isshow && $status) {
            $datas = OrderProductModel::where('status',$status)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($isshow && !$status) {
            $datas = OrderProductModel::where('isshow',$isshow)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif (!$isshow && !$status) {
            $datas = OrderProductModel::orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}