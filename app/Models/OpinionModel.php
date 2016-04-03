<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class OpinionModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_opinions';
    protected $fillable = [
        'id','name','intro','pic','uid','status','remarks','isreply','reply','isshow','del','created_at',
    ];
    protected $statuss = [
        1=>'新意见','已查看','处理中','不满意','满意',
    ];

    public function status()
    {
        return $this->statuss[$this->status];
    }

    public function reply()
    {
        return $this->hasOne('\App\Models\OpinionModel','id','reply');
    }

    public function replyModels()
    {
        if ($this->reply) {
            $opinions = OpinionModel::where('id',$this->reply)->get();
        }
        return isset($opinions) ? $opinions : [];
    }
}