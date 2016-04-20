<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksThankModel extends BaseModel
{
    protected $table = 'bs_talks_thank';
    protected $fillable = [
        'id','talkid','thankid','uid','otherid','created_at',
    ];
}