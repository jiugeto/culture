<?php
namespace App\Models\Base;

class MessageModel extends BaseModel
{
    protected $table = 'bs_message';
    protected $fillable = [
        'id','title','genre','genre2','intro','sender','senderTime','accept','acceptTime','status','del','created_at','updated_at',
    ];

    protected $genres = [
        1=>'个人消息','企业消息',
    ];
    protected $genre2s = [
        1=>'离线消息','在线消息',
    ];
    //1未发送，2已发送未接收，3已接收未读，4已读
    protected $statuss = [
        1=>'未发送','已发送未接收','已接收未读','已读',
    ];

    public function getTitle()
    {
        return $this->title ? $this->title : '/';
    }

    public function getGenreName2()
    {
        return $this->genre2s[$this->genre2];
    }

    public function senderName()
    {
        $sender = $this->sender ? $this->sender : 0;
        return $this->getUser($sender) ? $this->getUser($sender)->username : '';
    }

    public function acceptName()
    {
        $accept = $this->accept ? $this->accept : 0;
        return $this->getUser($accept) ? $this->getUser($accept)->username : '';
    }

    public function senderTime()
    {
        return $this->senderTime ? date('Y年m月d日 H:i',$this->senderTime) : '未发送';
    }

    public function acceptTime()
    {
        return $this->acceptTime ? date('Y年m月d日 H:i',$this->acceptTime) : '未接收';
    }

    public function statusName()
    {
        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '';
    }
}