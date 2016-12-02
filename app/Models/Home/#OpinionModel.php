<?php
namespace App\Models\Home;

class OpinionModel extends \App\Models\Base\BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_opinions';
    protected $fillable = [
        'id','name','intro','uid','status','remarks','gold1','gold2','isshow','created_at','updated_at',
    ];
    protected $statuss = [
        '所有','新意见','处理中','不满意','满意',
    ];

    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function status()
    {
        return array_key_exists($this->status,$this->statuss) ? $this->statuss[$this->status] : '';
    }
}