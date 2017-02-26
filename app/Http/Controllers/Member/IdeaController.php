<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiIdea;
use Illuminate\Http\Request;

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
    }

    public function index($cate=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $prefix_url = DOMAIN.'member/idea';
        $datas = $this->query($pageCurr,$cate);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.idea.index', $result);
    }

//    public function trash($cate_id=0)
//    {
//        $curr['name'] = $this->lists['trash']['name'];
//        $curr['url'] = $this->lists['trash']['url'];
//        $result = [
//            'datas'=> $this->query($del=1,$cate_id),
//            'prefix_url'=> DOMAIN.'member/idea/trash',
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//        ];
//        return view('member.idea.index', $result);
//    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiIdea = ApiIdea::add($data);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
//        //插入搜索表
//        $ideaModel = IdeasModel::where($data)->first();
//        \App\Models\Home\SearchModel::change($ideaModel,3,'create');
//        //将自己加入查看权限表
//        $ideaModel = IdeasModel::where($data)->first();
//        IdeasShowModel::create(['ideaid'=>$ideaModel->id,'uid'=>$this->userid,'created_at'=>date('Y-m-d H:i:s',time())]);
        return redirect(DOMAIN.'member/idea');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiIdea = ApiIdea::show($id);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiIdea['data'],
            'model'=> $this->getModel(),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiIdea = ApiIdea::modify($data);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
//        //更新搜索表
//        $ideaModel = IdeasModel::where('id',$id)->first();
//        \App\Models\Home\SearchModel::change($ideaModel,3,'update');
        return redirect(DOMAIN.'member/idea');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $apiIdea = ApiIdea::show($id);
        if ($apiIdea['code']!=0) {
            echo "<script>alert('".$apiIdea['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiIdea['data'],
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.idea.show', $result);
    }

//    public function destroy($id)
//    {
//        IdeasModel::where('id',$id)->update(['del'=> 1]);
//        return redirect(DOMAIN.'member/idea');
//    }
//
//    public function restore($id)
//    {
//        IdeasModel::where('id',$id)->update(['del'=> 0]);
//        return redirect(DOMAIN.'member/idea/trash');
//    }
//
//    public function forceDelete($id)
//    {
//        IdeasModel::where('id',$id)->delete();
//        return redirect(DOMAIN.'member/idea/trash');
//    }

//    /**
//     * 权限列表
//     */
//    public function ideaShow($id)
//    {
//        $curr['name'] = '用户列表';
//        $curr['url'] = $this->lists['show']['url'];
//        $result = [
////            'users'=> IdeasShowModel::where('ideaid',$id)->get(),
//            'lists'=> $this->lists,
//            'curr'=> $curr,
//        ];
//        return view('member.idea.userList', $result);
//    }





    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        if (!$request->intro) {
            echo "<script>alert('内容简介不能为空！');history.go(-1);</script>";exit;
        }
        if (!$request->detail) {
            echo "<script>alert('内容不能为空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'genre'=> $request->genre,
            'cate'=> $request->cate,
            'intro'=> $request->intro,
            'isdetail'=> $request->isdetail,
            'detail'=> $request->detail,
            'uid'=> $this->userid,
            'money' =>  $request->money,
        ];
        return $data;
    }

    public function query($pageCurr,$cate)
    {
        $apiIdea = ApiIdea::index($this->limit,$pageCurr,$this->userid,$cate,2,0);
        return $apiIdea['code']==0 ? $apiIdea['data'] : [];
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiIdea::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}