<?php
namespace App\Http\Controllers\Member;

use App\Models\GoodsModel;

class CompanySController extends BaseGoodsController
{
    /**
     * 企业供应管理
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 4;

    public function __construct()
    {
        $this->list['func']['name'] = '企业产品';
        $this->list['func']['url'] = 'companyS';
        $this->list['create']['name'] = '发布产品';
        $this->model = new GoodsModel();
    }

    public function index($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$this->type,$cate_id),
            'prefix_url'=> '/member/companyS',
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.companySD.index', $result);
    }
}