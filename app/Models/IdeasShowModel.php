<?php
namespace App\Models;

class IdeasShowModel extends BaseModel
{
    /**
     * 这是创意查看权限表 model
     */

    protected $table = 'bs_ideas_show';
    protected $fillable = [
        'id','ideadid','uid','created_at',
    ];
}