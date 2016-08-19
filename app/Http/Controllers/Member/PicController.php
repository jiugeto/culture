<?php
namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Models\PicModel;

class PicController extends BaseController
{
    /**
     * 会员后台图片管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '我的图片';
        $this->lists['func']['url'] = 'pic';
        $this->lists['create']['name'] = '添加图片';
        $this->model = new PicModel();
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'datas'=> $this->query($del=0),
            'prefix_url'=> DOMAIN.'member/pic',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        PicModel::saveSize();      //确定图片存储
        return view('member.pic.index', $result);
    }

    public function trash()
    {
        $curr['name'] = $this->lists['trash']['name'];
        $curr['url'] = $this->lists['trash']['url'];
        $result = [
            'datas'=> $this->query($del=1),
            'prefix_url'=> DOMAIN.'member/pic/trash',
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->lists['create']['name'];
        $curr['url'] = $this->lists['create']['url'];
        $result = [
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $data['created_at'] = time();
        PicModel::create($data);
        return redirect(DOMAIN.'member/pic');
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $result = [
            'data'=> PicModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['updated_at'] = time();
        //处理图片
        $picModel = PicModel::find($id);
        if (!$data['url'] && $picModel->url) { $data['url'] = $picModel->url; }
        PicModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/pic');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> PicModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.pic.show', $result);
    }

    public function destroy($id)
    {
        PicModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'member/pic');
    }

    public function restore($id)
    {
        PicModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'member/pic/trash');
    }

    public function forceDelete($id)
    {
        PicModel::where('id',$id)->delete();
        return redirect(DOMAIN.'member/pic/trash');
    }



    public function getData(Request $request)
    {
        //图片上传
        if($request->hasFile('url_ori')){  //判断图片存在
            foreach ($_FILES as $pic1) {
                if ($pic1['size'] > $this->uploadSizeLimit) {
                    echo "<script>alert('对不起，你上传的文件大于5M，请重新选择');history.go(-1);</script>";exit;
                }
            }
            $file = $request->file('url_ori');  //获取文件
            $picUrl = \App\Tools::upload($file);
//            $config = [
//                'fileField' => 'url_ori1',    //文件域字段名
//                'allowFiles'=> $this->pic_suffixs,   //允许上传的文件后辍
//                'maxSize'   => $this->uploadSizeLimit, //允许上传文件的大小5M 单位 b
//                'nameFormat'=> $this->pic_path,
//            ];
//            $rst = Uploader::save($config, $request);
//            if ($rst['state']=='SUCCESS') { $data['pic'] = $rst['url']; }
//            else { echo "<script>alert('图片上传错误，".$rst['state']."！');history.go(-1);</script>";exit; }
        } elseif ($request->url) {
            $picUrl = $request->url;
        } else {
            echo "<script>alert('图片未上传或者地址为空！');history.go(-1);</script>";exit;
        }
        $data = [
            'uid'=> $this->userid,
            'name'=> $request->name,
            'intro'=> $request->intro,
            'url'=> isset($picUrl) ? $picUrl : '',
        ];
        return $data;
    }

    public function query($del)
    {
        return PicModel::where('del',$del)
            ->where('uid',\Session::get('user.uid'))
            ->paginate($this->limit);
    }
}