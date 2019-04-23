<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Model\Admin\User;
use Hash;
class LoginController extends Controller
{
    /**
     * 前台的登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('home.login',['title'=>'登录尤洪']);
    }

    /**
     * 处理登录页面信息
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {
        //获取表单用户名
        $username = $request->uname;

        $res = User::where('uname',$username)->first();
        //根据用户名进行判断
        // dump($res);dd(Session::forget('quame'));
        if($res)
        {
            if(($res->status) == 1)
            {
                return redirect('/home/login')->with('error','用户于禁用');
            }

            //密码的检测
            if (!Hash::check($request->pass, $res->pass)) 
            {
                return redirect('/home/login')->with('error','用户名或者密码错误');
            }

            //往session里面存储信息
            // Session::put();
            Session(['qname'=>$res->uname]);

            //跳转
            return redirect('/home/index');

        } else {

            return redirect('/home/login')->with('error','用户名或者密码错误');
        }
        
    }

    /**
     * 退出登录
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //清空session
        session(['qname'=>'']);
        //跳转
        return redirect('/home/index')->with('tp','退出成功');
    }

}
