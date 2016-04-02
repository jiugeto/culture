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
        'id','title','content','pic','uid','from_type','from_id','status','remarks','reply_id','isshow','del','created_at',
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
        if ($this->reply_id) {
            $replys = explode(',',$this->reply_id);
        }
        return isset($replys) ? count($replys) : 0;
    }
}