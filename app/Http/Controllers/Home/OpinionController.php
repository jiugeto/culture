<?php
namespace App\Http\Controllers\Home;

use App\Models\Base\UserGoldModel;
use App\Models\Base\WalletModel;
use App\Models\OpinionModel;
use Illuminate\Http\Request;
use App\Tools;

class OpinionController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    protected $url_curr = 'opinion';

    public function __construct()
    {
        parent::__construct();
        $this->model = new OpinionModel();
    }

    public function index($status=0)
    {
        $result = [
            'datas'=> $this->query($status),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'opinion',
            'curr_menu'=> $this->url_curr,
            'status'=> $status,
        ];
        return view('home.opinion.index', $result);
    }

    public function create()
    {
        if (!\Session::has('user')) {
            echo "<script>alert('你还没有登录！');history.go(-1);</script>";
        }
        //限制用户每日发布意见的数量
        $datas = OpinionModel::where('uid',$this->userid)
            ->where('created_at','>',strtotime(date('Ymd',time()).'000000'))
            ->where('created_at','<',strtotime(date('Ymd',time()).'235959'))
            ->get();
        if (count($datas)) {
            echo "<script>alert('今日意见发布已达上限！');history.go(-1);</script>";
        }
        $result = [
            'curr_menu'=> $this->url_curr,
            'curr'=> 'create',
        ];
        return view('home.opinion.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        OpinionModel::create($data);

        //成功发布后给用户随机奖励金币1-5个
        $data['gold1'] = rand(1,5);
        UserGoldModel::setGold($this->userid,1,$data['gold1']);
        //计算金币总数
        if (isset($data['gold1'])) { WalletModel::setGold($this->userid,$data['gold1']); }

        return redirect(DOMAIN.'opinion');
    }

    public function show($id)
    {
        $this->menus['show'] = '意见详情';
        $result = [
            'data'=> OpinionModel::find($id),
            'curr_menu'=> $this->url_curr,
            'curr'=> 'show',
        ];
        return view('home.opinion.show', $result);
    }

    public function edit($id)
    {
        if (!\Session::has('user')) {
            echo "<script>alert('你还没有登录！');history.go(-1);</script>";
        }
        $this->menus['edit'] = '修改意见';
        $result = [
            'data'=> OpinionModel::find($id),
            'curr_menu'=> $this->url_curr,
            'curr'=> 'edit',
        ];
        return view('home.opinion.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request,$id);
        $data['updated_at'] = time();
        OpinionModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'opinion');
    }

    public function getStatus($id)
    {
        if (!\Session::has('user')) {
            echo "<script>alert('你还没有登录！');history.go(-1);</script>";
        }
        $this->menus['edit'] = '意见评价';
        $result = [
            'data'=> OpinionModel::find($id),
            'curr_menu'=> $this->url_curr,
            'curr'=> 'edit',
        ];
        return view('home.opinion.status', $result);
    }

    public function setStatus(Request $request,$id)
    {
        if ($request->status==3 && !$request->remarks) {
            echo "<script>alert('请填写不满意缘由！');history.go(-1);</script>";exit;
        }
        $data = [
            'status'=> $request->status,
            'remarks'=> $request->remarks,
            'updated_at'=> time(),
        ];
        OpinionModel::where('id',$id)->update($data);

        //成功发布后给用户随机奖励金币10-15个
        if ($request->status==4) {
            $data['gold2'] = rand(10,15);
            UserGoldModel::setGold($this->userid,2,$data['gold2']);
        }
        //计算金币总数
        if (isset($data['gold2'])) { WalletModel::setGold($this->userid,$data['gold2']); }

        return redirect(DOMAIN.'opinion');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request,$id=null)
    {
        //判断内容有无
        if (!isset($request->intro)) {
            echo "<script>alert('内容不能为空！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'uid'=> \Session::has('user')?\Session::get('user.uid'):0,
        ];
        return $data;
    }

    /**
     * 查询方法，提取对本站的意见
     */
    public function query($status)
    {
        if ($status==0) {
            //所有意见
            $datas = OpinionModel::where('isshow', 2)
                ->paginate($this->limit);
        } elseif ($status==1) {
            //未处理
            $datas = OpinionModel::where('isshow', 2)
                ->where('status',1)
                ->paginate($this->limit);
        } elseif ($status==2) {
            //已处理
            $datas = OpinionModel::where('isshow', 1)
                ->where('status','>',3)
                ->paginate($this->limit);
        } elseif ($status==4) {
            //处理并且满意
            $datas = OpinionModel::where('isshow', 1)
                ->where('status',5)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}