<?php
namespace App\Models\Base;

class UserTipModel extends BaseModel
{
    /**
     * 这是用户红包表
     */

    protected $table = 'bs_user_tip';
    protected $fillable = [
        'id','uid','type','tip','created_at','updated_at',
    ];
    protected $types = [
        1=>'新人红包',
    ];

    /**
     * 用户名称
     */
    public function getUName()
    {
        return $this->getUserName($this->uid);
    }

    public function getTypeName()
    {
        return array_key_exists($this->type,$this->types) ? $this->types[$this->type] : '';
    }
}