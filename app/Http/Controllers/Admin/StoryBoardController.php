<?php

namespace App\Http\Controllers\Admin;

use App\Models\StoryBoardModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class StoryBoardController extends BaseController
{
    /**
     * 系统后台演员管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->model = new StoryBoardModel();
        $this->crumb['']['name'] = '人员列表';
        $this->crumb['category']['name'] = '人员管理';
        $this->crumb['category']['url'] = 'storyboard';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'admin/storyboard',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->crumb['trash']['name'];
        $curr['url'] = $this->crumb['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> DOMAIN.'admin/storyboard/trash',
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        StoryBoardModel::create($data);
        return redirect(DOMAIN.'admin/storyboard');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $result = [
            'data'=> StoryBoardModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        StoryBoardModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'admin/storyboard');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $result = [
            'data'=> StoryBoardModel::find($id),
            'model'=> $this->model,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.storyboard.show', $result);
    }

    public function destroy($id)
    {
        StoryBoardModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'admin/storyboard');
    }

    public function restore($id)
    {
        StoryBoardModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'admin/storyboard/trash');
    }

    public function forceDelete($id)
    {
        StoryBoardModel::where('id',$id)->delete();
        return redirect(DOMAIN.'admin/storyboard/trash');
    }




    public function query($del=0)
    {
        $datas = StoryBoardModel::where('del',$del)
            ->where('isshow',1)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }

    public function getData(Request $request)
    {
        if (!$request->name) {
            echo "<script>alert('分镜名称必填！');history.go(-1);</script>";exit;
        }
        if (!$request->genre || !$request->cate || !$request->thumb) {
            echo "<script>alert('供求类别、分镜类型、缩略图必选！');history.go(-1);</script>";exit;
        }
        if (!$request->intro || !$request->detail || !$request->money) {
            echo "<script>alert('分镜简介、详情必填！');history.go(-1);</script>";exit;
        }
        if ($uname=$request->name) {
            if (strlen($uname)<2) { echo "<script>alert('用户名称不少于2个字符！');history.go(-1);</script>";exit; }
            $userModel = UserModel::where('username',$uname)->first();
            $userName = $userModel ? $userModel->username : '';
        }
        return array(
            'name'=> $request->name,
            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'thumb'=> $request->thumb,
            'intro'=> $request->intro,
            'detail'=> $request->detail,
            'money'=> $request->money,
            'uname'=> isset($userName) ? $userName : '',
            'sort'=> $request->sort,
            'isnew'=> $request->isnew,
            'ishot'=> $request->ishot,
            'isshow'=> $request->isshow,
        );
    }
}