<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
class TypeModel extends Model
{
    //
    protected $table = 'type';
    public $timestamps = false;

    //插入顶级栏目
    public function AddType($data)
    {
    	return self::insert($data);
    }

    //查询所有数据
    public function getType()
    {
    	return self::select(DB::raw('*,concat(path,id) as paths'))->
        orderby('paths')->
        get()->toArray();
    }

    public function getType2()
    {
    	return self::select(DB::raw('*,concat(path,id) as paths'))->where('status','1')->
        orderby('paths')->
        get();
    }
    //查询某一条的数据
    public function findType($id)
    {
    	return self::find($id)->toArray();
    }
    
    //修改状态
    public function updateType($id,$data)
    {
    	return self::where('id',$id)->update($data);
    }

    //删除
    public function destroyType($id){
    	return self::destroy($id);
    }

    //查询所有数据
    public function GoodgetType()
    {
    	return self::select(DB::raw('*,concat(path,id) as paths'))->
        orderby('paths')->
        get();
    }
}
