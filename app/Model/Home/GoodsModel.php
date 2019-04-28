<?php

namespace App\Model\Home;

use Illuminate\Database\Eloquent\Model;
use App\Model\Home\GoodspicModel;
use App\Model\Home\GoodsTypeModel;
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

    // public function findpic($id)
    // {
    // 	return $this->with('goodstype')->where('id',$id)->get();
    // }
}
