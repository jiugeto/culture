<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiUser\ApiUsers;
use App\Models\Base\PicModel;
use App\Models\BaseModel;

class SkinController extends BaseController
{
    /**
     * 个人后台 皮肤管理
     */

    protected $curr = 'skin';

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $picModel = PicModel::where('uid',$this->userid)->get();
        $result = [
            'data'=> $this->query(),
//            'pics'=> $this->model->pics($this->userid),
            'pics'=> $picModel,
            'model'=> new BaseModel(),
            'user'=> $this->user,
            'links'=> $this->links,
            'curr'=> $this->curr,
        ];
        return view('person.skin.index', $result);
    }

    public function setTopBg($pic_id)
    {
//        UserParamsModel::where('uid',$this->userid)->update(['per_top_bg_img'=> $pic_id]);
        $data = [
            'uid'   =>  $this->userid,
            'pic_id'    =>  $pic_id,
        ];
        $rst = ApiUsers::setPersonTopBg($data);
        if ($rst['code']!=0) {
            echo "<script>alert('".$rst['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/skin');
    }





    public function query()
    {
//        return UserParamsModel::where('uid',$this->userid)->first();
        $rst = ApiUsers::getParamByUid($this->userid);
        return $rst['code']==0 ? $rst['data'] : [];
    }
}