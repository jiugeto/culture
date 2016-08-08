<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
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
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> '/member/pic',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        PicModel::saveSize();      //确定图片存储
        return view('member.pic.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> '/member/pic/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        PicModel::create($data);
        return redirect('/member/pic');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> PicModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        PicModel::where('id',$id)->update($data);
        return redirect('/member/pic');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> PicModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.show', $result);
    }

    public function destroy($id)
    {
        PicModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/pic');
    }

    public function restore($id)
    {
        PicModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/pic/trash');
    }

    public function forceDelete($id)
    {
        PicModel::where('id',$id)->delete();
        return redirect('/member/pic/trash');
    }



    public function getData(Request $request)
    {
        $data = [
            'uid'=> $this->userid,
            'name'=> $request->name,
            'intro'=> $request->intro,
            'url'=> $request->url,
        ];
        return $data;
    }

    public function query($del)
    {
        return PicModel::where('del',$del)
            ->where('uid',\Session::get('user.uid'))
            ->paginate($this->limit);
    }
}