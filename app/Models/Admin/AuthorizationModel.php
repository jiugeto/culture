<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AuthorizationModel extends Model
{
    protected $table = 'bs_authorizations';
    protected $fillable = [
        'id','uid','level_id','created_at','updated_at',
    ];

    /**
     * 关联用户等级：得到所有权限
     */
    public function levels()
    {
        return $this->belongsToMany('App\Models\Admin\UserLevelModel');
    }

    /**
     * uid 得到 level_id
     */
    public function getLevelId($uid)
    {
        $level_id = 0;
        $levels = AuthorizationModel::all();
        foreach ($levels as $level) {
            if ($uid==$level->uid) {
                $level_id = $level->level_id;
            }
        }
        return $level_id;
    }

    /**
     * 得到所有 level_id
     */
    public function LevelIds()
    {
        $levelIds = [];
        $levels = AuthorizationModel::all();
        foreach ($levels as $level) {
            $levelIds[] = $level->level_id;
        }
        return $levelIds;
    }

    /**
     * level_id 得到 func_id
     */
    public function getfuncId($level_id)
    {
        $funcIds = [];
        $authFuncs = AuthFuncModel::all();
        foreach ($authFuncs as $authFunc) {
            if ($level_id==$authFunc->uid) {
                $funcIds[] = $authFunc->level_id;
            }
        }
        return $funcIds;
    }

    /**
     * 关联用户等级：得到该等级用户的功能 ids
     */
    public function getFuncs()
    {
        $funcIds = [];
        if ($levelIds = $this->levelIds()) {
            foreach ($levelIds as $levelId) {
                $funcIds = $this->getfuncId($levelId);
            }
        }
        return $funcIds;
    }
}