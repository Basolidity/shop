<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

use DB;
class OrderModel extends Model
{
    //
     protected $table = 'order';
    public $timestamps = false;

    //查询所有数据
    public function getOrder($start,$end,$search)
    {
    	return self::orderBy('addtime','desc')->where(function ($query) use($start,$end,$search) {
            $query->whereBetween('addtime', [$start, $end]);
            $query->where('number','like','%'.$search.'%');
        })
            ->paginate(6);
    }

    //修改状态
    public function UpdataOrder($id)
    {
    	return self::where('id',$id)->update(['status'=>'2']);
    }
    //查询单条数据
    public function firstorder($id)
    {
    	return self::find($id);
    }
    //获取用户的信息
    public function getuser($uid)
    {
    	return DB::table('users')->where('id',$uid)->select('uname','phone')->first();
    }
   //获取订单的详情
   public function getorderInfo($oid)
   {
   		return DB::table('order_info')->where('oid',$oid)->get();
   }

   //获取所有东西的图片与名称
   public function getgoods($gid)
   {
   		return DB::table('goods')->where('id',$gid)->select('gname','pic')->first();
   }

  //获取物品的所有型号
  public function getgoodsModel($gmid)
  {
  	return DB::table('goods_model')->where('id',$gmid)->select('price','type')->first();
  }
}
