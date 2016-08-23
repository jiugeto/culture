<?php
namespace App\Http\Controllers\Person;

use App\Models\Base\UserSpaceModel;

class SkinController extends BaseController
{
    /**
     * 个人后台 皮肤管理
     */

    protected $curr = 'skin';

    public function __construct()
    {
        parent::__construct();
        $this->model = new UserSpaceModel();
    }

    public function index()
    {
        $result = [
            'data'=> $this->query(),
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.skin.index', $result);
    }





    public function query()
    {
        return UserSpaceModel::where('uid',$this->userid)->first();
    }
}