<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use App\Model\Home\GoodspicModel;
use App\Model\Home\GoodsTypeModel;
use DB;
class GoodsModel extends Model
{
    protected $table = 'goods';
     protected $primary = 'id';
    public $timestamps = false;

    //关联goodsModel表
     public function goodspic()
    {
        return $this->hasMany('App\Model\Home\GoodspicModel','gid','id');
    }

    //关联goodspic表
     public function goodstype()
    {
        return $this->hasMany('App\Model\Home\GoodsTypeModel','gid','id');
    }

   //查询所有的goodstid商品
   public function getgodds($id)
   {
   		//return self::where('tid',$id)->select('id','gname','pic')->get()->toArray();
   		return DB::table('goods')
            ->join('goods_model', 'goods.id', '=', 'goods_model.gid')
            ->where('goods_model.display','0')
            ->select('goods.id','goods.gname','goods.pic')
            ->distinct()
            ->get()->toArray();
           
   }

   //查询下面的第一个商品的价格
   public function firstgoods($gid)
   {
   		return DB::table('goods_model')->where([['display','0'],['gid',$gid]])->first();
   }
    // public function findpic($id)
    // {
    // 	return $this->with('goodstype')->where('id',$id)->get();
    // }
}
