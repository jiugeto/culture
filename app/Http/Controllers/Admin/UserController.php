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
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'admin/user';
        $result = [
            'datas'=> $this->query($isuser,$isauth,$pageCurr,$prefix_url),
            'prefix_url'=> $prefix_url,
            'crumb'=> $this->crumb,
            'curr'=> $curr,
            'isusers'=> $this->isusers,
            'isuser'=> $isuser,
            'isauth'=> $isauth,
        ];
        return view('admin.user.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.user.create', $result);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);
        $rstUser = ApiUsers::doRegist($data);
    }

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
        $rstUser = ApiUsers::getOneUser($id);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $rstUser['data'],
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.user.edit', $result);
    }

    public function update(Request $request,$id)
    {
//        UserModel::where('id',$id)->update(['limit'=> $request->limit]);
        $data = $request->all();
        $data['id'] = $id;
        dd($data);
        return redirect(DOMAIN.'admin/user');
    }





    /**
     * 通过认证 isauth==3
     */
    public function toauth($id)
    {
//        UserModel::where('id',$id)->update(['isauth'=> 3]);
        $rstUser = ApiUsers::setAuth($id,3);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/user');
    }
    /**
     * 拒绝通过认证 isauth==2
     */
    public function noauth($id)
    {
//        UserModel::where('id',$id)->update(['isauth'=>2]);
        $rstUser = ApiUsers::setAuth($id,2);
        if ($rstUser['code']!=0) {
            echo "<script>alert('".$rstUser['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/user');
    }

    public function query($isuser,$isauth,$pageCurr,$prefix_url)
    {
        $rst = ApiUsers::getUserList($isuser,$isauth,$this->limit,$pageCurr);
        $datas = $rst['code']==0 ? $rst['data'] : [];
        $datas['pagelist'] = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        return $datas;
    }

//    /**
//     * +1 increase
//     */
//    public function increase($id)
//    {
//        UserModel::where('id', $id)->increment('limit', 1);
//        return redirect('/admin/user');
//    }
//
//    /**
//     * +1 increase
//     */
//    public function reduce($id)
//    {
//        UserModel::where('id', $id)->increment('limit', -1);
//        return redirect('/admin/user');
//    }
//
//    /**
//     * 修改limit
//     */
//    public function limit($id,$limit)
//    {
//        UserModel::where('id', $id)->update(['limit'=>$limit]);
//        return redirect('/admin/user');
//    }
}