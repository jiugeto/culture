<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiStoryBoard;
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
        $pageCurr = isset($_GET['pageCurr']) ? $_GET['pageCurr'] : 1;
        $prefix_url = DOMAIN.'member/storyboard';
        $datas = $this->query($pageCurr,0);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.storyboard.index', $result);
    }

//    public function trash()
//    {
//        $curr['name'] = $this->lists['trash']['name'];
//        $curr['url'] = $this->lists['trash']['url'];
//        $result = [
//            'datas'=> $this->query($del=1),
//            'prefix_url'=> DOMAIN.'member/storyboard/trash',
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//        ];
//        return view('member.storyboard.index', $result);
//    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.storyboard.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiSB = ApiStoryBoard::add($data);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
//        //插入搜索表
//        $storyBoardModel = StoryBoardModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($storyBoardModel,4,'create');
        return redirect(DOMAIN.'member/storyboard');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiSB = ApiStoryBoard::show($id);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiSB['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.storyboard.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiSB = ApiStoryBoard::modify($data);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
//        //更新搜索表
//        $storyBoardModel = StoryBoardModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($storyBoardModel,4,'update');
        return redirect(DOMAIN.'member/storyboard');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiSB = ApiStoryBoard::show($id);
        if ($apiSB['code']!=0) {
            echo "<script>alert('".$apiSB['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data' => $apiSB['data'],
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.storyboard.show', $result);
    }

//    public function destroy($id)
//    {
//        StoryBoardModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'member/storyboard');
//    }
//
//    public function restore($id)
//    {
//        StoryBoardModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'member/storyboard/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        StoryBoardModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'member/storyboard/trash');
//    }

    public function getData(Request $request)
    {
        if (!$request->genre) {
            echo "<script>alert('供求必选！');history.go(-1);</script>";exit;
        }
        if (!$request->intro) {
            echo "<script>alert('内容不能空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'  =>  $request->name,
            'genre'  =>  $request->genre,
            'cate'  =>  $request->cate,
            'intro' =>  $request->intro,
            'detail'=>  $request->detail,
            'money' =>  $request->money,
            'uid'   =>  $this->userid,
            'uname' =>  \Session::get('user.username'),
        ];
        return $data;
    }

    public function query($pageCurr,$del)
    {
        $uid = $this->userType==50 ? 0 : $this->userid;
        $apiSB = ApiStoryBoard::index($this->limit,$pageCurr,$uid,2,$del);
        return $apiSB['code']==0 ? $apiSB['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiStoryBoard::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}