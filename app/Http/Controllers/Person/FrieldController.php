<?php
namespace App\Http\Controllers\Person;

use App\Models\Base\UserFrieldModel;
use App\Models\UserModel;

class FrieldController extends BaseController
{
    /**
     * 个人后台 好友管理
     */

    protected $limit = 15;
    protected $curr = 'frield';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($m=0)
    {
        //m==0:我的好友;1:新的申请;2:寻找好友
        if ($m==0) {
            $prefix_url = DOMAIN.'member/frield';
        } else {
            $prefix_url = DOMAIN.'member/frield/m/'.$m;
        }
        $result = [
            'datas'=> $this->query($m),
            'user'=> $this->user,
            'prefix_url'=> $prefix_url,
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
        //m==0:我的好友;1:新的申请;2:寻找好友
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
            $datas = UserModel::where('id','>',$this->userid)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}