<?php
namespace App\Models\Home;

class SearchKeywordModel extends \App\Models\BaseModel
{
    /**
     * 搜索表
     */

    protected $table = 'bs_search_keyword';
    protected $fillable = [
        'id','search_id','keyword','rate','created_at','updated_at',
    ];
}