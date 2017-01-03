<?php
namespace App\Models;

class StoryBoardLikeModel extends BaseModel
{
    /**
     * 分镜喜欢
     */
    protected $table = 'bs_storyboard_like';
    protected $fillable = [
        'id','sbid','uid','created_at',
    ];
}