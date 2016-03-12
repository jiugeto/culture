<?php
namespace App\Http\Controllers\Member;

use App\Models\GoodsModel;

class PersonDemandController extends BaseController
{
    /**
     * 个人会员需求管理
     */

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'menus'=> $this->list,
            'prefix_url'=> '/member/persondemand',
        ];
        return view('member.persondemand.index', $result);
    }


    /**
     * 查询方法
     */
    public function query($del=0)
    {
        return GoodsModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
    }
}