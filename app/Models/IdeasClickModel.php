<?php
namespace App\Models;

class IdeasClickModel extends BaseModel
{
    /**
     * 这是创意点赞表 model
     */

    protected $table = 'bs_ideas_click';
    protected $fillable = [
        'id','ideadid','clickid','uid','otherid','created_at',
    ];
}