<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;
//use App\Models\ProductAttrModel;

class ProductModel extends BaseModel
{
    protected $table = 'bs_products';
    protected $fillable = [
        'id','name','genre','gif','intro','uid','uname','width','height','isattr','isauth','istop','sort','isshow','del','created_at','updated_at',
    ];
    protected $genres = [
        1=>'个人','企业',
    ];
    protected $isauths = [
        1=>'未审核','未通过审核','通过审核',
    ];
    protected $istops = [
        1=>'不置顶','置顶',
    ];
    protected $isshows = [
        1=>'不显示','显示',
    ];

    public function genre()
    {
        return $this->genre ? $this->genres[$this->genre] : '';
    }
    public function isauth()
    {
        return $this->isauth ? $this->isauths[$this->isauth] : '';
    }
    public function istop()
    {
        return $this->istop ? $this->istops[$this->istop] : '';
    }
    public function isshow()
    {
        return $this->isshow ? $this->isshows[$this->isshow] : '';
    }
}