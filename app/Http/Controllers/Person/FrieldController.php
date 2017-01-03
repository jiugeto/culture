<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiUsers;
use App\Models\BaseModel;
use Illuminate\Http\Request;

class FrieldController extends BaseController
{
    /**
     * 个人后台 好友管理
     */

    protected $limit = 15;
    protected $curr = 'frield';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($m=0)
    {
        //m==0:我的好友;1:新的申请;2:寻找好友
        if ($m==0) {
            $prefix_url = DOMAIN.'person/frield';
        } else {
            $prefix_url = DOMAIN.'person/frield/m/'.$m;
        }
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        if (in_array($m,[0,1])) {
            $datas = $this->query($m,$pageCurr,$prefix_url);
        } elseif ($m==2) {
            $datas = $this->newFrields($pageCurr,$prefix_url);
        }
        $result = [
            'datas'=> $datas,
            'user'=> $this->user,
            'prefix_url'=> $prefix_url,
            'model'=> new BaseModel(),
            'links'=> $this->links,
            'curr'=> $this->curr,
            'm'=> $m,
        ];
        return view('person.frield.index', $result);
    }

    /**
     * 用户详情
     */
    public function show($m,$id)
    {
        if (in_array($m,[0,1,2])) {
            echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
        }
//        if (in_array($m,[0,1])) {
//            $rst = ApiPerson::getOneFrield($id);
//        } else {
            $rst = ApiUsers::getOneUser($id);
//        }
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'user'=> $this->user,
            'model'=> new BaseModel(),
            'links'=> $this->links,
            'curr'=> $this->curr,
            'm'=> $m,
        ];
        return view('person.frield.show', $result);
    }

    /**
     * 申请添加好友
     */
    public function getApply(Request $request)
    {
        if (!$request->frield_id || !$request->intro) {
            echo "<script>alert('好友、备注不能空！');history.go(-1);</script>";exit;
        }
        if ($request->frield_id==$this->userid) {
            echo "<script>alert('不能添加自己为好友！');history.go(-1);</script>";exit;
        }
        $data = [
            'uid'   =>  $this->userid,
            'frield_id' =>  $request->frield_id,
            'remarks'   =>  $request->intro,
        ];
        $rst = ApiPerson::addFrield($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/frield/m/1');
    }

    /**
     * 通过好友申请
     */
    public function getPass($id)
    {
        $data = [
            'id'    =>  $id,
            'isauth'    =>  3,
            'remarks2'  =>  '',
        ];
        $rst = ApiPerson::setFrieldAuth($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/frield');
    }

    /**
     * 拒绝好友申请
     */
    public function getRefuse(Request $request)
    {
        if (!$request->refuse || !$request->remarks2) {
            echo "<script>alert('参数有误！');history.go(-1);</script>";exit;
        }
        $data = [
            'id'    =>  $request->refuse,
            'isauth'    =>  2,
            'remarks2'  =>  $request->remarks2,
        ];
        $rst = ApiPerson::setFrieldAuth($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/frield/m/1');
    }





    public function query($m=0,$pageCurr,$prefix_url)
    {
        //m==0:我的好友;1:新的申请;2:寻找好友
//        if ($m==0) {
//            $datas = UserFrieldModel::where('isauth',3)
//                ->where(function($query){
//                    $query->where('uid',$this->userid)
//                        ->where('frield_id',$this->userid);
//                })
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        } elseif ($m=1) {
//            $datas = UserFrieldModel::where('isauth',1)
//                ->where('frield_id',$this->userid)
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        } elseif ($m=2) {
//            $datas = UserModel::where('id','>',$this->userid)
//                ->orderBy('id','desc')
//                ->paginate($this->limit);
//        }
//        $datas->limit = $this->limit;
        $rst = ApiPerson::getFrieldsOfMenu($this->limit,$pageCurr,$this->userid,$m);
        $datas = $rst['code']==0 ? $rst['data'] : [];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }

    /**
     * 查找好友列表
     */
    public function newFrields($pageCurr,$prefix_url)
    {
        $rst = ApiPerson::getNewFrields($this->limit,$pageCurr,$this->userid);
        $datas = $rst['code']==0 ? $rst['data'] : [];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }
}