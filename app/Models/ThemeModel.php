<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class ThemeModel extends BaseModel
{
    protected $table = 'bs_theme';
    protected $fillable = [
        'id','name','intro','sort','isshow','created_at','updated_at',
    ];
}