<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiUsers;
use App\Api\ApiUser\ApiUserVoice;
use Illuminate\Http\Request;

class UserVoiceController extends BaseController
{
    /**
     * 系统后台用户心声管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '用户心声';
        $this->crumb['category']['name'] = '心声管理';
        $this->crumb['category']['url'] = 'uservoice';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/uservoice';
        $apiUserVoice = ApiUserVoice::getUserVoiceList($this->limit,$pageCurr,0,0);
        if ($apiUserVoice['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiUserVoice['data']; $total = $apiUserVoice['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.uservoice.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiUserVoice::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.uservoice.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $rst = ApiUserVoice::modify($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/uservoice');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiUserVoice::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.uservoice.show', $result);
    }

    /**
     * 设置是否显示
     */
    public function setShow($id,$isshow)
    {
        $apiUserVoice = ApiUserVoice::setShow($id,$isshow);
        if ($apiUserVoice['code']!=0) {
            echo "<script>alert('".$apiUserVoice['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/uservoice');
    }




    /**
     * 收集数据
     */
    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $data = [
            'name'  =>  $request->name,
            'work'  =>  $request->work,
            'intro' =>  $request->intro,
            'uid'   =>  $apiUser['data']['id'],
        ];
        return $data;
    }
}