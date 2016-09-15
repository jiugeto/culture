<?php
namespace App\Http\Controllers\Company;

use App\Models\Base\VisitlogModel;
use App\Models\Company\ComMainModel;
use App\Models\CompanyModel;
use App\Models\UserModel;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;
use Redis;
use App\Tools;

class VisitlogController extends BaseController
{
    /**
     * 公司页面的用户访问记录日志
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function setVisit()
    {
        if (AjaxRequest::ajax()) {
            $data = Input::all();
            //公司页面访问日志刷新频率
            $comMainModel = ComMainModel::where('cid',$data['cid'])->first();
            $visitRate = $comMainModel->visitRate;
            if ($data['cid']) {
                $this->getRedis($data,$visitRate);
            }
        }
        dd('操作有误！');
    }





    public function getRedis($data,$visitRate)
    {
        $suffix = $this->getUrl($data['visit_url'],$data['cid']);
        $key = 'visit_'.$suffix;
        $time = time();
        //1>假如同一天同一ip同一页面，先是游客，再是会员访问，则认为是同一人访问
        $visitOneDay = VisitlogModel::where('ip',Tools::getIp())
            ->where('visit_id',0)
            ->where('loginTime','>',strtotime(date('Ymd',time()).'000000'))
            ->where('action',$data['visit_url'])
            ->orderBy('id','desc')
            ->first();
        if ($visitOneDay && $data['uid']) {
            VisitlogModel::where('ip',Tools::getIp())
                ->where('visit_id',0)
                ->where('loginTime','>',strtotime(date('Ymd',time()).'000000'))
                ->where('action',$data['visit_url'])
                ->update(array('uid'=> $data['uid'], 'logoutTime'=> time()));
        }
        //2>假如同一天同一ip同一页面，先是会员，再是游客访问，则认为是同一人访问
        $visitOneDay = VisitlogModel::where('ip',Tools::getIp())
            ->where('visit_id','>',0)
            ->where('loginTime','>',strtotime(date('Ymd',time()).'000000'))
            ->where('action',$data['visit_url'])
            ->orderBy('id','desc')
            ->first();
        if ($visitOneDay && !$data['uid']) {
            VisitlogModel::where('ip',Tools::getIp())
                ->where('visit_id','>',0)
                ->where('loginTime','>',strtotime(date('Ymd',time()).'000000'))
                ->where('action',$data['visit_url'])
                ->update(array('uid'=> 0, 'logoutTime'=> time()));
        }
        //3>以下是更新访问日志的几种情况
        if (Redis::exists($key)) {
            $visit = unserialize(Redis::get($key));
            if ($visit['logoutTime']+$visitRate < time()) {
                $visit1 = $visit;
                $visit1['logoutTime'] = $time;
                Redis::setex($key, 3600, serialize($visit1));       //更新缓存，有效1小时
                //更新数据库
                VisitlogModel::where('serial',$visit['serial'])->update(['logoutTime'=> $time]);
                VisitlogModel::where('serial',$visit['serial'])->increment('timeCount',$visitRate);
            }
            dd('更新成功！'); exit;
        } else {
            $visit = $this->getData($data);
            $visit['logoutTime'] = $time;
            Redis::setex($key, 3600, serialize($visit));       //添加缓存，有效1小时

            //插入或更新数据库
            $where = [
                'visit_id'=> $data['uid'],
                'action'=> $data['visit_url'],
                'cid'=> $data['cid'],
            ];
            $visitModel = VisitlogModel::where($where)
                ->where('loginTime','>',strtotime(date('Ymd',time()).'000000'))
                ->where('logoutTime','<',strtotime(date('Ymd',time()).'235959'))
                ->first();
            $visitModel2 = VisitlogModel::where($where)
                ->where('ip',$visit['ip'])
                ->where('loginTime','>',strtotime(date('Ymd',time()).'000000'))
                ->where('logoutTime','<',strtotime(date('Ymd',time()).'235959'))
                ->first();
            if ($data['uid'] && $visitModel) {
                //假如是注册会员，并且当天有记录，则更新数据库
                VisitlogModel::where($where)->update(['logoutTime'=> $time]);
                VisitlogModel::where($where)->increment('timeCount',$visitRate);
                VisitlogModel::where($where)->increment('dayCount');
                dd('更新成功！'); exit;
            } elseif (!$data['uid'] && $visitModel2) {
                //假如是非注册会员同地区，并且当天有记录，则更新数据库
                VisitlogModel::where($where)->where('ip',$visit['ip'])->update(['logoutTime'=> $time]);
                VisitlogModel::where($where)->increment('timeCount',$visitRate);
                VisitlogModel::where($where)->increment('dayCount');
                dd('更新成功！'); exit;
            } else {
                //假如非注册会员，不在同一地区
                VisitlogModel::create($visit);
                dd('添加成功！'); exit;
            }
        }
    }

    /**
     * 收集数据
     */
    public function getData($data)
    {
        $serial = date('YmdHis',time()).rand(0,10000);
        $ip = Tools::getIp();
        $ipaddress = Tools::getCityByIp($ip);
        $companyModel = CompanyModel::find($data['cid']);
        $userModel = UserModel::find($data['uid']);
        return array(
            'cid'=> $data['cid'],
            'cname'=> $companyModel->name,
            'visit_id'=> $data['uid'],
            'uname'=> $userModel->username,
            'action'=> $data['visit_url'],
            'ip'=> $ip,
            'ipaddress'=> $ipaddress,
            'serial'=> $serial,
            'loginTime'=> time(),
        );
    }

    /**
     * 确定访问的是哪一个页面
     */
    public function getUrl($url,$cid)
    {
        $prefix = DOMAIN.'c/'.$cid;
        if ($url==$prefix) {
            $suffix = 1;
        } elseif ($url==$prefix.'/about') {
            $suffix = 2;
        } elseif ($url==$prefix.'/news') {
            $suffix = 3;
        } elseif ($url==$prefix.'/product') {
            $suffix = 4;
        } elseif ($url==$prefix.'/part') {
            $suffix = 5;
        } elseif ($url==$prefix.'/video') {
            $suffix = 6;
        } elseif ($url==$prefix.'/firm') {
            $suffix = 7;
        } elseif ($url==$prefix.'/team') {
            $suffix = 8;
        } elseif ($url==$prefix.'/recruit') {
            $suffix = 9;
        } elseif ($url==$prefix.'/contact') {
            $suffix = 10;
        } elseif ($url==$prefix.'/parterner') {
            $suffix = 11;
        }
        return isset($suffix) ? $suffix : 0;
    }
}