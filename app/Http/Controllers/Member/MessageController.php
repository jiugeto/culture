<?php
namespace App\Http\Controllers\Member;

use App\Models\Base\MessageModel;
use App\Models\Base\UserFrieldModel;
use App\Models\UserModel;
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
//        $this->lists['create']['name'] = '新的消息';
        $this->model = new MessageModel();
    }

    /**
     * 消息列表：收件箱
     */
    public function index($list=1)
    {
        $curr['name'] = $this->lists['']['name'];
        $curr['url'] = $this->lists['']['url'];
        //假如没有聊天对象，给个默认值
        $frield = UserFrieldModel::where('uid',$this->userid)
            ->orWhere('frield_id',$this->userid)
            ->where('del',0)
            ->where('isauth',3)
            ->first();
        if ($frield && $frield->uid==$this->userid) {
            $frieldId = $frield->frield_id;
        } elseif ($frield && $frield->frield_id==$this->userid) {
            $frieldId = $frield->uid;
        }
        $result = [
            'datas' => $this->query($list),
            'prefix_url' => DOMAIN.'member/message',
            'lists' => $this->lists,
            'curr' => $curr,
            'list' => $list,
            'frieldId' => isset($frieldId)?$frieldId:0,
        ];
        return view('member.message.index', $result);
    }

    /**
     * 即时聊天单独窗口
     */
    public function chatList($chat=0)
    {
        $chatModel = UserModel::find($chat);
        $frieldModels = UserFrieldModel::where('uid',$this->userid)
            ->orWhere('frield_id',$this->userid)
            ->where('del',0)
            ->where('isauth',3)
            ->get();
        $messageModel = MessageModel::where('genre2',2)
            ->where('sender',$this->userid)
            ->where('accept',$chat)
            ->where('status',3)
            ->first();
        if ($messageModel) {
            //接收时间
            MessageModel::where('id',$messageModel->id)->update(['acceptTime'=> time()]);
            //获取最新数据
            $message = MessageModel::find($messageModel->id);
            //更新状态
            MessageModel::where('id',$messageModel->id)->update(['status'=> 4]);
            $message = json_decode(json_encode($message),true);
        }
        $result = [
            'chat' => $chatModel?$chatModel:'',
            'frields' => count($frieldModels)?$frieldModels:[],
            'message' => isset($message)?:'',
        ];
//        if (Redis::exists('chatList')) {
//            $msgArr = unserialize(Redis::get('chatList'));
//        }
//        dd($msgArr);
        return view('layout.chatList', $result);
    }

    /**
     * 聊天窗口显示的信息
     */
    public function getLastMsg()
    {
        if (AjaxRequest::ajax()) {
            $data = Input::all();
            if (!$data['uid'] || !$data['chat_uid']) {
                $rstArr = [
                    'err' =>  [
                        'code'  =>  -1,
                        'msg'   =>  '数据有误！',
                    ],
//                    'data'  =>  [],
                ];
                echo json_encode($rstArr);exit;
            }
//            Redis::setex('chatList',60,serialize('000'));
//            dd(Redis::get('chatList'),11);
            if (Redis::exists('chatList')) {
                $msgArr = unserialize(Redis::get('chatList'));
            }
            $msg = MessageModel::where('genre2',2)
                ->where('sender',$data['uid'])
                ->where('accept',$data['chat_uid'])
                ->where('status',3)
                ->first();
            if ($msg) {
                //接收时间
                MessageModel::where('id',$msg->id)->update(['acceptTime'=> time()]);
                //获取最新数据
                $message = MessageModel::find($msg->id);
                //更新状态
                MessageModel::where('id',$msg->id)->update(['status'=> 4]);
            }
            if (isset($message) && $message->id) {
                $msg = json_decode(json_encode($message),true);
                $msgArr[] = $msg;
                Redis::setex('chatList',3600,serialize($msgArr));
                $rstArr = [
                    'err' =>  [
                        'code'  =>  0,
                        'msg'   =>  '获取成功！',
                    ],
                    'data'  => $msg,
                ];
            } else {
                $rstArr = [
                    'err' =>  [
                        'code'  =>  -2,
                        'msg'   =>  '没有数据！',
                    ],
                    'data'  =>  [],
                ];
            }
            echo json_encode($rstArr);exit;
        }
    }

    /**
     * 聊天窗口发送的信息
     */
    public function insertMsg()
    {
        if (AjaxRequest::ajax()) {
            $data = Input::all();
            if (!$data['uid'] || !$data['chat_uid'] || !$data['content']) {
                $rstArr = [
                    'error' =>  [
                        'code'  =>  -1,
                        'msg'   =>  '数据有误！',
                    ],
                    'data'  =>  [],
                ];
                echo json_encode($rstArr);exit;
            }
            $msg = [
//                'title' =>  '在线聊天',
                'genre2'    =>  2,      //genre2代表在线消息
                'intro' =>  trim($data['content']),
                'sender'    =>  $data['uid'],
                'senderTime'    =>  time(),
                'accept'    =>  $data['chat_uid'],
                'status'    =>  3,
                'created_at'    =>  time(),
            ];
            MessageModel::create($msg);
            $rstArr = [
                'error' =>  [
                    'code'  =>  0,
                    'msg'   =>  '添加成功！',
                ],
//                'data'  => [],
            ];
            echo json_encode($rstArr);exit;
        }
    }





    public function query($list)
    {
        //$list==1收件箱，==2发件箱
        if ($list==1) {
            $datas = MessageModel::where('del',0)
                ->where('accept',$this->userid)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        } elseif ($list==2) {
            $datas = MessageModel::where('del',0)
                ->where('sender',$this->userid)
                ->orderBy('id','desc')
                ->paginate($this->limit);
        }
        $datas->limit = $this->limit;
        return $datas;
    }
}