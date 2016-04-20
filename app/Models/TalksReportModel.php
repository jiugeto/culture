<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksReportModel extends BaseModel
{
    protected $table = 'bs_talks_report';
    protected $fillable = [
        'id','talkid','reportid','uid','otherid','created_at',
    ];
}