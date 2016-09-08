<?php
namespace App\Http\Controllers\Company;

use App\Models\Base\VisitlogModel;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cookie;

class VisitlogController extends BaseController
{
    /**
     * 公司页面的用户访问记录日志
     */

    protected $time = 1;       //设置cookie有效期1/30分钟

    public function setVisit()
    {
        if (AjaxRequest::ajax()) {
            $data = Input::all();
            if ($data['cid']) {
                $this->getCookie($data); exit;
            }
        }
//        echo json_encode(array('code'=>'-1', 'message' =>'操作有误！'));exit;
        dd('操作有误！');
    }





    public function getCookie($data)
    {
        if ($visit = Cookie::get('visit')) {
            //有访问的cookie就更新下
            if ($visit['cid']==$data['cid'] && $visit['uid']==$data['uid'] && $visit['logoutTime']+1000*$this->time<time()) {
                $visit1 = $this->getData($data);
                $visit1['logoutTime'] = time();
                VisitlogModel::where('serial',$visit1['serial'])->update($visit1);
                Cookie('visit',serialize($visit1),10);
            }
        } else {
            //没有就创建cookie
            $visit1 = $this->getData($data);
            VisitlogModel::create($visit1);
            Cookie('visit',$visit1,10);
            dd($visit1,Cookie('visit'));
        }
    }

    public function getData($data)
    {
        $serial = date('YmdHis',time()).rand(0,10000);
        $ip = \App\Tools::getIp();
        $ipaddress = \App\Tools::getCityByIp($ip);
        return array(
            'cid'=> $data['cid'],
            'visit_id'=> $data['uid'],
            'action'=> $data['visit_url'],
            'ip'=> $ip,
            'ipaddress'=> $ipaddress,
            'serial'=> $serial,
            'loginTime'=> time(),
        );
    }
}