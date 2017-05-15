<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiOrder;
use App\Api\ApiUser\ApiCompany;
use App\Api\ApiUser\ApiUsers;

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
        return view('member.home.index', $result);
    }





    public function user()
    {
        $uid = $this->userid ? $this->userid : 0;
        $rstUser = ApiUsers::getOneUser($uid);
        return $rstUser['code']==0 ? $rstUser['data'] : [];
    }

    public function company()
    {
        $uid = $this->userid ? $this->userid : 0;
        $rstCompany = ApiCompany::getOneCompany($uid);
        return $rstCompany['code']==0 ? $rstCompany['data'] : [];
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
                if ($v=$user[$field]) { $userNum[] = $field; }
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
        $company = $this->company();
        if (!$company) {
            return array(
                'company'   =>  array(),
                'data'      =>  array(),
                'field'     =>  array(),
                'per'       =>  0,
            );
        }
        $fields = ['name','genre','area','address','yyzzid','areacode','tel','qq','web','fax','zipcode','email','logo',];
        $companyNum = array();
        $companyMainNum = array();
        foreach ($fields as $field) {
            if ($v=$company[$field]) { $companyNum[] = $field; }
        }
        if ($companyInfo['company'] = $this->company()) {
            $companyInfo['company']['areaName'] = AreaNameByid($this->company()['area']);
        } else {
            $companyInfo['company']['areaName'] = '';
        }
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
        $apiOrder = ApiOrder::getOrdersByUid($this->userid,0);
        $apiOrderSuccess = ApiOrder::getOrdersByUid($this->userid,[12,13]);
        $orders = $apiOrder['code']==0 ? $apiOrder['data'] : [];
        $orderSuccess = $apiOrderSuccess['code']==0 ? $apiOrderSuccess['data'] : [];
        $orderInfo['order'] = $orders;
        $orderInfo['per'] = count($orders) ? intval(count($orderSuccess)/count($orders)*100) : 0;
        return $orderInfo;
    }
}