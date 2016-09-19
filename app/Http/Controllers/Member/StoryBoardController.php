<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\StoryBoardModel;

class StoryBoardController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new StoryBoardModel();
        //面包屑处理
        $this->lists['func']['name'] = '分镜管理';
        $this->lists['func']['url'] = 'storyboard';
        $this->lists['create']['name'] = '添加分镜';
        $this->lists['edit']['name'] = '修改分镜';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'member/storyboard',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.storyboard.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> DOMAIN.'member/storyboard/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.storyboard.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'member/storyboard',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.storyboard.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        StoryBoardModel::create($data);

        //插入搜索表
        $storyBoardModel = StoryBoardModel::where($data)->first();
        \App\Models\Home\SearchModel::change($storyBoardModel,4,'create');

        return redirect(DOMAIN.'member/storyboard');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> StoryBoardModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.storyboard.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        StoryBoardModel::where('id',$id)->update($data);

        //更新搜索表
        $storyBoardModel = StoryBoardModel::where('id',$id)->first();
        \App\Models\Home\SearchModel::change($storyBoardModel,4,'update');

        return redirect(DOMAIN.'member/storyboard');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> StoryBoardModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.storyboard.show', $result);
    }

    public function destroy($id)
    {
        StoryBoardModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/storyboard');
    }

    public function restore($id)
    {
        StoryBoardModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/storyboard/trash');
    }

    public function forceDelete($id)
    {
        StoryBoardModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/storyboard/trash');
    }

    public function getData(Request $request)
    {
        $uid = $this->userid ? $this->userid : 0;
        if (!$request->intro) { echo "<script>alert('内容不能空！');history.go(-1);</script>";exit; }
        $data = [
            'name'=> $request->name,
            'cate_id'=> $request->cate,
            'intro'=> $request->intro,
            'money'=> $request->money,
            'uid'=> $uid,
            'sort2'=> $request->sort2,
            'isshow2'=> $request->isshow2,
        ];
        return $data;
    }

    public function query($del)
    {
        $datas = StoryBoardModel::where('del',$del)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}