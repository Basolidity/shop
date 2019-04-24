<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;
class IndexController extends Controller
{
    //前台首页
    public function index()
    {   
        // 加载前台公共页面
        return view('layout.home');
        
    }
}
