<?php
namespace App\Http\Controllers\Company\Admin;

use App\Api\ApiBusiness\ApiComModule;
use App\Api\ApiUser\ApiCompany;
use Session;

class LayoutController extends BaseController
{
    /**
     * 企业后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '公司信息';
        $this->lists['category']['url'] = 'cominfo';
        $this->lists['func']['name'] = '页面布局';
        $this->lists['func']['url'] = 'layout';
    }

    public function index($m=0)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $result = [
            'modules' => $this->modules(),
            'layoutHomeSwitchs' => $this->getLayoutHomeSwitchs(),
            'model' => $this->getModel(),
            'lists' => $this->lists,
            'curr' => $curr,
            'curr_func' => $this->lists['func']['url'],
            'm' => $m,   //0模块，1首页
        ];
        return view('company.admin.layout.index', $result);
    }

    /**
     * 控制模块是否显示
     */
    public function setShow($moduleid,$isshow)
    {
        $apiModule = ApiComModule::setShow($moduleid,$isshow);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."！');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'layout');
    }

    /**
     * 控制模块排序
     */
    public function sort($moduleid,$sort)
    {
        $apiModule = ApiComModule::setShow($moduleid,$sort);
        if ($apiModule['code']!=0) {
            echo "<script>alert('".$apiModule['msg']."！');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'layout');
    }

    /**
     * 控制公司首页信息显示
     */
    public function setLayoutHomeSwitch($key,$val)
    {
        $layoutArr = [
            'ppt'       =>  $key=='ppt' ? $val : 1,
            'service'   =>  $key=='service' ? $val : 1,
            'news'      =>  $key=='news' ? $val : 1,
            'product'   =>  $key=='product' ? $val : 1,
            'parterner' =>  $key=='parterter' ? $val : 1,
            'intro'     =>  $key=='intro' ? $val : 1,
            'part'      =>  $key=='part' ? $val : 1,
            'team'      =>  $key=='team' ? $val : 1,
            'recruit'   =>  $key=='recruit ' ?$val : 1,
            'contact'   =>  $key=='contact' ? $val : 1,
            'footLink'  =>  $key=='footLink' ? $val : 1,
        ];
        $apiLayout = ApiCompany::setLayout($this->cid,$layoutArr);
        if ($apiLayout['code']!=0) {
            echo "<script>alert('操作错误！');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN_C_BACK.'layout/m/1');
    }

    /**
     * 公司页面皮肤更换
     */
    public function setSkin($skin)
    {
        $skin = '#'.$skin;
        $apiSkin = ApiCompany::setSkin($this->cid,$skin);
        if ($apiSkin['code']!=0) {
            echo "<script>alert('".$apiSkin['msg']."');history.go(-1);</script>";exit;
        }
        //更新session
        $userInfo = Session::get('user');
        $userInfo['company']['skin'] = $skin;
        Session::put('user',$userInfo);
        return redirect(DOMAIN_C_BACK.'layout/m/1');
    }




    /**
     * 公司首页模块
     */
    public function modules()
    {
        $apiModule = ApiComModule::index(10,1,$this->cid,0);
        return $apiModule['code']==0 ? $apiModule['data'] : [];
    }

    /**
     * 获取企业首页的功能显示列表
     */
    public function getLayoutHomeSwitchs()
    {
        //先从session中取，没有在从数据库取
        $company = Session::get('user.company');
        $layoutArr = ($company&&$company['layout']) ? $company['layout'] : [];
        if (!$layoutArr) {
            $apiCompany = ApiCompany::show($this->cid);
            $layout = $apiCompany['data']['layout'];
            $layoutArr = $layout ? unserialize($layout) : [];
        }
        if (!$layoutArr) {
            $layoutArr = [
                'ppt'       =>  1,
                'service'   =>  1,
                'news'      =>  1,
                'product'   =>  1,
                'parterner' =>  1,
                'intro'     =>  1,
                'part'      =>  1,
                'team'      =>  1,
                'recruit'   =>  1,
                'contact'   =>  1,
                'footLink'  =>  1,
            ];
        }
        return $layoutArr;
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiCompany::getModel();
        return $apiModel['code']==0 ? $apiModel['model'] : [];
    }
}