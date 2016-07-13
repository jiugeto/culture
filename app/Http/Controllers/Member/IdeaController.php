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
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0,$cate_id),
            'prefix_url'=> '/member/idea',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.index', $result);
    }

    public function trash($cate_id=0)
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1,$cate_id),
            'prefix_url'=> '/member/idea/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'categorys'=> $this->model->categorys(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d H:i:s', time());
        IdeasModel::create($data);
//        //将自己加入查看权限表
//        $ideaModel = IdeasModel::where($data)->first();
//        IdeasShowModel::create(['ideaid'=>$ideaModel->id,'uid'=>$this->userid,'created_at'=>date('Y-m-d H:i:s',time())]);
        return redirect('/member/idea');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> IdeasModel::find($id),
            'categorys'=> $this->model->categorys(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = date('Y-m-d H:i:s', time());
        IdeasModel::where('id',$id)->update($data);
        return redirect('/member/idea');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> IdeasModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.show', $result);
    }

    public function destroy($id)
    {
        IdeasModel::where('id',$id)->update(['del'=> 1]);
        return redirect('/member/idea');
    }

    public function restore($id)
    {
        IdeasModel::where('id',$id)->update(['del'=> 0]);
        return redirect('/member/idea/trash');
    }

    public function forceDelete($id)
    {
        IdeasModel::where('id',$id)->delete();
        return redirect('/member/idea/trash');
    }

    /**
     * 权限列表
     */
    public function ideaShow($id)
    {
        $curr['name'] = '用户列表';
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'users'=> IdeasShowModel::where('ideaid',$id)->get(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.userList', $result);
    }

//    /**
//     * 设置创意权限
//     */
//    public function setIdeaShow($id)
//    {
//    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->intro2) {
            echo "<script>alert('内容简介不能为空！');history.go(-1);</script>";exit;
        }
        if (!$request->intro) {
            echo "<script>alert('内容不能为空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'cate_id'=> $request->cate_id,
            'intro'=> $request->intro2,
            'iscon'=> $request->iscon,
            'content'=> $request->intro,
            'uid'=> \Session::get('user.uid'),
        ];
        return $data;
    }

    public function query($del,$cate_id)
    {
        if ($cate_id) {
            $datas = IdeasModel::where('del',$del)
                ->where('cate_id',$cate_id)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = IdeasModel::where('del',$del)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        return $datas;
    }
}