<?php
namespace App\Http\Controllers\Home;

use App\Models\IdeasClickModel;
use App\Models\IdeasCollectModel;
use App\Models\IdeasModel;
use App\Models\IdeasReadModel;
use App\Models\Base\OrderModel;
use App\Tools;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    /**
     * 前台创意管理
     */

    protected $curr = 'idea';

    public function __construct()
    {
        parent::__construct();
        $this->model = new IdeasModel();
    }

    public function islogin()
    {
        if (!\Session::has('user.uid')) {
            echo "<script>alert('您还没有登录，请先登录！');window.location.href='/login';</script>";exit;
        }
    }

    public function index($cate=0)
    {
        $result = [
            'datas'=> $this->query($cate),
            'prefix_url'=> DOMAIN.'idea',
            'model'=> $this->model,
            'lists'=> $this->list,
            'curr_menu'=> $this->curr,
            'userid'=> $this->userid,
            'cate'=> $cate,
        ];
//        dd(\App\Api\ApiUsers::getOneUser(1));
//        dd(\App\Api\ApiPerson::getPersonInfo(1));
//        dd(\App\Api\ApiCompany::getCompanyInfo(1));
        dd(\App\Api\ApiCompany::getCompanyList());
        return view('home.idea.index', $result);
    }

    /**
     * 浏览权限控制
     */
    public function show($id)
    {
        $this->islogin();
        $data = IdeasModel::find($id);
        if ($data->uid!=$this->userid) {
            $create = ['ideaid'=>$id,'uid'=>$this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
            IdeasReadModel::create($create);
        }
        //内容查看权限开关
        $data->iscon = 0;
        if ($data->genre==1) {
            //供应分镜
            $orderModel = OrderModel::where('buyer',$this->userid)
                ->where('status','>',11)
                ->where('isshow',1)
                ->where('del',0)
                ->first();
        } elseif ($data->genre==2) {
            //需求分镜
            $orderModel = OrderModel::where('seller',$this->userid)
                ->where('status','>',11)
                ->where('isshow',1)
                ->where('del',0)
                ->first();
        }
        if (isset($orderModel) && $orderModel) {
            if ($orderModel->status < 12) { $data->iscon = 1; }
            elseif ($orderModel->status == 13) { $data->iscon = 2; }
            elseif ($orderModel->status == 12) { $data->iscon = 3; }
            $data->remarks = $orderModel->remarks;
        }
        $result = [
            'data'=> $data,
            'curr_menu'=> $this->curr,
        ];
        return view('home.idea.show', $result);
    }

    /**
     * 点赞自增
     */
    public function click($id,$click)
    {
        $this->islogin();
        if (!$click) {        //增加
            $create = ['ideaid'=> $id,'uid'=> $this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
            IdeasClickModel::create($create);
        } else {        //减少
            IdeasClickModel::where('ideaid',$id)->delete();
        }
        return redirect('/idea');
    }

    /**
     * 收藏自增
     */
    public function collect($id,$collect)
    {
        $this->islogin();
        if (!$collect) {      //增加
            $create = ['ideaid'=> $id,'uid'=> $this->userid,'created_at'=>date('Y-m-d H:i:s',time())];
            IdeasCollectModel::create($create);
        } else {        //减少
            IdeasCollectModel::where('ideaid',$id)->delete();
        }
        return redirect('/idea');
    }


    public function query($cate)
    {
        if ($cate) {
            $datas = IdeasModel::where('del',0)
                ->where('cate',$cate)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } else {
            $datas = IdeasModel::where('del',0)
                ->orderBy('sort','desc')
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}