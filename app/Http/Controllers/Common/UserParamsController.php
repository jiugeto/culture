<?php
namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\UserParamsModel;
use Illuminate\Http\Request;

class UserParamsController extends Controller
{
    /**
     * 用户参数控制器
     */

    public function __construct()
    {
        $this->userid = \Session::has('user.uid') ? \Session::get('user.uid') : redirect('/login');
    }

    public function setFootSwitch($switch)
    {
//        dd($switch,$_SERVER['HTTP_REFERER']);
        UserParamsModel::where('uid',$this->userid)->update(['foot_switch'=>$switch]);
        return redirect($_SERVER['HTTP_REFERER']);
    }
}