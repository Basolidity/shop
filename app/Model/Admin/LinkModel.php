<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class LinkModel extends Model
{
    //
    protected $table = 'links';
    public $timestamps = false;

     //添加产品
    public function addLinks($data){
    	return self::insertGetId($data);
    }

    //查询所有信息
    public function getLinks()
    {
    	return self::get();
    }

    //查询一条数据
    public function findLinks($id)
    {
    	return self::find($id)->toArray();
    }

    //根据id修改信息
    public function updateLinks($id,$data){
    	return self::where('id',$id)->update($data);
    }

    public function destroyLinks($id)
    {
    	return self::destroy($id);
    }
}
