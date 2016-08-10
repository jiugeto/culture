<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\EntertainModel;

class EntertainSController extends EntertainController
{
    /**
     * 系统后台租赁管理
     */

    protected $genre = 1;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '娱乐供应';
        $this->lists['func']['url'] = 'entertainS';
        $this->lists['create']['name'] = '娱乐发布';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->genre),
            'prefix_url'=> '/admin/entertainS',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.entertain.index', $result);
    }

    public function trash($genre=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$this->genre),
            'prefix_url'=> '/admin/entertainS',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'genre'=> $genre,
        ];
        return view('member.entertain.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.entertain.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['genre'] = $this->genre;
        $data['created_at'] = time();
        EntertainModel::create($data);
        return redirect('/member/entertainS');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> EntertainModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.entertain.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        EntertainModel::where('id',$id)->update($data);
        return redirect('/member/entertainS');
    }

}