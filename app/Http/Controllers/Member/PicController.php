<?php
namespace App\Http\Controllers\Member;

//use Illuminate\Http\Request;
use App\Models\PicModel;

class PicController extends BaseController
{
    /**
     * 会员后台图片管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '我的图片';
        $this->lists['func']['url'] = 'pic';
        $this->lists['create']['name'] = '添加图片';
        $this->model = new PicModel();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/member/pic',
            'lists'=> $this->lists,
            'curr_list'=> '',
        ];
        return view('member.pic.index', $result);
    }

    public function trash()
    {
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/member/pic/trash',
            'lists'=> $this->lists,
            'curr_list'=> 'trash',
        ];
        return view('member.pic.index', $result);
    }

    public function create()
    {
        $result = [
            'categorys'=> $this->model->categorys(),
            'lists'=> $this->lists,
            'curr_list'=> 'create',
        ];
        return view('member.pic.create', $result);
    }




    public function query($del)
    {
        return PicModel::where('del',$del)->where('uid',\Session::get('user.uid'))->paginate($this->limit);
    }
}