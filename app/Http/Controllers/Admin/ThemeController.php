<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiTalk\ApiTheme;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class ThemeController extends BaseController
{
    /**
     * 网站链接管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '专栏列表';
        $this->crumb['category']['name'] = '专栏管理';
        $this->crumb['category']['url'] = 'theme';
    }

    public function index($uname='')
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['pageCurr'])?$_GET['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/theme';
        $apiTheme = ApiTheme::index($this->limit,$pageCurr,$uname);
        if ($apiTheme['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiTheme['data']; $total = $apiTheme['pagelist']['total'];
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
        return view('admin.theme.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $rst = ApiTheme::add($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/theme');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $rst = ApiTheme::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $rst = ApiTheme::modify($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/theme');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rst = ApiTheme::show($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rst['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.theme.show', $result);
    }

    /**
     * 设置删除
     */
    public function isdel($id,$del)
    {
        $rst = ApiTheme::isdel($id,$del);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/theme');
    }

    /**
     * 销毁记录
     */
    public function delete($id)
    {
        $rst = ApiTheme::delete($id);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/theme');
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
        if (!$request->name || !$request->intro) {
            echo "<script>alert('专题名称、内容必填！');history.go(-1);</script>";exit;
        }
        return array(
            'name'  =>  $request->name,
            'intro' =>  $request->intro,
            'uid'   =>  $uid,
            'uname' =>  $uname,
        );
    }
}