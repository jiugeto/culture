<?php
namespace App\Models\Talk;

use App\Models\BaseModel;

class TalksReportModel extends BaseModel
{
    protected $table = 'bs_talks_report';
    protected $fillable = [
        'id','talkid','uid','created_at',
    ];
}