<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class ThemeTalkModel extends BaseModel
{
    protected $table = 'bs_theme_talk';
    protected $fillable = [
        'id','talkid','themeid','uid','created_at',
    ];
}