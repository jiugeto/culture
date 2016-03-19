<?php
namespace App\Http\Controllers\Member;

use App\Models\RentModel;

class RentDController extends BaseController
{
    /**
     * 会员后台租赁需求管理
     * rent 器材租赁
     */

    public function __construct()
    {
        $this->list['func']['name'] = '租赁供求';
        $this->list['func']['url'] = 'rentD';
        $this->list['create']['name'] = '租赁需求';
        $this->model = new RentModel();
    }

    public function index()
    {
        $result = [
            'menus'=> $this->list,
        ];
        return view('member.rent.index', $result);
    }
}