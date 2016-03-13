<?php
namespace App\Http\Controllers\Member;

//use App\Models\GoodsModel;

class PersonDemandController extends BaseGoodsController
{
    /**
     * 个人会员需求管理
     * goods 商品、货物，代表文化类产品
     */

    public function index($type=0,$cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$type,$cate_id),
            'menus'=> $this->list,
            'prefix_url'=> '/member/persondemand',
        ];
        return view('member.persondemand.index', $result);
    }

    public function trash($type=0,$cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=1,$type,$cate_id),
            'menus'=> $this->list,
            'prefix_url'=> '/member/persondemand',
        ];
        return view('member.persondemand.index', $result);
    }

    public function create()
    {
        return view('member.persondemand.create');
    }
}