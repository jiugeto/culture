<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class DesignModel extends BaseModel
{
    protected $table = 'bs_designs';
    protected $fillable = [
        'id','name','genre','type_id','uid','intro','price','sort','del','created_at','updated_at',
    ];

    /**
     * 关联设计类型 bs_types
     */
    public function types()
    {
        return $this->belongsToMany('App\Models\TypeModel');
    }

    /**
     * 由 type_id 得到 type_name
     */
    public function getOneType($type_id)
    {
        $type_name = '';
        $types =  $this->types();
        if ($types) {
            foreach ($types as $type) {
                if ($type_id==$type->id) {
                    $type_name = $type->name;
                }
            }
        }
        return $type_name;
    }
}