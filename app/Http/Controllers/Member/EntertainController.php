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
        $this->model = new EntertainModel();
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