<?php
namespace App\Models;

//use Illuminate\Database\Eloquent\Model;

class OrderModel extends BaseModel
{
    /**
     * 用户意见model
     */
    protected $table = 'bs_orders';
    protected $fillable = [
        'id','name','genre','fromid','serial','seller','sellerName','buyer','buyerName','number','status','ideaMoney','storyMoney','realMoney1','realMoney2','realMoney3','realMoney4','isshow','del','created_at','updated_at',
    ];

    protected $genres = [
        1=>'idea','storyboard','goods','entertain','actor','rent',
    ];
    protected $genreNames = [
        1=>'创意','分镜','商品','娱乐','演员','租赁',
    ];

    //视频流程
    //订单状态：1提交创意，确定创意，创意免费，创意收费，创意完成，提交分镜，确定分镜，分镜免费，分镜收费，协商洽谈，开始分期收费，效果协商，二期收费，确定成片，三期收费，出片交付保证播放，尾款结清，交易成功，交易失败，（修改另外收费）
    protected $statuss = [
        1=>'提交创意','确定创意','创意免费','创意收费','创意完成','提交分镜','确定分镜','分镜免费','分镜收费','协商洽谈','开始分期收费','效果协商','二期收费','确定成片','三期收费','出片交付保证播放','尾款结清','交易成功','交易失败','',
    ];
    //娱乐流程
    protected $statuss_e = [];
    //演员流程
    protected $statuss_actor = [];
    //租赁流程
    protected $statuss_rent = [];
}