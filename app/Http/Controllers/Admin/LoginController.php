<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 后台的登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.login',['title'=>'登录后台']);
    }

    /**
     * 处理登录页面信息
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin()
    {
        
    }
}
