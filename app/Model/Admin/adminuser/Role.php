<?php

namespace App\Model\Admin\adminuser;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'role';

    protected $primary = 'id';
    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

        /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    // protected $fillable = ['uname','password','age','class'];

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];    

    public function per()
    {
        return $this->belongsToMany('App\Model\Admin\adminuser\Permission','role_per','role_id','per_id');
    }
}
