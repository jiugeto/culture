<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiProVideo;
use Illuminate\Http\Request;

class ProductVideoController extends BaseController
{
    /**
     * 会员后台 在线定制
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '效果定制';
        $this->lists['func']['url'] = 'provideo';
        $this->lists['create']['name'] = '发布需求';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/provideo';
        $datas = $this->query($pageCurr,2);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'lists' => $this->lists,
            'curr' => $curr,
        ];
        return view('member.provideo.index', $result);
    }

    /**
     * 效果定制的编辑
     */
    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $apiProVideo = ApiProVideo::show();
        $result = [
            'data'=> ProductVideoModel::find($id),
            'model'=> $this->model,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.provideo.edit', $result);
    }

    /**
     * 效果定制的修改
     */
    public function update(Request $request,$id)
    {
        if (!$request->name || !$request->intro || !$request->link) {
            echo "<script>alert('视频名称、效果链接、修改要求必填！');history.go(-1);</script>";exit;
        } elseif (strlen($request->name)<2 || strlen($request->name)>20) {
            echo "<script>alert('名称2-20字符！');history.go(-1);</script>";exit;
        } elseif (!preg_match("/https?:\/\/[\w.]+[\w\/]*[\w.]*\??[\w=&\+\%]*/is",$request->link)) {
            echo "<script>alert('链接地址格式不对！');history.go(-1);</script>";exit;
        }
        $data = [
            'name'=> $request->name,
            'intro'=> $request->intro,
            'link'=> $request->link,
            'updated_at'=> time(),
        ];
        ProductVideoModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'member/provideo');
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> ProductVideoModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.provideo.show', $result);
    }






    public function query($pageCurr,$isshow)
    {
        $apiProVideo = ApiProVideo::index($this->limit,$pageCurr,0,0,$this->userid,$isshow);
        return $apiProVideo['code']==0 ? $apiProVideo['data'] : [];
    }

//    public function pre($id)
//    {
//        $proVideo = ProductVideoModel::find($id);
//        $result = [
//            'video'=> VideoModel::find($proVideo->video_id),
//            'videoName'=> $proVideo->name,
//        ];
//        return view('layout.videoPre', $result);
//    }
}