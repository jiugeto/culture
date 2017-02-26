<?php

namespace App\Http\Controllers\Admin;

use App\Api\ApiBusiness\ApiStaff;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class StaffController extends BaseController
{
    /**
     * 系统后台演员管理
     */

    public function __construct()
    {
        parent::__construct();
        $this->crumb['']['name'] = '员工列表';
        $this->crumb['category']['name'] = '员工管理';
        $this->crumb['category']['url'] = 'staff';
    }

    public function index()
    {
        $curr['name'] = $this->crumb['']['name'];
        $curr['url'] = $this->crumb['']['url'];
        $pageCurr = isset($_POST['pageCurr']) ? $_POST['pageCurr'] : 1;
        $prefix_url = DOMAIN.'admin/staff';
        $datas = $this->query($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'model' => $this->model,
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.staff.index', $result);
    }

    public function create()
    {
        $curr['name'] = $this->crumb['create']['name'];
        $curr['url'] = $this->crumb['create']['url'];
        $result = [
            'model' => $this->getModel(),
            'crumb' => $this->crumb,
            'curr' => $curr,
        ];
        return view('admin.staff.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiStaff = ApiStaff::add($data);
        if ($apiStaff['code']!=0) {
            echo "<script>alert('".$apiStaff['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/staff');
    }

    public function edit($id)
    {
        $curr['name'] = $this->crumb['edit']['name'];
        $curr['url'] = $this->crumb['edit']['url'];
        $apiStaff = ApiStaff::show($id);
        if ($apiStaff['code']!=0) {
            echo "<script>alert('".$apiStaff['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiStaff['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.staff.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = $this->getData($request);
        $data['id'] = $id;
        $apiStaff = ApiStaff::modify($data);
        if ($apiStaff['code']!=0) {
            echo "<script>alert('".$apiStaff['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'admin/staff');
    }

    public function show($id)
    {
        $curr['name'] = $this->crumb['show']['name'];
        $curr['url'] = $this->crumb['show']['url'];
        $apiStaff = ApiStaff::show($id);
        if ($apiStaff['code']!=0) {
            echo "<script>alert('".$apiStaff['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiStaff['data'],
            'model'=> $this->getModel(),
            'crumb'=> $this->crumb,
            'curr'=> $curr,
        ];
        return view('admin.staff.show', $result);
    }

    public function destroy($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 1]);
        return redirect(DOMAIN.'admin/staff');
    }

    public function restore($id)
    {
        StaffModel::where('id',$id)->update(['del'=> 0]);
        return redirect(DOMAIN.'admin/staff');
    }

    public function forceDelete($id)
    {
        StaffModel::where('id',$id)->delete();
        return redirect(DOMAIN.'admin/staff');
    }




    public function query($pageCurr)
    {
        $apiStaff = ApiStaff::index($this->limit,$pageCurr,0,0,0,0,0);
        return $apiStaff['code']==0 ? $apiStaff['data'] : [];
    }

    public function getData(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('发方人填写错误！');history.go(-1);</script>";exit;
        }
        $userType = $apiUser['data']['isuser'];
        if ($userType==6) {
            $genre = 1;     //供应：影视公司
        } else {
            $genre = 2;     //需求
        }
        if (!$request->hobby) {
            echo "<script>alert('请选择兴趣！');history.go(-1);</script>";exit;
        }
        return array(
            'name'      =>  $request->name,
            'sex'       =>  $request->sex,
            'realname'  =>  $request->realname,
            'origin'    =>  $request->origin,
            'edu' =>  $request->education,
            'school'    =>  $request->school,
            'hobby'     =>  implode(',',$request->hobby),
            'height'    =>  $request->height,
            'type'      =>  $request->type,
            'genre'     =>  $genre,
            'uid'       =>  $apiUser['data']['id'],
        );
    }

    /**
     * 获取 model
     */
    public function getModel()
    {
        $apiStaff = ApiStaff::getModel();
        return $apiStaff['code']==0 ? $apiStaff['model'] : [];
    }
}