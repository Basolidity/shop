<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use DB;
class orderModel extends Model
{	
	protected $table = 'order';
     
     public $timestamps = false;

     //查询个人余额
    public function getUserBalance($uid)
    {
    	return DB::table('users_info')->where('uid',$uid)->select('balance')->first();
    }

    //修改个人的余额
    public function updateUserBalance($uid,$money)
    {
    	return DB::table('users_info')->where('uid',$uid)->update(['balance'=>$money]);
    }
    //添加订单数据
    public function addOrder($data)
    {
    	return self::insertGetId($data);
    }

    //把详情信息添加到order_info
    public function addOrderinfo($data)
    {
    	return DB::table('order_info')->insert($data);
    }

    //修改goods_model里面的销售数量和库存数
    public function updateGoodsModel($gid,$gmid,$num)
    {
    	$res =  DB::table('goods_model')->where(['gid'=>$gid,'id'=>$gmid])->select('num','volume')->first();
    	// $res->num-$num;
    	//$res->volume+$num
    	return	DB::table('goods_model')->where(['gid'=>$gid,'id'=>$gmid])->update(['num'=>$res->num-$num,'volume'=>$res->volume+$num]);
    }

    //根据id串order的信息
    public function getOrder($id)
    {
    	return self::find($id)->toArray();
    }

    //根据uid查询订单信息
    public function Order($uid)
    {
    	return self::where('uid',$uid)->get()->toArray();
    }

    //根据oid查询所有的订单详情
    public function getOrderInfo($oid)
    {
    	return DB::table('order_info')->where('oid',$oid)->get();
    }

    //更具id查询所有的信息
    public function getOrderInfoId($id)
    {
    	return DB::table('order_info')->find($id);
    }

    //修改是否评论
    public function updateevaluate($id)
    {
    	return DB::table('order_info')->where('id',$id)->update(['evaluate'=>'1']);
    }
    //评论
    public function addcomment($data)
    {
    	return DB::table('comment')->insert($data);
    }
}
