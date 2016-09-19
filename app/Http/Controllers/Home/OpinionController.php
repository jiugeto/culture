<?php
namespace App\Http\Controllers\Home;

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
    }

    public function index($status=0)
    {
        $result = [
            'datas'=> $this->query($status),
            'prefix_url'=> DOMAIN.'opinion',
            'curr_menu'=> $this->url_curr,
            'status'=> $status,
        ];
        return view('home.opinion.index', $result);
    }

    public function create($reply=0)
    {
        if (!\Session::has('user')) {
            echo "<script>alert('你还没有登录！');history.go(-1);</script>";
        }
        //如果 reply 是0。则无此记录，为新意见 isreply==0 ，否则是 isreply==1
        if (OpinionModel::find($reply)) { $isreply = 1; }else{ $isreply = 0; }
        $result = [
            'curr_menu'=> $this->url_curr,
            'curr'=> 'create',
            'isreply'=> $isreply,
        ];
        return view('home.opinion.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = date('Y-m-d', time());
        OpinionModel::create($data);
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
        $data['updated_at'] = date('Y-m-d', time());
        OpinionModel::where('id',$id)->update($data);
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
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->paginate($this->limit);
        } elseif ($status==2) {
            //未处理
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->where('status','<',3)
                ->paginate($this->limit);
        } elseif ($status==3) {
            //已处理
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->where('status','>',3)
                ->paginate($this->limit);
        } elseif ($status==5) {
            //处理并且满意
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->where('status',5)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}