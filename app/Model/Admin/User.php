<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
<<<<<<< HEAD
    /**
=======
    //
     /**
>>>>>>> 97dc5bcaec76c533975fe7bb5e71e3758d9a3775
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'users';

<<<<<<< HEAD
    /**
     * 主键
     *
     * @var string
     */
    public $primaryKey = 'id';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * 不可被批量赋值的属性。
     *
     * @var array
     */
    protected $guarded = [];
=======
    protected $primaryKey  = 'id';

    public $timestamps = false;

    protected $guarded = [];
    
    // 关联详情表
    public function usersinfo()
    {
        return $this->hasOne('App\Model\Admin\Usersinfo','uid','id');
    }
>>>>>>> 97dc5bcaec76c533975fe7bb5e71e3758d9a3775

}
