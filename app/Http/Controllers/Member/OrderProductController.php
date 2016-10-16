<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Online\OrderProductModel;

class OrderProductController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderProductModel();
        //面包屑处理
        $this->lists['func']['name'] = '创作订单';
        $this->lists['func']['url'] = 'orderpro';
//        $this->lists['create']['name'] = '添加类型';
//        $this->lists['edit']['name'] = '修改分类';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'] = '创作订单';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'member/orderpro',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.orderpro.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> OrderProductModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.orderpro.show', $result);
    }

    public function destroy($id)
    {
        OrderProductModel::where('id',$id)->update(['isshow'=> 1]);
        return redirect(DOMAIN.'member/orderpro');
    }






    public function query()
    {
        $datas = OrderProductModel::where('isshow',2)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}