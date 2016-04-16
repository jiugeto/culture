<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\IdeasModel;

class IdeaController extends BaseController
{
    /**
     * 会员后台创意管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '创意管理';
        $this->lists['func']['url'] = 'idea';
        $this->lists['create']['name'] = '新的创意';
        $this->model = new IdeasModel();
    }

    public function index($cate_id=0)
    {
        $result = [
            'datas'=> $this->query($del=0,$cate_id),
            'prefix_url'=> '/member/idea',
            'lists'=> $this->lists,
            'menus'=> $this->menus,
            'curr_list'=> '',
        ];
        return view('member.idea.index', $result);
    }

    public function create()
    {
        $result = [
            'categorys'=> $this->model->categorys(),
            'lists'=> $this->lists,
            'curr_list'=> 'create',
            'menus'=> $this->menus,
        ];
        return view('member.idea.create', $result);
    }

    public function store(Request $request)
    {
        return redirect('/member/idea');
    }





    public function query($del,$cate_id)
    {
        return IdeasModel::where('del',$del)
            ->where('cate_id',$cate_id)
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}