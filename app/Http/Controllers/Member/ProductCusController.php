<?php
namespace App\Http\Controllers\Member;

use App\Models\GoodsCusModel;
use App\Models\GoodsCusUserModel;

class ProductCusController extends BaseController
{
    /**
     * 会员后台片源定制
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '片源定制';
        $this->lists['func']['url'] = 'proCus';
        $this->lists['create']['name'] = '添加片源';
        $this->model = new GoodsCusModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query(),
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'member/proCus',
            'curr'=> $curr,
        ];
        return view('member.proCus.index', $result);
    }

    public function cusList($id)
    {
        $curr['name'] = '供应列表';
        $curr['url'] = $this->lists['']['url'].'/'.$id.'/cus';
        $datas = GoodsCusUserModel::where('cus_id',$id)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        $result = [
            'datas'=> $datas,
            'lists'=> $this->lists,
            'prefix_url'=> DOMAIN.'member/proCus/'.$id.'/cus',
            'curr'=> $curr,
        ];
        return view('member.proCus.cusList', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> GoodsCusModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.proCus.show', $result);
    }





    public function query()
    {
        $datas = GoodsCusModel::where('uid',$this->userid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}