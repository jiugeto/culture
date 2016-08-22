<?php
namespace App\Http\Controllers\Person;

use App\Models\UserFrieldModel;

class FrieldController extends BaseController
{
    /**
     * 个人后台 好友管理
     */

    protected $curr = 'frield';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($m=0)
    {
        //m==0:我的好友;1:新的申请;2:寻找好友
        $result = [
            'datas'=> $this->query($m),
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
            'm'=> $m,
        ];
        return view('person.frield.index', $result);
    }

    public function create()
    {
    }





    public function query($m=0)
    {
//        $uid = $this->userid ? $this->userid : 0;
        if ($m==0) {
            $datas = UserFrieldModel::where('isauth',3)
                ->where(function($query){
                    $query->where('uid',$this->userid)
                        ->where('frield_id',$this->userid);
                })
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($m=1) {
            $datas = UserFrieldModel::where('isauth',1)
                ->where('frield_id',$this->userid)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($m=2) {
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}