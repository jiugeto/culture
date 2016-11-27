<?php
namespace App\Models\Base;

class VideoMakePriceModel extends BaseModel
{
    /**
     * 视频制作估价
     */

//    protected $table = 'bs_video_money';
//    protected $fillable = [
//        'id','uid','clip','effect','model','scene','texture','animate','liquid','sound','render','created_at','updated_at',
//    ];

    //剪辑价位：影视广告每10秒，其他每5分钟
    protected $clips = [
        //难度低=》效果
        1=>100,300,600,
        //难度高=》效果
        11=>200,400,800,
    ];
    //合成价位：影视广告每5秒，其他每分钟
    protected $effects = [
        //难度低=》效果
        1=>100,500,1000,
        //难度中=》效果
        11=>200,600,1200,
        //难度高=》效果
        21=>300,700,1500,
    ];
    //3D模型价位，难度：低中高
    protected $models = [
        1=>200,300,800,
    ];
    //3D场景价位，每个
    protected $scenes = [
        1=>100,700,1500,
    ];
    //3D材质价位
    protected $textures = [
        //难度低=》效果
        1=>100,500,1000,
        //难度高=》效果
        11=>200,800,1500,
    ];
    //3D动画价位：每10秒
    protected $animates = [
        //难度低=》效果
        1=>100,500,1000,
        //难度高=》效果
        11=>200,800,1500,
    ];
    //软体/液体：效果
    protected $liquids = [
        1=>400,800,1500,
    ];
    //背景音：每30秒
    protected $bg_sound = 300;
    //配音
    protected $dub = 800;
}