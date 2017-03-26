<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

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
        $apiBg = ApiUsers::getOneUser($this->userid);
        $result = [
            'spaceTopBg'=> $apiBg['code']==0 ? $apiBg['data']['spaceTopBg'] : '',
            'curr'=> $this->curr,
        ];
        return view('person.skin.index', $result);
    }

    public function setSpaceTopBg(Request $request)
    {
        if (!isset($request->spacetopbg)) {
            echo "<script>alert('未上传图片！');history.go(-1);</script>";exit;
        }
        $apiUser = ApiUsers::getOneUser($this->userid);
        $thumbOldArr[] = $apiUser['data']['spaceTopBg'];
        $thumb = $this->uploadOnlyImg($request,'spacetopbg',$thumbOldArr);
        $apiBg = ApiUsers::setPersonTopBg($this->userid,$thumb);
        if ($apiBg['code']!=0) {
            echo "<script>alert('".$apiBg['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/skin');
    }
}