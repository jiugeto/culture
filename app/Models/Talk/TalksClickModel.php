<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class TalksClickModel extends BaseModel
{
    protected $table = 'bs_talks_click';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}