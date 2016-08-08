<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\OrderFirmModel;

class OrderFirmController extends BaseController
{
    /**
     * 系统后台 订单管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderFirmModel();
        $this->crumb['']['name'] = '售后修改';
        $this->crumb['category']['name'] = '售后服务';
        $this->crumb['category']['url'] = 'orderfirm';
    }

    public function index($isshow=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$isshow),
            'prefix_url'=> '/admin/orderfirm',
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'del'=> $del,
            'isshow'=> $isshow,
        ];
        return view('admin.orderfirm.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> OrderFirmModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.orderfirm.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'status'=> $request->status,
            'del'=> $request->del,
            'isshow'=> $request->isshow,
            'updated_at'=> time(),
        ];
        OrderFirmModel::where('id',$id)->update($data);
        return redirect('/admin/orderfirm');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> OrderFirmModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.orderfirm.show', $result);
    }






    public function query($del,$isshow)
    {
        if ($del=='') { $del = [0,1]; }
        if ($isshow=='') { $isshow = [0,1]; }
        if (is_array($del)) {
            if (is_array($isshow)) {
                $datas = OrderFirmModel::orderBy('id','desc')->paginate($this->limit);
            } else {
                $datas = OrderFirmModel::where('isshow',$isshow)->orderBy('id','desc')->paginate($this->limit);
            }
        } else {
            if (is_array($isshow)) {
                $datas = OrderFirmModel::where('del',$del)->orderBy('id','desc')->paginate($this->limit);
            } else {
                $datas = OrderFirmModel::where('del',$del)->where('isshow',$isshow)->orderBy('id','desc')->paginate($this->limit);
            }
        }
        return $datas;
    }
}