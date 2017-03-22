<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiOnline\ApiOrderPro;
use Illuminate\Http\Request;

class OrderProductController extends BaseController
{
    /**
     *  会员后台 订单流程管理
     */

    public function __construct()
    {
        parent::__construct();
        //面包屑处理
        $this->lists['func']['name'] = '创作订单';
        $this->lists['func']['url'] = 'orderpro';
    }

    public function index()
    {
        $curr['name'] = $this->lists['']['name'] = '创作订单';
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        $prefix_url = DOMAIN.'member/orderpro';
        $datas = $this->query($pageCurr);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'prefix_url' => $prefix_url,
            'pagelist' => $pagelist,
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.orderpro.index', $result);
    }

    public function show($id)
    {
        $curr['name'] = $this->lists['show']['name'];
        $curr['url'] = $this->lists['show']['url'];
        $result = [
            'data'=> OrderProductModel::find($id),
            'lists'=> $this->lists,
            'curr'=> $curr,
        ];
        return view('member.orderpro.show', $result);
    }

    public function destroy($id)
    {
        OrderProductModel::where('id',$id)->update(['isshow'=> 1]);
        return redirect(DOMAIN.'member/orderpro');
    }

    /**
     * 设置评价、返利
     */
    public function setComment($id,$comment,$backGold)
    {
        if ($comment==0) {
            $status = 6;
        } elseif ($comment==1) {
            $status = 7;
        }
        OrderProductModel::where('id',$id)->where('status',5)->update(['status'=> $status]);
        //金币返利
        if ($comment && $backGold) {
            UserGoldModel::setGold($this->userid,4,$backGold);
            WalletModel::where('uid',$this->userid)->increment('gold',$backGold);
        }
        return redirect(DOMAIN.'member/orderpro');
    }






    public function query($pageCurr)
    {
        $uid = $this->userType==50 ? 0 : $this->userid;
        $apiOrder = ApiOrderPro::index($this->limit,$pageCurr,$uid,0,2,0);
        return $apiOrder['code']==0 ? $apiOrder['data'] : [];
    }
}