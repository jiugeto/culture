<?php
namespace App\Http\Controllers\Member;

use App\Models\Company\ComMainModel;
use App\Models\CompanyModel;
use App\Models\OrderModel;
use App\Models\UserModel;

class HomeController extends BaseController
{
    /**
     * 会员后台首页
     */

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '账户首页';
        $this->lists['func']['url'] = '';
    }

    public function index()
    {
        $result = [
            'lists'=> $this->lists,
            'userInfo'=> $this->userInfo(),
            'companyInfo'=> $this->companyInfo(),
            'orderInfo'=> $this->orderInfo(),
            'curr_list'=> 'member',
        ];
//        dd($this->userInfo(),$this->companyInfo());
        return view('member.home.index', $result);
    }





    public function user()
    {
        $uid = $this->userid ? $this->userid : 0;
        return $uid ? UserModel::find($uid) : '';
    }

    public function company()
    {
        $uid = $this->userid ? $this->userid : 0;
        return $uid ? CompanyModel::where('uid',$uid)->first() : '';
    }

    public function companyMain()
    {
        $uid = $this->userid ? $this->userid : 0;
        return $uid ? ComMainModel::where('uid',$uid)->first() : '';
    }

    /**
     * 用户资料百分比
     */
    public function userInfo()
    {
        $fields = ['username','email','qq','tel','mobile',];
        $userNum = array();
        if ($user=$this->user()) {
            foreach ($fields as $field) {
                if ($v=$user->$field) { $userNum[] = $field; }
            }
        }
        $userInfo['user'] = $this->user();
        $userInfo['data'] = isset($userNum) ? $userNum : [];
        $userInfo['field'] = $fields;
        $userInfo['per'] = intval(count($userInfo['data'])/count($userInfo['field'])*100);
        return $userInfo;
    }

    /**
     * 公司资料百分比
     */
    public function companyInfo()
    {
        $field1s = ['name','genre','area','address','yyzzid','areacode','tel','qq','web','fax','zipcode','email',];
        $field2s = ['title','keyword','description','logo',];
        $fields = array_merge($field1s,$field2s);
        $companyNum = array(); $companyMainNum = array();
        if ($company=$this->company()) {
            foreach ($field1s as $field1) {
                if ($v=$company->$field1) { $companyNum[] = $field1; }
            }
        }
        if ($companyMain=$this->companyMain()) {
            foreach ($field2s as $field2) {
                if ($v=$companyMain->$field2) { $companyMainNum[] = $field2; }
            }
        }
        $companyInfo['company'] = $this->company();
        $companyInfo['compMain'] = $this->companyMain();
        $companyInfo['data'] = array_merge($companyNum,$companyMainNum);
        $companyInfo['field'] = $fields;
        $companyInfo['per'] = intval(count($companyInfo['data'])/count($companyInfo['field'])*100);
        return $companyInfo;
    }

    /**
     * 成功订单百分比
     */
    public function orderInfo()
    {
        $uid = $this->userid ? $this->userid : 0;
        $orders = OrderModel::where('buyer',$uid)->get();
        $orderSuccess = OrderModel::where('buyer',$uid)->where('status','>',11)->get();
        $orderInfo['order'] = $orders;
        $orderInfo['per'] = count($orders) ? intval(count($orderSuccess)/count($orders)*100) : 0;
        return $orderInfo;
    }
}