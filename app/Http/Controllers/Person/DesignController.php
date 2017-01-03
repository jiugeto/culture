<?php
namespace App\Http\Controllers\Person;

use App\Models\BaseModel;
use App\Models\DesignModel;

class DesignController extends BaseController
{
    /**
     * 个人后台 设计管理
     */

    protected $curr = 'design';
    protected $limit = 15;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $result = [
            'datas'=> $this->query(),
            'prefix_url'=> DOMAIN.'person/design',
            'user'=> $this->user,
            'model'=> new BaseModel(),
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.design.index', $result);
    }





    public function query()
    {
        $datas = DesignModel::where('del',0)
            ->orderBy('sort','desc')
            ->orderBy('id','desc')
            ->paginate($this->limit);
        $datas->limit = $this->limit;
        return $datas;
    }
}