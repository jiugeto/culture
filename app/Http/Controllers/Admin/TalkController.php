<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiTalk\ApiTalk;
use App\Api\ApiTalk\ApiTheme;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class TalkController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '话题列表';
        $this->crumb['category']['name'] = '话题管理';
        $this->crumb['category']['url'] = 'talk';
    }

    public function index($uname=0)
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/talk';
        $apiTalk = ApiTalk::index($this->limit,$pageCurr,$uname);
        if ($apiTalk['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTalk['data']; $total = $apiTalk['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
            'uname' => $uname ? $uname : '',
        ];
        return view('admin.talk.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $rstTheme = ApiTheme::themeAll();
        if ($rstTheme['code']!=0) {
            echo "<script>alert('".$rstTheme['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'themes'=> $rstTheme['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.talk.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rst = ApiTalk::add($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/talk');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiTalk::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $rstTheme = ApiTheme::themeAll();
        if ($rstTheme['code']!=0) {
            echo "<script>alert('".$rstTheme['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'themes'=> $rstTheme['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.talk.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $rst = ApiTalk::modify($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/talk');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiTalk::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.talk.show', $result);
    }

    public function isdel($id,$del)
    {
        $rst = ApiTalk::isdel($id,$del);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/talk');
    }

    /**
     * 销毁记录
     */
    public function delete($id)
    {
        $rst = ApiTalk::delete($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/talk');
    }





    public function getData(Request $request)
    {
        if (!$request->uname || $request->uname=='本站') {
            $uname = '本站';
            $uid = 0;
        } else {
            $rstUser = ApiUsers::getOneUserByUname($request->uname);
            if ($rstUser['code']!=0) {
                echo "<script>alert('用户不存在！');history.go(-1);</script>";exit;
            }
            $uname = $request->uname;
            $uid = $rstUser['id'];
        }
        return array(
            'name'  =>  $request->name,
            'themeid'   =>  $request->theme,
            'intro' =>$request->intro,
            'uid'   =>  $uid,
            'uname' =>  $uname,
        );
    }
}