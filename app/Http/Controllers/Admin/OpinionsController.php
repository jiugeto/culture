<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiOpinion;
use App\Api\ApiUser\ApiUserVoice;
use Illuminate\Http\Request;

class OpinionsController extends BaseController
{
    /**
     *系统后台用户意见管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '意见列表';
        $this->crumb['category']['name'] = '意见管理';
        $this->crumb['category']['url'] = 'opinions';
    }

    public function index($isshow=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/opinions';
        $result = [
            'datas'=> $this->query($isshow,$pageCurr,$prefix_url),
            'prefix_url'=> $prefix_url,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isshow'=> $isshow,
        ];
        return view('admin.opinions.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiOpinion::getOneOpinion($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.opinions.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $request->all();
        $data['id'] = $id;
        $rst = ApiOpinion::modifyOpinion($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/opinions');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiOpinion::getOneOpinion($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.opinions.show', $result);
    }

    public function destroy($id)
    {
        $rst = ApiOpinion::isdel($id,1);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/opinions');
    }

    public function restore($id)
    {
        $rst = ApiOpinion::isdel($id,0);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/opinions/trash');
    }

    public function forceDelete($id)
    {
        $rst = ApiOpinion::delete($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/opinions/trash');
    }

    public function query($isshow,$pageCurr,$prefix_url)
    {
        $rst = ApiOpinion::getOpinionList($this->limit,$pageCurr,$isshow);
        $datas = $rst['code']==0 ? $rst['data'] : [];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }

    /**
     * 清空表
     */
    public function clearTable()
    {
        if (\Session::get('admin.username')!='jiuge') {
            echo "<script>alert('权限不足！');history.go(-1);</script>";exit;
        } elseif (env('APP_ENV')!='local' && env('APP_DEBUG')!='true') {
            echo "<script>alert('本地调试模式才能清表！');history.go(-1);</script>";exit;
        }
        $rst = ApiOpinion::clearTable();
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/opinions');
    }
}