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

    public function __construct()
    {
        parent::__construct();
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
            'hasDay' => $this->getTodaySign(),
            'months' => $this->getMonths(),
            'curr' => $this->curr,
        ];
        return view('person.sign.index', $result);
    }

    public function store()
    {
        $apiSign = ApiSign::add($this->userid);
        if ($apiSign['code']!=0) {
            echo "<script>alert('".$apiSign['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/sign');
    }

    /**
     * 查询当前用户当天签到情况
     */
    public function getTodaySign()
    {
        $fromtime = strtotime(date('Ymd',time()).'000000');
        $totime = strtotime(date('Ymd',time()).'595959');
        $apiSign = ApiSign::getSignsByUid($this->userid,$fromtime,$totime);
        return $apiSign['code']==0 ? 1 : 0;
    }

    /**
     * 计算当月日期情况
     */
    public function getMonths()
    {
        $nianfen = date('Y',time());
        $yuefen = date('m',time());
        if ($yuefen==2) {
            $monthCount = $nianfen%4==0 ? 29 : 28;
        } elseif (in_array($yuefen,[1,3,5,7,8,10,12])) {
            $monthCount = 31;
        } elseif (in_array($yuefen,[4,6,9,11])) {
            $monthCount = 30;
        } else {
            $monthCount = 30;
        }
        //计算当月日历情况
        $monthArr = array();
        $index = 0;
        for ($i=1;$i<=$monthCount;++$i) {
            $i = $i<10 ? '0'.$i : $i;
            $week = date('w',strtotime(date('Ym',time()).$i));
            $day['day'] = $i;
            $day['week'] = $week;
            //计算是否签到
            $fromtime = strtotime(date('Y-m',time()).'-'.$i.' 00:00:00');
            $totime = strtotime(date('Y-m',time()).'-'.$i.' 24:59:59');
            $apiSign = ApiSign::getSignsByUid($this->userid,$fromtime,$totime);
            $day['hasSign'] = $apiSign['code']==0 ? 1 : 0;
            $monthArr[$index][$week] = $day;
            if ($week==6) { $index ++; }
        }
        return $monthArr;
    }
}