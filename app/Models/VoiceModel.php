<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoiceModel extends Model
{
    protected $table = 'bs_user_voice';
    public $timestamps = false;
    protected $fillable = [
        'id','title','uid','content','isshow','created_at',
    ];
}