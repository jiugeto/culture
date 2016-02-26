<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class MessageModel extends BaseModel
{
    protected $table = 'bs_message';
    protected $fillable = [
        'id','title','genre','type','content','sender','sender_time','accept','accept_time','status','del','created_at','updated_at',
    ];
}