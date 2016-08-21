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

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.frield.index', $result);
    }





    public function query()
    {
        $uid = $this->userid ? $this->userid : 0;
        $datas = UserFrieldModel::where('uid',$uid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}