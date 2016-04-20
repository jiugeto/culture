<?php
namespace App\Models;

class IdeasReadModel extends BaseModel
{
    /**
     * 这是创意阅读表 model
     */

    protected $table = 'bs_ideas_read';
    protected $fillable = [
        'id','ideadid','readid','uid','otherid','created_at',
    ];
}