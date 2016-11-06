<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class TalksThankModel extends BaseModel
{
    protected $table = 'bs_talks_thank';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}