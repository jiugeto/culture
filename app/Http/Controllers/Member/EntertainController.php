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
        parent::__construct();
        $this->lists['func']['name'] = '娱乐供求';
        $this->lists['func']['url'] = 'entertain';
        $this->lists['create']['name'] = '娱乐发布';
    }

    public function index($genre=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$genre),
            'prefix_url'=> '/admin/entertain',
            'lists'=> $this->lists,
            'curr'=> $curr,
            'genre'=> $genre,
        ];
        return view('member.entertain.index', $result);
    }

    public function trash($genre=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$genre),
            'prefix_url'=> '/admin/entertain',
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
        $data['created_at'] = time();
        EntertainModel::create($data);
        return redirect('/member/entertain');
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
        return redirect('/member/entertain');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> EntertainModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.entertain.show', $result);
    }

    public function destroy($id)
    {
        EntertainModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/entertain');
    }

    public function restore($id)
    {
        EntertainModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/entertain/trash');
    }

    public function forceDelete($id)
    {
        EntertainModel::where('id',$id)->delete();
        return redirect('/member/entertain/trash');
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
            'genre'=> $data['genre'],
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