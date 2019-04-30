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
}
