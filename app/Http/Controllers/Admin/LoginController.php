<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gregwar\Captcha\CaptchaBuilder;
use Session;
use Hash;

use App\Model\Admin\User;

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
    public function dologin(Request $request)
    {
        //获取表单用户名
        $username = $request->uname;

        $res = User::where('uname',$username)->first();
        //根据用户名进行判断
        // dump($res);
        // exit;

        if($res)
        {
            if(($res->status) == 1)
            {
                return redirect('/admin/login')->with('error','用户于禁用');
            }

            //密码的检测
            if (!Hash::check($request->pass, $res->pass)) 
            {
                return redirect('/admin/login')->with('error','用户名或者密码错误');
            }

            //把表单的验证码转换为小写
            $tb = $request->vercode;
            $tb = strtolower($tb);

            //验证码检测
            if($tb != Session::get('captcha'))
            {

                return redirect('/admin/login')->with('error','验证码错误');
            }
            
            //往session里面存储信息
            // Session::put();
            session(['uname'=>$res->uname]);

            //跳转

            return redirect('/admininfo');


        } else {

            return redirect('/admin/login')->with('error','用户名或者密码错误');

        }

        
    }

    /**
     * 显示验证码
     *
     * @return Response
     */
    public function captcha()
    {
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 36, $font = null);
        //获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        Session::put('captcha', $phrase);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header('Content-Type: image/jpeg');
        $builder->output();
    }

    /**
     * 退出登录
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //清空session
        session(['uname'=>'']);

        //跳转
        return redirect('/admin/login');
    }
}
