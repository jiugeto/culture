<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class RentModel extends BaseModel
{
    protected $table = 'bs_rents';
    protected $fillable = [
        'id','name','genre','intro','uid','price','sort','del','created_at','updated_at',
    ];

    /**
     * id 找 pics
     */
    public function pics($arrs)
    {
        $pics = [];
        $pic = 0;
        if (is_array($arrs)) {
            foreach ($arrs as $arr) {
                $pic_id = RentPicModel::find($arr->id)->pic_id;
                $pics[] = PicModel::find($pic_id);
            }
        }
        return $pics;
    }
}