<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiLog;

class AdminlogController extends BaseController
{
    /**
     * 用户日志管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '管理员日志';
        $this->crumb['category']['name'] = '管理员日志管理';
        $this->crumb['category']['url'] = 'adminlog';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/adminlog';
        $apiLog = ApiLog::getAdminLogList($this->limit,$pageCurr);
        if ($apiLog['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiLog['data']; $total = $apiLog['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.log.index', $result);
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
        return view('admin.log.show', $result);
    }
}