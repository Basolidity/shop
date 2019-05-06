<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use DB;
class CatModel extends Model
{
      protected $table = 'cart';
     
     public $timestamps = false;
     //通过用户名获取用户id
     public function findUid($uname)
     {
     	return DB::table('users')->where('uname',$uname)->select('id')->first();
     }

     //获取是否有买过该类型产品
     public function findNum($uid,$gid,$gmid)
     {
     	return self::where([['uid',$uid],['gid',$gid],['gmid',$gmid]])->select('num')->first();
     }

     //修改num
     public function updateNum($uid,$gid,$gmid,$num)
     {
     	return self::where(['uid'=>$uid,'gid'=>$gid,'gmid'=>$gmid])->update(['num'=>$num]);
     }

      //修改num
     public function addCart($uid,$gid,$gmid,$num)
     {
     	return self::insert(['uid'=>$uid,'gid'=>$gid,'gmid'=>$gmid,'num'=>$num]);
     }

     //根据id查询uid获取购物车里面的信息
     public function getCart($uid)
     {
     	return self::where('uid',$uid)->get()->toArray();
     }

     //查询产品的信息
     public function getGoods($gid)
     {
     	return DB::table('goods')->where('id',$gid)->select('gname','pic')->first();
     }

     //查询产品模型的价格
     public function getGoodsModel($gmid)
     {
     	return DB::table('goods_model')->where('id',$gmid)->select('price','type','num')->first();
     }

     //删除数据库中的数据
     public function destroyCart($id)
     {
     	return self::destroy($id);
     }

     //删除数据uid传过来的所有的值的数据
     public function destroyCartUid($uid)
     {
          return self::where('uid',$uid)->delete();
     }
}