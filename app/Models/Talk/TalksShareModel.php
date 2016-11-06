<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class TalksShareModel extends BaseModel
{
    protected $table = 'bs_talks_share';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}