<?php
namespace App\Http\Controllers\Company\Admin;

use App\Models\Base\AreaModel;
use App\Models\CompanyModel;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    /**
     * 企业开展后台，招聘管理
     */

    protected $curr_url = 'contact';

    public function __construct()
    {
        parent::__construct();
        $this->lists['category']['name'] = '内容设置';
        $this->lists['category']['url'] = 'content';
        $this->lists['func']['name'] = '联系编辑';
        $this->lists['func']['url'] = 'contact';
    }

    public function index()
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> $this->query(),
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.contact.index', $result);
    }

    public function edit($id)
    {
        $curr['name'] = $this->lists['edit']['name'];
        $curr['url'] = $this->lists['edit']['url'];
        $data = CompanyModel::find($id);
        if ($data->tel) {}
        $result = [
            'data'=> $data,
            'lists'=> $this->lists,
            'curr'=> $curr,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.contact.edit', $result);
    }

    public function update(Request $request,$id)
    {
        $data = [
            'areacode'=> $request->areacode,
            'tel'=> $request->tel,
            'qq'=> $request->qq,
            'web'=> $request->web,
            'fax'=> $request->fax,
            'zipcode'=> $request->zipcode,
            'email'=> $request->email,
            'address'=> $request->address,
        ];
        CompanyModel::where('id',$id)->update($data);
        return redirect(DOMAIN.'company/admin/contact');
    }

    /**
     * 地图页面
     */
    public function map()
    {
        $company = CompanyModel::find(\Session::get('user.cid'));
        $key = 'Tj1ciyqmG0quiNgpr0nmAimUCCMB5qMk';      //自己申请的百度地图api的key
        if ($company->point) {
            $pointer = explode(',',$company->point);
            $point['lng'] = $pointer[0];
            $point['lat'] = $pointer[1];
        } else {
            $point = $this->getPoint($company->area,$company->address,$key);
        }
        $result = [
            'pointer'=> $point,
            'data'=> $company,
            'ak'=> $key,
            'curr_func' => $this->lists['func']['url'],
        ];
        return view('company.admin.contact.map', $result);
    }

    /**
     * 得到模糊坐标
     */
    public function getPoint($area,$address,$key)
    {
        //百度地图接口：http://api.map.baidu.com/geocoder/v2/address=地址&output=输出格式类型&key=用户密钥&city=城市名
        //需要4个参数：address详细地址，output格式，ak接口密匙，city城市名
        //地区转换
//        $areaModel = AreaModel::find($area);
//        $areaname = $areaModel ? $areaModel->cityname : '';
        $cityModel = new AreaModel();
        $areaname = $area ? $cityModel->getAreaName($area) : '';
        //请求接口，返回数据
        $apiUrl = 'http://api.map.baidu.com/geocoder/v2/';
        $curl = new \Curl\Curl();
        $curl->setHeader('X-Authorization', $key);
        $curl->get($apiUrl, array(
            'address'=> $address,
            'output'=> 'json',
            'ak'=> $key,
            'city'=> $areaname,
        ));
        $response = json_decode($curl->response);
        $response = \App\Tools::objectToArray($response);
        if ($response['status'] != 0) {
            if ($response['status']==1) { echo "<script>alert('地址有误或百度地图服务器内部有变！');history.go(-1);</script>";exit; }
            elseif ($response['status']==2) { echo "<script>alert('地区或地址有误！');history.go(-1);</script>";exit; }
            elseif ($response['status']==3) { echo "<script>alert('权限校验失败！');history.go(-1);</script>";exit; }
            elseif ($response['status']==4) { echo "<script>alert('配额校验失败！');history.go(-1);</script>";exit; }
            elseif ($response['status']==5) { echo "<script>alert('百度地图密匙错误！');history.go(-1);</script>";exit; }
            elseif ($response['status']==101) { echo "<script>alert('服务禁用！');history.go(-1);</script>";exit; }
            elseif ($response['status']==102) { echo "<script>alert('百度地图密匙权限不足！');history.go(-1);</script>";exit; }
            elseif ($response['status']=="2xx") { echo "<script>alert('无权限！');history.go(-1);</script>";exit; }
            elseif ($response['status']=="3xx") { echo "<script>alert('配额错误！');history.go(-1);</script>";exit; }
        }
        return $response['result']['location'];
    }

    /**
     * 得到精确坐标，写入数据库
     */
    public function setPoint($x,$y)
    {
        if (!$x || !$y) { echo "<script>alert('未成功获取坐标！');</script>";exit; }
        $point = $x.','.$y;
        CompanyModel::where('id',\Session::get('user.cid'))->update(['point'=> $point, 'updated_at'=> time()]);
        return redirect(DOMAIN.'company/admin/contact/map');
    }





    public function query()
    {
        return CompanyModel::where('uid',$this->userid)->first();
    }
}