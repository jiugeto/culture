<?php
namespace App\Http\Controllers\Person;

use App\Models\Base\UserSignModel;
use App\Models\UserParamsModel;

class SignController extends BaseController
{
    /**
     * 个人后台 用户签到
     */

    protected $curr = 'sign';
    protected $fromtime;    //当天凌晨0点
    protected $totime;    //当天晚上24点
    protected $fromMonth;    //当月1号凌晨0点
    protected $toMonth;    //当月最后一天晚上24点

    public function __construct()
    {
        parent::__construct();
        $this->fromtime = date('Ymd',time()).'000000';    //当天凌晨0点
        $this->totime = date('Ymd',time()).'235959';    //当天晚上24点
        $this->fromMonth = date('Ym',time()).'00000000';    //当天凌晨0点
        //计算当月天数
        $yuefen = date('m',time());
        if ($yuefen==2) {
            $month = date('Y',time())%4==0 ? 29 : 28;
        } elseif (in_array($yuefen,[1,3,5,7,8,10,12])) {
            $month = 31;
        } elseif (in_array($yuefen,[4,6,9,11])) {
            $month = 30;
        }
        $month = (isset($month)&&$month) ? $month : 30;
        $this->toMonth = date('Ym',time()).$month.'235959';    //当天晚上24点
        $this->model = new UserSignModel();
    }

    public function index($date='')
    {
        $result = [
            'datas'=> $this->query($date),
            'month'=> $this->getMonth(),
//            'userSignCount'=> $this->queryCount(),
            'model'=> $this->model,
            'prefix_url'=> DOMAIN.'person/sign',
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
            'uid'=> $this->userid,
            'd'=> $date,
        ];
        return view('person.sign.index', $result);
    }

    public function add($day)
    {
        if ($this->getDaySign()) {
            echo "<script>alert('今天已经签到过了！');history.go(-1);</script>";exit;
        }
        if (ltrim(date('d',time()),'0')!=$day) {
            echo "<script>alert('点击的不是今天签到日期！');history.go(-1);</script>";exit;
        }
        $reward = rand(1,10);
        $data = [
            'uid'=> $this->userid,
            'reward'=> $reward,
            'created_at'=> time(),
        ];
        UserSignModel::create($data);
        //奖励加入总数
        $userParam = UserParamsModel::where('uid',$this->userid)->first();
        UserParamsModel::where('id',$userParam->id)->update(['sign'=> $userParam->sign+$reward]);
        return redirect(DOMAIN.'person/sign');
    }





    /**
     * 当天、月、总签到的用户
     */
    public function query($date='')
    {
        if ($date=='') {
            $datas = UserSignModel::where('created_at','>',strtotime($this->fromtime))
                ->where('created_at','<',strtotime($this->totime))
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($date=='month') {
            $datas = UserSignModel::where('created_at','>',strtotime($this->fromMonth))
                ->where('created_at','<',strtotime($this->toMonth))
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($date=='all') {
            $datas = UserSignModel::orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->hasDay = $this->getDaySign() ? 1 : 0;
        $datas->limit = $this->limit;
        return $datas;
    }

//    public function queryCount()
//    {
//        return UserSignModel::where('uid',$this->userid)->get();
//    }

    /**
     * 查询当前用户当天签到情况
     */
    public function getDaySign()
    {
        $userSign = UserSignModel::where('uid',$this->userid)
            ->where('created_at','>',strtotime($this->fromtime))
            ->where('created_at','<',strtotime($this->totime))
            ->first();
        return $userSign ? $userSign : '';
    }

    /**
     * 计算当前月天数
     */
    public function getMonth()
    {
        $monthStr = date('Y-m',time());       //当前年月
        $arr = explode('-',$monthStr);
        $nianfen = $arr[0];
        $yuefen = ltrim($arr[1],'0');
        if ($yuefen==2) {
            $month = $nianfen%4==0 ? 29 : 28;
        } elseif (in_array($yuefen,[1,3,5,7,8,10,12])) {
            $month = 31;
        } elseif (in_array($yuefen,[4,6,9,11])) {
            $month = 30;
        }
        return array(
            'count'=> (isset($month)&&$month) ? $month : 30,
            'date'=> date('Y-m',time()),
            'day'=> ltrim(date('d',time()),'0'),
            'week'=> date('w',time()),
        );
    }
}