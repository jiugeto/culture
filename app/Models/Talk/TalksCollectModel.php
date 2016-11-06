<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class TalksCollectModel extends BaseModel
{
    protected $table = 'bs_talks_collect';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}