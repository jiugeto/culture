<?php
namespace App\Http\Controllers\Member;

use App\Models\RentModel;

class RentController extends BaseController
{
    /**
     * 会员后台租赁供求管理
     * rent 器材租赁
     */

    public function __construct()
    {
        $this->list['func']['name'] = '租赁供求';
        $this->list['func']['url'] = 'rent';
        $this->list['create']['name'] = '租赁需求';
        $this->model = new RentModel();
    }

    public function index($genre=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$genre),
            'genre'=> $genre,
            'menus'=> $this->list,
            'curr'=> '',
        ];
        return view('member.rent.index', $result);
    }

    public function trash($genre=0)
    {
        $result = [
            'datas'=> $this->query($del=1,$genre),
            'genre'=> $genre,
            'menus'=> $this->list,
            'curr'=> 'trash',
        ];
        return view('member.rent.index', $result);
    }

    public function create()
    {
        $result = [
        ];
        return view('member.rent.create', $result);
    }





    /**
     * 查询方法
     */
    public function query($del=0,$genre=0)
    {
        if ($genre) {
            $rents = RentModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $rents = RentModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $rents;
    }
}