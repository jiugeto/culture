<?php
namespace App\Http\Controllers\Member;

use App\Api\ApiBusiness\ApiMessage;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;
use Redis;

class MessageController extends BaseController
{
    /**
     * 会员后台消息管理
     */

    protected $genre;

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '消息管理';
        $this->lists['func']['url'] = 'message';
    }

    public function index($list=1)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        $pageCurr = isset($_GET['page'])?$_GET['page']:1;
        if ($list==1) {
            $prefix_url = DOMAIN.'member/message';
        } else {
            $prefix_url = DOMAIN.'member/message/s/'.$list;
        }
        $status = $list==1 ? [3,4] : 2;
        $apiMsg = ApiMessage::index($this->limit,$pageCurr,$this->userid,$list,$status,2,0);
        if ($apiMsg['code']!=0) {
            $datas = array(); $total = 0;
        } else {
            $datas = $apiMsg['data']; $total = $apiMsg['pagelist']['total'];
        }
        $pagelist = $this->getPageList($total,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => $prefix_url,
            'lists' => $this->lists,
            'curr' => $curr,
            'list' => $list,
        ];
        return view('member.message.index', $result);
    }

    public function store(Request $request)
    {
        $apiUser = ApiUsers::getOneUserByUname($request->accept);
        if ($apiUser['code']!=0) {
            echo "<script>alert('".$apiUser['msg']."');history.go(-1);</script>";exit;
        }
        $data = [
            'title' =>  $request->title,
            'intro' =>  $request->intro,
            'sender'    =>  $this->userid,
            'accept'    =>  $apiUser['data']['id'],
            'status'    =>  2,      //发送
        ];
        $apiMsg = ApiMessage::add($data);
        if ($apiMsg['code']!=0) {
            echo "<script>alert('".$apiMsg['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'member/message');
    }
}