<?php
namespace App\Http\Controllers\Person;

use App\Api\ApiBusiness\ApiMessage;
use App\Api\ApiUser\ApiUsers;
use Illuminate\Http\Request;

class MessageController extends BaseController
{
    /**
     * 个人后台 消息管理
     */

    protected $curr = 'message';

    public function __construct()
    {
        parent::__construct();
    }

    public function index($menu=1)
    {
        //menus==1收件箱，2发件箱
        $pageCurr = isset($_GET['page']) ? $_GET['page'] : 1;
        if ($menu==1) {
            $prefix_url = DOMAIN.'person/message';
        } else {
            $prefix_url = DOMAIN.'person/message/s/'.$menu;
        }
        $apiMsg = ApiMessage::index($this->limit,$pageCurr,$this->userid,$menu,0,2,0);
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
            'curr' => $this->curr,
            'menu' => $menu,
        ];
        return view('person.message.index', $result);
    }

    public function create()
    {
        $result = [
            'curr'=> $this->curr,
        ];
        return view('person.message.create', $result);
    }

    public function store(Request $request)
    {
        $data = $this->getData($request);
        $apiMsg = ApiMessage::add($data);
        if ($apiMsg['code']!=0) {
            echo "<script>alert('".$apiMsg['msg']."');history.go(-1);</script>";exit;
        }
        return redirect(DOMAIN.'person/message/s/2');
    }

    public function show($id)
    {
        $apiMsg = ApiMessage::show($id);
        if ($apiMsg['code']!=0) {
            echo "<script>alert('".$apiMsg['msg']."');history.go(-1);</script>";exit;
        }
        $result = [
            'data'=> $apiMsg['data'],
            'curr'=> $this->curr,
        ];
        return view('person.message.show', $result);
    }





    public function getData(Request $request)
    {
        if (!$request->uname || !$request->title || !$request->intro) {
            echo "<script>alert('消息标题、内容必填！');</script>";exit;
        }
        $apiUser = ApiUsers::getOneUserByUname($request->uname);
        if ($apiUser['code']!=0) {
            echo "<script>alert('无此收件人！');</script>";exit;
        }
        if ($apiUser['data']['id']==$this->userid) {
            echo "<script>alert('不能发送给自己！');</script>";exit;
        }
        if (strlen($request->title)<2 || strlen($request->intro)<2) {
            echo "<script>alert('消息标题、内容不少于2个字符！');</script>";exit;
        }
        return array(
            'title'=> $request->title,
            'intro'=> $request->intro,
            'sender'=> $this->userid,
            'accept'=> $apiUser['data']['id'],
            'status'=> 2,
        );
    }
}