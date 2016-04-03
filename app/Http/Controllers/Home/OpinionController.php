<?php
namespace App\Http\Controllers\Home;

use App\Models\OpinionModel;
use Illuminate\Http\Request;

class OpinionController extends BaseController
{
    /**
     * 网站前台需求信息
     */

    public function __construct()
    {
        $this->list['opinion'] = '用户意见';
    }

    public function index($status=0)
    {
        $result = [
            'datas'=> $this->query($status),
            'menus'=> $this->list,
            'curr'=> 'opinion',
            'status'=> $status,
        ];
        return view('home.opinion.index', $result);
    }

    public function create($reply=0)
    {
        $result = [
            'menus'=> $this->list,
            'curr'=> 'opinion',
            'reply'=> $reply,
        ];
        return view('home.opinion.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        OpinionModel::create($data);
        return redirect('/opinion');
    }





    /**
     * 收集数据
     */
    public function getData(Request $request,$id=null)
    {
        //上传图片
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
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
                    'from_type'=> 0,
                    'from_id'=> 0,
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->paginate($this->limit);
        } elseif ($status==2) {
            //未处理
            $datas = OpinionModel::where([
                    'from_type'=> 0,
                    'from_id'=> 0,
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->where('status','<',3)
                ->paginate($this->limit);
        } elseif ($status==3) {
            //已处理
            $datas = OpinionModel::where([
                    'from_type'=> 0,
                    'from_id'=> 0,
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->where('status','>',3)
                ->paginate($this->limit);
        } elseif ($status==5) {
            //处理并且满意
            $datas = OpinionModel::where([
                    'from_type'=> 0,
                    'from_id'=> 0,
                    'del'=> 0,
                    'isshow'=> 1,
                ])
                ->where('status',5)
                ->paginate($this->limit);
        } else { $datas = []; }
        return $datas;
    }
}