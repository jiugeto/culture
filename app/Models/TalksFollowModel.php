<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksFollowModel extends BaseModel
{
    protected $table = 'bs_talks_follow';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}