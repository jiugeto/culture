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
        $this->list['create'] = '发布意见';
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
        $data['created_at'] = date('Y-m-d', time());
        OpinionModel::create($data);
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
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'pic'=> isset($pic) ? $pic : '',
            'uid'=> $uid,
            'status'=> 1,       //1是新发布
            'remarks'=> '',
            'reply_id'=> '',
            'isshow'=> 1,       //1是前台列表显示
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
        } else { $datas = []; }
        return $datas;
    }
}