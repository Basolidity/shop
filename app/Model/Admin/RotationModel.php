<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class RotationModel extends Model
{
    //
    protected $table = 'lunbo';
    public $timestamps = false;

     //添加产品
    public function addRotation($data){
    	return self::insertGetId($data);
    }

    //查询所有信息
    public function getRotation()
    {
    	return self::get();
    }

    //查询一条数据
    public function findRotation($id)
    {
    	return self::find($id)->toArray();
    }

    //根据id修改信息
    public function updateRotation($id,$data){
    	return self::where('id',$id)->update($data);
    }

    public function destroyRotation($id)
    {
    	return self::destroy($id);
    }
}
