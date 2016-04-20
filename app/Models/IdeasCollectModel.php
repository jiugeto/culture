<?php
namespace App\Models;

class IdeasCollectModel extends BaseModel
{
    /**
     * 这是创意收集表 model
     */

    protected $table = 'bs_ideas_collect';
    protected $fillable = [
        'id','ideadid','collectid','uid','otherid','created_at',
    ];
}