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
}