<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'bs_message';
    public $timestamps = false;
    protected $fillable = [
        'id','title','genre','type','content','sender','sender_time','accept','accept_time','status','del','created_at','updated_at',
    ];
}