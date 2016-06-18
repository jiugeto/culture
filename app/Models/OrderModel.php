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

    protected $genreNames = [
        //1创意供应，2创意需求，3分镜供应，4分镜需求，5视频供应，6视频需求，7娱乐供应，8娱乐需求，9演员供应，10演员需求，1租赁供应，12租赁需求
        1=>'创意供应',2=>'创意需求',3=>'分镜供应',4=>'分镜需求',5=>'视频供应',6=>'视频需求',
        7=>'娱乐供应',8=>'娱乐需求',9=>'演员供应',10=>'演员需求',11=>'租赁供应',12=>'租赁需求',
    ];

    //视频订单状态：1提交创意，2确定创意，3创意免费，4创意收费，5创意完成，6提交分镜，7确定分镜，8分镜免费，9分镜收费，10分镜完成，11进行协商，12开始制作，13分期收费，14效果协商，15二期收费，16确定成片，17三期收费，18出片交付保证播放，19尾款结清，20交易成功，21交易失败，（修改另外收费）
    protected $statuss = [
        1=>'提交创意','确定创意','创意免费','创意收费','创意完成','提交分镜','确定分镜','分镜免费','分镜收费',10=>'分镜完成',12=>'确定制作','分期收费','效果协商','二期收费','确定成片','三期收费','出片交付','尾款结清','交易成功','交易失败',
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
        if (in_array($this->genre,[1,2,3,4,5,6])) {
            $status = array_key_exists($this->status,$this->statuss)?$this->statuss[$this->status]:'无';
        } elseif (in_array($this->genre,[7,8,9,10,11,12])) {
            $status = array_key_exists($this->status,$this->statuss_other)?$this->statuss_other[$this->status]:'无';
        }
        return isset($status) ? $status : '无';
    }

    public function statusbtn()
    {
        if (in_array($this->genre,[1,2,3,4,5,6])) {
            $status = array_key_exists($this->status+1,$this->statuss)?$this->statuss[$this->status+1]:'';
        } elseif (in_array($this->genre,[7,8,9,10,11,12])) {
            $status = array_key_exists($this->status+1,$this->statuss_other)?$this->statuss_other[$this->status+1]:'';
        }
        return isset($status) ? $status : '';
    }
}