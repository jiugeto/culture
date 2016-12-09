<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiLog;

class UserlogController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '用户日志';
        $this->crumb['category']['name'] = '用户日志管理';
        $this->crumb['category']['url'] = 'userlog';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/userlog';
        $result = [
            'datas'=> $this->query($pageCurr,$prefix_url),
            'prefix_url'=> $prefix_url,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.userlog.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rstLog = ApiLog::show($id);
        if ($rstLog['code']!=0) {
            echo "<script>alert('".$rstLog['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rstLog['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.userlog.show', $result);
    }

    public function query($pageCurr,$prefix_url)
    {
        $rst = ApiLog::getUserLogList($this->limit,$pageCurr);
        $datas = $rst['code']==0 ? $rst['data'] : [];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }
}