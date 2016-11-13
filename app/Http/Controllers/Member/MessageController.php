<?php
namespace App\Http\Controllers\Member;

use App\Models\Base\MessageModel;
use Illuminate\Support\Facades\Request as AjaxRequest;
use Illuminate\Support\Facades\Input;

class MessageController extends BaseController
{
    /**
     * 会员后台消息管理
     */

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
                    'data'  =>  [],
                ];
                echo json_encode($rstArr);exit;
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
                $rstArr = [
                    'err' =>  [
                        'code'  =>  0,
                        'msg'   =>  '获取成功！',
                    ],
                    'data'  => json_decode(json_encode($message),true),
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
                'title' =>  '在线聊天',
                'genre2'    =>  2,      //genre2代表在线消息
                'intro' =>  $data['content'],
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
}