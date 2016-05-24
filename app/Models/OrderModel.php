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

    //视频订单状态：1提交创意，确定创意，创意免费，创意收费，创意完成，提交分镜，确定分镜，分镜免费，分镜收费，协商洽谈，开始分期收费，效果协商，二期收费，确定成片，三期收费，出片交付保证播放，尾款结清，交易成功，交易失败，（修改另外收费）
    protected $statuss = [
        1=>'提交创意','确定创意','创意免费','创意收费','创意完成','提交分镜','确定分镜','分镜免费','分镜收费',10=>'确定项目',12=>'开始制作','分期收费','效果协商','二期收费','确定成片','三期收费','出片交付保证播放','尾款结清','交易成功','交易失败',
    ];
    //前台订单流程流程
    protected $statuss_other = [
        1=>'下订单',10=>'确定订单',11=>'进行协商',12=>'开始办理',20=>'办理成功',21=>'办理失败',
    ];

    public function genreName()
    {
        return array_key_exists($this->genre,$this->genreNames) ? $this->genreNames[$this->genre] : '无';
    }

    public function status()
    {
        if (in_array($this->genre,[1,2,3])) {
            $status = array_key_exists($this->status,$this->statuss)?$this->statuss[$this->status]:'无';
        } elseif (in_array($this->status,[4,5,6])) {
            $status = array_key_exists($this->status,$this->statuss_other)?$this->statuss_other[$this->status]:'无';
        }
        return isset($status) ? $status : '无';
    }
}