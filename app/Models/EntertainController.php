<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntertainModel extends Model
{
    protected $table = 'bs_entertains';
    protected $fillable = [
        'title','content','uid','created_at','updated_at',
    ];
}