<?php
namespace App\Http\Controllers\Home;

use App\Models\CategoryModel;
use App\Models\IdeasClickModel;
use App\Models\IdeasCollectModel;
use App\Models\IdeasModel;
use App\Models\IdeasReadModel;
use App\Models\IdeasShowModel;
use App\Tools;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 前台创意管理
     */

    public function islogin()
    {
        if (!\Session::has('user.uid')) { echo "<script>alert('您还没有登录，请先登录！');window.location.href='/login';</script>";exit; }
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'cates'=> Tools::getChild(CategoryModel::all()),
        ];
        return view('home.idea.index', $result);
    }

    public function show($id)
    {
        $this->read($id);
        return view('home.idea.show',array('data'=>IdeasModel::find($id)));
    }

//    public function read($id)
//    {
//        IdeasModel::where('id',$id)->increment('read');
//    }

    /**
     * 浏览控制
     */
    public function read($id)
    {
        $ideaModel = IdeasModel::find($id);
        //查看权限控制
        if ($ideaModel->uid!=$this->userid && !IdeasShowModel::where(['ideaid'=>$ideaModel->id,''])) {}
        //查看次数递增
        if ($ideaModel->uid!=$this->userid) {
            $data = array(
                'ideaid'=> $id,
                'uid'=> $this->userid,
            );
            IdeasReadModel::create($data);
        }
    }

    /**
     * 点赞自增
     */
    public function click($id)
    {
        $msg = '不能点赞自己的话题';
        IdeasClickModel::create($this->tolimit($id,$msg));
        return redirect('/idea');
    }

    /**
     * 收藏自增
     */
    public function collect($id)
    {
        $msg = '不能收藏自己的话题';
        IdeasCollectModel::create($this->tolimit($id,$msg));
        return redirect('/talk');
    }

    /**
     * 一些限制
     */
    public function tolimit($id,$msg)
    {
        $this->islogin();
        $ideaModel = IdeasModel::find($id);
        if ($this->userid==$ideaModel->uid) { echo "<script>alert('".$msg."！');history.go(-1);</script>";exit; }
        return array(
            'ideaid'=> $id,
            'uid'=> $this->userid,
        );
    }


    public function query()
    {
        return IdeasModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
    }
}