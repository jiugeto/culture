<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\Base\OrderFirmModel;

class OrderFirmController extends BaseController
{
    /**
     * 售后服务的样片修改
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new OrderFirmModel();
        //面包屑处理
        $this->lists['func']['name'] = '售后修改';
        $this->lists['func']['url'] = 'orderfirm';
//        $this->lists['create']['name'] = '添加类型';
//        $this->lists['edit']['name'] = '修改分类';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'] = '售后列表';
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'member/orderfirm',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.orderfirm.index', $result);
    }




    public function query()
    {
        $datas = OrderFirmModel::where('del',0)
            ->where('isshow',1)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}