<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class TalksFollowModel extends BaseModel
{
    protected $table = 'bs_talks_follow';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}