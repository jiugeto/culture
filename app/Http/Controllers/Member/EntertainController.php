<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\EntertainModel;

class EntertainController extends BaseController
{
    /**
     * 系统后台租赁管理
     */

    protected $genre;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '娱乐管理';
        $this->lists['func']['url'] = 'entertain';
        $this->lists['create']['name'] = '娱乐发布';
        $this->model = new EntertainModel();
        if (!in_array($this->userType,[6])) {
            //普通企业、广告公司、租赁公司、超级用户
            $this->genre = 2;       //需求
        } elseif (in_array($this->userType,[6,50])) {
            //影视公司、超级用户
            $this->genre = 1;       //供应
        }
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$this->genre),
            'prefix_url'=> DOMAIN.'member/entertain',
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
            'prefix_url'=> DOMAIN.'member/entertain',
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
        return redirect(DOMAIN.'member/entertain');
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
        return redirect(DOMAIN.'member/entertain');
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
        return redirect(DOMAIN.'member/entertain');
    }

    public function restore($id)
    {
        EntertainModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/entertain/trash');
    }

    public function forceDelete($id)
    {
        EntertainModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/entertain/trash');
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
            'genre'=> $this->genre,
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
            $datas =  EntertainModel::where('del',$del)
                ->where('genre',$genre)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas =  EntertainModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}