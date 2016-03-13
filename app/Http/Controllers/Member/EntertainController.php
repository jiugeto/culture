<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\EntertainModel;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    public function __construct()
    {
        $this->list['func']['name'] = '娱乐供求';
        $this->list['func']['url'] = 'entertain';
        $this->list['create']['name'] = '发布需求';
    }

    public function index($genre=0)
    {
        $result = [
//            'actions'=> $this->actions(),
            'datas'=> $this->query($del=0,$genre),
            'prefix_url'=> '/admin/entertain',
            'menus'=> $this->list,
            'curr'=> '',
            'genre'=> $genre,
        ];
        return view('member.entertain.index', $result);
    }

    public function trash()
    {
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/admin/entertain',
            'menus'=> $this->list,
            'curr'=> 'trash',
            'genre'=> $genre,
        ];
        return view('member.entertain.index', $result);
    }

    public function create()
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'create',
        ];
        return view('member.entertain.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        EntertainModel::create($data);
        return view('/member/entertain');
    }

    public function edit($id)
    {
        $result = [
            'data'=> EntertainModel::find($id),
            'menus'=> $this->list,
            'curr'=> 'edit',
        ];
        return view('member.entertain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d', time());
        EntertainModel::where('id',$id)->update($data);
        return redirect('/member/entertain');
    }

    public function show($id)
    {
        $result = [
            'data'=> EntertainModel::find($id),
            'menus'=> $this->list,
            'curr'=> 'show',
        ];
        return view('member.entertain.show', $result);
    }





    /**
     * ===================
     * 以下是公用方法
     * ===================
     */

    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $data = $request->all();
        //uname 转为 uid
        $data['uid'] = 0;       //测试，暂为0
        $entertain = [
            'title'=> $data['title'],
            'content'=> $data['content'],
            'uid'=> $data['uid'],
        ];
        return $entertain;
    }

    /**
     * 查询方法
     */
    public function query($del=0,$genre)
    {
        if ($genre) {
            $entertains =  EntertainModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $entertains =  EntertainModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $entertains;
    }
}