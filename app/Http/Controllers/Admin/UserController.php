<?php
namespace App\Http\Controllers\Admin;

use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiPerson;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * 用户日志管理
     */

    //会员身份：1普通用户，2个人会员，3普通企业，4设计师，5广告公司，6影视公司，7租赁公司，50超级用户
    protected $isusers = [
        1=>'普通用户','个人会员','普通企业','设计师','广告公司','影视公司','租赁公司',50=>'超级用户',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '会员列表';
        $this->crumb['category']['name'] = '会员管理';
        $this->crumb['category']['url'] = 'user';
    }

    public function index($isauth=0,$isuser=0)
    {
        if ($isauth==0) {
            $curr['name'] = $this->crumb['']['name'];
        } else if ($isauth==1) {
            $curr['name'] = '未审核';
        } else if ($isauth==2) {
            $curr['name'] = '未通过';
        } else if ($isauth==3) {
            $curr['name'] = '通过';
        }
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'admin/user';
        $apiUser = ApiUsers::getUserList($isuser,$isauth,$this->limit,$pageCurr);
        if ($apiUser['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiUser['data']; $total = $apiUser['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'crumb' => $this->crumb,
            'curr' => $curr,
            'isusers' => $this->isusers,
            'isuser' => $isuser,
            'isauth' => $isauth,
        ];
        return view('admin.user.index', $result);
    }

//    public function create()
//    {
//        $curr['name'] = $this->crumb['create']['name'];
//        $curr['url'] = $this->crumb['create']['url'];
//        $result = [
//            'crumb'=> $this->crumb,
//            'curr'=> $curr,
//        ];
//        return view('admin.user.create', $result);
//    }
//
//    public function store(Request $request)
//    {
//        $data = $request->all();
//        $rstUser = ApiUsers::doRegist($data);
//    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $rstUser = ApiUsers::getOneUser($id);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        if (in_array($rstUser['data']['isuser'],[2,4,50])) {
            $rstPerson = ApiPerson::getPersonInfo($id);
            $personArr = $rstPerson['code']==0?$rstPerson['data']:[];
        } elseif(in_array($rstUser['data']['isuser'],[3,5,6,7,50])) {
            $rstCompany = ApiCompany::getOneCompany($id);
            $companyArr = $rstCompany['code']==0?$rstCompany['data']:[];
        }
        $result = [
            'data'=> $rstUser['data'],
            'personArr'=> isset($personArr) ? $personArr : [],
            'companyArr'=> isset($companyArr) ? $companyArr : [],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.user.show', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiUser = ApiUsers::getOneUser($id);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiUser['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.user.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'id'    =>  $id,
            'username'  =>  $request->username,
            'email' =>  $request->email,
            'qq'    =>  $request->qq,
            'tel'   =>  $request->tel,
            'mobile'    =>  $request->mobile,
            'address'   =>  $request->address,
            'area'      =>  AreaIdByName($request->areaName),
        ];
        $apiUser = ApiUsers::modify($data);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/user');
    }





    /**
     * 通过认证 isauth==3
     */
    public function toauth($id)
    {
        $apiUser = ApiUsers::setAuth($id,3);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/user');
    }
    /**
     * 拒绝通过认证 isauth==2
     */
    public function noauth($id)
    {
        $rstUser = ApiUsers::setAuth($id,2);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/user');
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiModel = ApiUsers::getModel();
        return $apiModel['code']==0 ? $apiModel['data'] : [];
    }
}