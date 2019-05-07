<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class IndexController extends Controller
{
    //后台首页
    public function index()
    {
        // 访问量
        $fw = DB::table('fangwen')->where('id',1)->first();
        // 会员量
        $user = count(DB::table('users')->get());
        // 管理员数
        $admin = count(DB::table('admin_user')->get());
        // 商品数
        $goods = count(DB::table('goods')->get());
        // 订单数
        $order = count(DB::table('order')->get());


        $res = DB::table('admin_user')->where('aname',session('uname'))->first();
        return view('admin.index.index',['res'=>$res,'fw'=>$fw,'user'=>$user,'admin'=>$admin,'goods'=>$goods,'order'=>$order]);
    }
}
