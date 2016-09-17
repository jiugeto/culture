<?php
namespace App\Models\Base;

class SearchModel extends BaseModel
{
    /**
     * 搜索表
     */

    protected $table = 'bs_search';
    protected $fillable = [
        'id','keyword','genre','rate','created_at','updated_at',
    ];

    //检索条件：1样片，2创意，3分镜，4企业，5影视，6演员，7设备，8设计，
    protected $genres = [
        1=>'样片','创意','分镜','企业','影视','演员','设备','设计',
    ];

    /**
     * 获取热门词汇
     */
    public static function getHotWords()
    {
        return SearchModel::orderBy('rate','desc')->paginate(5);
    }
}