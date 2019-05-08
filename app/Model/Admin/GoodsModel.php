<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;
use DB;
class GoodsModel extends Model
{
    //
    protected $table = 'goods';
    public $timestamps = false;

    //添加产品
    public function addGoods($data){
    	return self::insertGetId($data);
    }

    //查询商品所有信息
    public function getGoods($start,$end,$username)
    {
    	//return self::whereBetween('addtime', [$start, $end])->orWhere('gname','link','%'.$username.'%')->paginate(10);
        return self::where(function ($query) use($start,$end,$username) {
            $query->whereBetween('addtime', [$start, $end]);
            $query->where('gname','like','%'.$username.'%');
        })
            ->paginate(6);
    }

    //根据id修改信息
    public function updateGoods($id,$data){
    	return self::where('id',$id)->update($data);
    }

    //查询一条数据
    public function findGoods($id)
    {
    	return self::find($id)->toArray();
    }

    //用事务来插入图片
    public function addpic($data)
    {
    	return DB::table('goods_pic')->insertGetId($data);
    }

    //删除图片
    public function delpic($id)
    {
    	return DB::table('goods_pic')->delete($id);
    }
    //查询当前id的图片地址
    public function findpic($id)
    {
    	return DB::table('goods_pic')->where('id',$id)->select('pic')->first();
    }

    //查询当前的id有多少tup
    public function finepic($id)
    {
    	return DB::table('goods_pic')->where('gid',$id)->get();
    }

    //添加产品
    public function addgModel($data)
    {
    	return DB::table('goods_model')->insert($data);
    }

    //查询所有的商品
    public function findgModel($id)
    {
    	return DB::table('goods_model')->where([['gid','=',$id],['display','=','0']])->get();
    }

    //查询一条数据的名字
    public function findGoodsName($id)
    {
    	return self::select('gname')->first()->toArray();
    }

    //根据id查询goods_model的数据
    public function findgModelEdit($id)
    {
    	return DB::table('goods_model')->find($id);
    }

    //修改goods_model里面的数据
    public function updategModel($id,$data)
    {
    	return DB::table('goods_model')->where('id',$id)->update($data);
    }


}
