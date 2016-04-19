<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class TalksCollectModel extends BaseModel
{
    protected $table = 'bs_talks_collect';
    protected $fillable = [
        'id','talkid','collectid','created_at',
    ];
}