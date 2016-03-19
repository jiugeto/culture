<?php
namespace App\Http\Controllers\Member;

use App\Models\GoodsModel;

class CompanyDController extends BaseGoodsController
{
    /**
     * 企业需求
     * goods 商品、货物，代表文化类产品
     */

    //产品主体：1个人需求，2设计师供应，3企业需求，4企业供应
    protected $type = 3;

    public function __construct()
    {
        $this->list['func']['name'] = '企业需求';
        $this->list['func']['url'] = 'companyD';
        $this->list['create']['name'] = '发布需求';
        $this->model = new GoodsModel();
    }

    public function index($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$this->type,$cate_id),
            'prefix_url'=> '/member/companyD',
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.companySD.index', $result);
    }
}