<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistController extends Controller
{
    /**
     * 前台的注册页面
     *
     * @return \Illuminate\Http\Response
     */
    public function regist()
    {
        return view('home.regist');
    }

    /**
     * 处理注册页面信息
     *
     * @return \Illuminate\Http\Response
     */
    public function doregist()
    {
        
    }
}
