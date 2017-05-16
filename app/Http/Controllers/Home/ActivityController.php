<?php
namespace App\Http\Controllers\Home;

use App\Api\ApiUser\ApiActivity;
use App\Api\ApiUser\ApiGold;

class ActivityController extends BaseController
{
    /**
     * 平台活动
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
//        $apiActivity1 = ApiActivity::index(1,1,1);
//        $apiActivity2 = ApiActivity::index(1,1,2);
//        $apiActivity3 = ApiActivity::index(1,1,3);
//        $apiActivity4 = ApiActivity::index(1,1,4);
//        $apiActivity5 = ApiActivity::index(1,1,5);
//        $apiActivity6 = ApiActivity::index(1,1,6);
//        $datas = [
//            'activity1' =>  $apiActivity1['code']==0 ? $apiActivity1['data'] : [],
//            'activity2' =>  $apiActivity2['code']==0 ? $apiActivity2['data'] : [],
//            'activity3' =>  $apiActivity3['code']==0 ? $apiActivity3['data'] : [],
//            'activity4' =>  $apiActivity4['code']==0 ? $apiActivity4['data'] : [],
//            'activity5' =>  $apiActivity5['code']==0 ? $apiActivity5['data'] : [],
//            'activity6' =>  $apiActivity6['code']==0 ? $apiActivity6['data'] : [],
//        ];
        $model = $this->getModel();
        $result = [
//            'datas'     =>  $datas,
            'genres'    =>  $model['genres'],
            'curr_menu' => 'active',
        ];
        return view('home.activity.index', $result);
    }

    /**
     * 某一类活动列表
     */
    public function getActivityList($genre)
    {
        $model = $this->getModel();
        if (!array_key_exists($genre,$model['genres'])) {
            echo "<script>alert('参数错误！');history.go(-1);</script>";exit;
        }
        $prefix_url = DOMAIN.'active/s/'.$genre;
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        if (in_array($genre,[1,2,3,4])) {
            $apiData = ApiActivity::index(10,$pageCurr,$genre);
            $view = "activitylist";
        } else if ($genre==5) {
            dd('待处理');
        } else if ($genre==6) {
            $apiData = ApiGold::index(10,$pageCurr,0);
            $view = "userlist";
        } else {
        }
        if ($apiData['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiData['data']; $total = $apiData['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas'     =>  $datas,
            'pagelist'  =>  $pagelist,
            'prefix_url'    =>  $prefix_url,
            'genreName'     =>  $model['genres'][$genre],
            'curr_menu'     =>  'active',
        ];
        return view('home.activity.'.$view, $result);
    }

//    /**
//     * 活动的用户获取列表
//     */
//    public function getUserList($genre)
//    {
//        $model = $this->getModel();
//        if (!array_key_exists($genre,$model['genres'])) {
//            echo "<script>alert('活动不存在！');history.go(-1);</script>";exit;
//        }
//        $prefix_url = DOMAIN.'active/'.$genre.'/user';
//        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
//        $apiActivity = ApiActivity::getUsersByAct(20,1,$genre);
//        if ($apiActivity['code']!=0) {
//            $datas = array(); $total = 0;
//        } else {
//            $datas = $apiActivity['data']; $total = $apiActivity['pagelist']['total'];
//        }
//        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
//        $model = $this->getModel();
//        $result = [
//            'datas'     =>  $datas,
//            'pagelist'  =>  $pagelist,
//            'prefix_url'    =>  $prefix_url,
//            'curr_menu'     =>  'active',
//            'genreName'         =>  $model['genres'][$genre],
//        ];
//        return view('home.activity.userlist', $result);
//    }

    public function getModel()
    {
        $apiModel = ApiActivity::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}