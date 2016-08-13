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
            'curr_menu'=> $this->url_curr,
            'status'=> $status,
        ];
        return view('home.opinion.index', $result);
    }

    public function create($reply=0)
    {
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
        return redirect('/opinion');
    }

    public function show($id)
    {
        $this->menus['show'] = '意见详情';
        $result = [
            'data'=> OpinionModel::find($id),
//            'menus'=> $this->menus,
            'curr_menu'=> $this->url_curr,
            'curr'=> 'show',
        ];
        return view('home.opinion.show', $result);
    }

    public function edit($id)
    {
        $this->menus['edit'] = '修改意见';
        $result = [
            'data'=> OpinionModel::find($id),
//            'menus'=> $this->menus,
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
        return redirect('/opinion');
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
        //用户uid，暂时默认为0
        $uid = 0;
        //回复isreply，0是无回复，1是有回复
        $isreply = 0;
        $reply = 0;
        //上传图片
        if($request->hasFile('url_ori')){  //判断图片存在
            foreach ($_FILES as $pic1) {
                if ($pic1['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert('对不起，你上传的文件大于5M，请重新选择');history.go(-1);</script>";exit;
                }
            }
            $file1 = $request->file('url_ori');  //获取文件
            $pic = Tools::upload($file1);
//            $config = [
//                'fileField' => 'url_ori1',    //文件域字段名
//                'allowFiles'=> $this->pic_suffixs,   //允许上传的文件后辍
//                'maxSize'   => $this->uploadSizeLimit, //允许上传文件的大小5M 单位 b
//                'nameFormat'=> $this->pic_path,
//            ];
//            $rst = Uploader::save($config, $request);
//            if ($rst['state']=='SUCCESS') { $data['pic'] = $rst['url']; }
//            else { echo "<script>alert('图片上传错误，".$rst['state']."！');history.go(-1);</script>";exit; }
        }
        if ($id) {
            $opinion = OpinionModel::find($id);
            $isreply = $opinion->isreply;
            $reply = $opinion->reply;
            if (!isset($pic)) { $pic = $opinion->pic; }
        }
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'pic'=> isset($pic) ? $pic : '',
            'uid'=> $uid,
            'status'=> 1,       //1是新发布
            'remarks'=> '',
            'isreply'=> $isreply,
            'reply'=> $reply,
            'isshow'=> 2,       //2是前台列表显示
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
                    'isshow'=> 2,
                ])
                ->paginate($this->limit);
        } elseif ($status==2) {
            //未处理
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 2,
                ])
                ->where('status','<',3)
                ->paginate($this->limit);
        } elseif ($status==3) {
            //已处理
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 2,
                ])
                ->where('status','>',3)
                ->paginate($this->limit);
        } elseif ($status==5) {
            //处理并且满意
            $datas = OpinionModel::where([
                    'del'=> 0,
                    'isshow'=> 2,
                ])
                ->where('status',5)
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}