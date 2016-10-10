<?php
namespace App\Http\Controllers\Person;

use App\Models\UserParamsModel;

class SkinController extends BaseController
{
    /**
     * 个人后台 皮肤管理
     */

    protected $curr = 'skin';

    public function __construct()
    {
        parent::__construct();
        $this->model = new UserParamsModel();
    }

    public function index()
    {
        $result = [
            'data'=> $this->query(),
            'pics'=> $this->model->pics($this->userid),
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.skin.index', $result);
    }

    public function setTopBg($pic_id)
    {
        UserParamsModel::where('uid',$this->userid)->update(['per_top_bg_img'=> $pic_id]);
        return redirect(DOMAIN.'person/skin');
    }





    public function query()
    {
        return UserParamsModel::where('uid',$this->userid)->first();
    }
}