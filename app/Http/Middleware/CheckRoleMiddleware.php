<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Admin\adminuser\Role;
use App\Model\Admin\adminuser\Permission;

class CheckRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $rs = Role::find(session('id'));
        $rs->per;
        foreach($rs->per as $v){
            $arr[] = $v->perurl;
        }
        // 获取鼠标点击的路由信息
        $url = \Route::current()->getActionName();
        // 去重的权限路由
        $ar = array_unique($arr);
        // 查询出权限表的所有路由
        $rol = Permission::get();
        foreach($rol as $val){
            $res[] = $val->perurl;
        }
        // 判断点击的路由是否存在权限表中
        if(in_array($url,$res)){
            // 判断点击的路由是否在用户的权限中
            if(in_array($url,$ar)){
                return $next($request);
            }else{
                return redirect('/admin/check');
            }
        }
            return $next($request);
    }
}
