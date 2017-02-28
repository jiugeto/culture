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

    public function __construct()
    {
        parent::__construct();
        $this->lists['func']['name'] = '消息管理';
        $this->lists['func']['url'] = 'message';
    }

    /**
     * 消息列表：收件箱
     */
    public function index($list=1)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
//        //假如没有聊天对象，给个默认值
//        $frield = UserFrieldModel::where('uid',$this->userid)
//            ->orWhere('frield_id',$this->userid)
//            ->where('del',0)
//            ->where('isauth',3)
//            ->first();
//        if ($frield && $frield->uid==$this->userid) {
//            $frieldId = $frield->frield_id;
//        } elseif ($frield && $frield->frield_id==$this->userid) {
//            $frieldId = $frield->uid;
//        }
        $pageCurr = isset($_POST['pageCurr'])?$_POST['pageCurr']:1;
        $prefix_url = DOMAIN.'member/procus';
        $datas = $this->query($pageCurr,$list);
        $pagelist = $this->getPageList($datas,$prefix_url,$this->limit,$pageCurr);
        $result = [
            'datas' => $datas,
            'pagelist' => $pagelist,
            'prefix_url' => DOMAIN.'member/message',
            'lists' => $this->lists,
            'curr' => $curr,
            'list' => $list,
//            'frieldId' => isset($frieldId)?$frieldId:0,
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

//    /**
//     * 即时聊天单独窗口
//     */
//    public function chatList($chat=0)
//    {
//        $chatModel = UserModel::find($chat);
//        $frieldModels = UserFrieldModel::where('uid',$this->userid)
//            ->orWhere('frield_id',$this->userid)
//            ->where('del',0)
//            ->where('isauth',3)
//            ->get();
//        $messageModel = MessageModel::where('genre2',2)
//            ->where('sender',$this->userid)
//            ->where('accept',$chat)
//            ->where('status',3)
//            ->first();
//        if ($messageModel) {
//            //接收时间
//            MessageModel::where('id',$messageModel->id)->update(['acceptTime'=> time()]);
//            //获取最新数据
//            $message = MessageModel::find($messageModel->id);
//            //更新状态
//            MessageModel::where('id',$messageModel->id)->update(['status'=> 4]);
//            $message = json_decode(json_encode($message),true);
//        }
//        $result = [
//            'chat' => $chatModel?$chatModel:'',
//            'frields' => count($frieldModels)?$frieldModels:[],
//            'message' => isset($message)?:'',
//        ];
////        if (Redis::exists('chatList')) {
////            $msgArr = unserialize(Redis::get('chatList'));
////        }
////        dd($msgArr);
//        return view('layout.chatList', $result);
//    }
//
//    /**
//     * 聊天窗口显示的信息
//     */
//    public function getLastMsg()
//    {
//        if (AjaxRequest::ajax()) {
//            $data = Input::all();
//            if (!$data['uid'] || !$data['chat_uid']) {
//                $rstArr = [
//                    'err' =>  [
//                        'code'  =>  -1,
//                        'msg'   =>  '数据有误！',
//                    ],
////                    'data'  =>  [],
//                ];
//                echo json_encode($rstArr);exit;
//            }
////            Redis::setex('chatList',60,serialize('000'));
////            dd(Redis::get('chatList'),11);
//            if (Redis::exists('chatList')) {
//                $msgArr = unserialize(Redis::get('chatList'));
//            }
//            $msg = MessageModel::where('genre2',2)
//                ->where('sender',$data['uid'])
//                ->where('accept',$data['chat_uid'])
//                ->where('status',3)
//                ->first();
//            if ($msg) {
//                //接收时间
//                MessageModel::where('id',$msg->id)->update(['acceptTime'=> time()]);
//                //获取最新数据
//                $message = MessageModel::find($msg->id);
//                //更新状态
//                MessageModel::where('id',$msg->id)->update(['status'=> 4]);
//            }
//            if (isset($message) && $message->id) {
//                $msg = json_decode(json_encode($message),true);
//                $msgArr[] = $msg;
//                Redis::setex('chatList',3600,serialize($msgArr));
//                $rstArr = [
//                    'err' =>  [
//                        'code'  =>  0,
//                        'msg'   =>  '获取成功！',
//                    ],
//                    'data'  => $msg,
//                ];
//            } else {
//                $rstArr = [
//                    'err' =>  [
//                        'code'  =>  -2,
//                        'msg'   =>  '没有数据！',
//                    ],
//                    'data'  =>  [],
//                ];
//            }
//            echo json_encode($rstArr);exit;
//        }
//    }
//
//    /**
//     * 聊天窗口发送的信息
//     */
//    public function insertMsg()
//    {
//        if (AjaxRequest::ajax()) {
//            $data = Input::all();
//            if (!$data['uid'] || !$data['chat_uid'] || !$data['content']) {
//                $rstArr = [
//                    'error' =>  [
//                        'code'  =>  -1,
//                        'msg'   =>  '数据有误！',
//                    ],
//                    'data'  =>  [],
//                ];
//                echo json_encode($rstArr);exit;
//            }
//            $msg = [
////                'title' =>  '在线聊天',
//                'genre2'    =>  2,      //genre2代表在线消息
//                'intro' =>  trim($data['content']),
//                'sender'    =>  $data['uid'],
//                'senderTime'    =>  time(),
//                'accept'    =>  $data['chat_uid'],
//                'status'    =>  3,
//                'created_at'    =>  time(),
//            ];
//            MessageModel::create($msg);
//            $rstArr = [
//                'error' =>  [
//                    'code'  =>  0,
//                    'msg'   =>  '添加成功！',
//                ],
////                'data'  => [],
//            ];
//            echo json_encode($rstArr);exit;
//        }
//    }





    public function query($pageCurr,$list)
    {
        if (in_array($this->userType,[1,2,4])) {
            $genre = 1;     //个人消息
        } elseif (in_array($this->userType,[3,5,6,7])) {
            $genre = 2;     //企业消息
        } else {
            $genre = 0;     //超级消息
        }
        if ($list==1) {
            $status = [3,4];
        } elseif ($list==2) {
            $status = 2;
        }
        $apiMsg = ApiMessage::index($this->limit,$pageCurr,$genre,$status,2,0);
        return $apiMsg['code']==0 ? $apiMsg['data'] : [];
    }
}