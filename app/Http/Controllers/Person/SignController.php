<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiUser\ApiSign;
use App\Models\Base\WalletModel;
use App\Models\BaseModel;

class SignController extends BaseController
{
    /**
     * 个人后台 用户签到
     */

    protected $curr = 'sign';
    protected $fromtime;    //当天凌晨0点
    protected $totime;      //当天晚上24点
    protected $fromMonth;   //当月1号凌晨0点
    protected $toMonth;     //当月最后一天晚上24点

    public function __construct()
    {
        parent::__construct();
        $this->fromtime = strtotime(date('Ymd',time()).'000000');
        $this->totime = strtotime(date('Ymd',time()).'595959');
    }

    public function index()
    {
        $pageCurr = isset($_POST['page']) ? $_POST['page'] : 1;
        $prefix_url = DOMAIN.'person/sign';
        $apiSign = ApiSign::index($this->limit,$pageCurr,$this->userid);
        if ($apiSign['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiSign['data']; $total = $apiSign['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'hasDay' => $this->getDaySign(),
            'months' => $this->getMonths(),
            'curr' => $this->curr,
        ];
//        dd($this->getMonths());
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
        $userParam = WalletModel::where('uid',$this->userid)->first();
        WalletModel::where('id',$userParam->id)->update(['sign'=> $userParam->sign+$reward]);
        return redirect(DOMAIN.'person/sign');
    }

    /**
     * 查询当前用户当天签到情况
     */
    public function getDaySign()
    {
        $apiSign = ApiSign::getSignsByUid($this->userid,$this->fromtime,$this->totime);
        return $apiSign['code']==0 ? 1 : 0;
    }

//    /**
//     * 计算当前月天数
//     */
//    public function getMonthCurr()
//    {
//        return array(
//            'count'=> (isset($month)&&$month) ? $month : 30,
//            'date'=> date('Y-m',time()),
//            'year'=> date('Y',time()),
//            'month'=> date('m',time()),
//            'day'=> ltrim(date('d',time()),'0'),
//            'week'=> date('w',time()),
//        );
//    }

    /**
     * 计算当月日期情况
     */
    public function getMonths()
    {
        $nianfen = date('Y',time());
        $yuefen = date('m',time());
        if ($yuefen==2) {
            $month = $nianfen%4==0 ? 29 : 28;
        } elseif (in_array($yuefen,[1,3,5,7,8,10,12])) {
            $month = 31;
        } elseif (in_array($yuefen,[4,6,9,11])) {
            $month = 30;
        } else {
            $month = 30;
        }
        $index = 0;
        for ($i=1;$i<=$month;++$i) {
            $i = $i<10 ? '0'.$i : $i;
            $week = date('w',strtotime(date('Ym',time()).$i));
            $day['day'] = $i;
            $day['week'] = $week;
            $monthArr[$index][$week] = $day;
            if ($week==6) { $index ++; }
        }
//        foreach ($months as $k=>$value) {
//            foreach ($value as $val) { $monthArr[$k][] = $val; }
//        }
        return $monthArr;
    }
}