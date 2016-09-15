<?php
namespace App\Http\Controllers\Person;

use App\Models\Base\PicModel;

class PicController extends BaseController
{
    /**
     * 个人后台 图片管理
     */

    protected $curr = 'pic';
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'person/pic',
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.pic.index', $result);
    }





    public function query()
    {
        $uid = $this->userid ? $this->userid : 0;
        $datas = PicModel::where('del',0)
            ->where('uid',$uid)
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}