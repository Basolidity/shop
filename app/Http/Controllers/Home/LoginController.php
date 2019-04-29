<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use App\Model\Admin\User;
use Hash;
use Cookie;
use DB;
class LoginController extends Controller
{
    /**
     * 前台的登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('home.login');
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
            if(($res->status) == 0)
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

            //判断是否点击保存登录信息
            // dump($request->cook);exit;
            if($request->cook == 'tt'){
                Cookie::make($request['uname'],$request['pass']);
            }

            //跳转
            return redirect('/home/index')->with('tm','登录成功');

        } else {

            return redirect('/home/login')->with('error','用户名或者密码错误');
        }
        
    }

    /**
     * 忘记密码
     *
     * @return \Illuminate\Http\Response
     */
    public function forget()
    {
        return view('home.forget');
    }

    //处理手机号信息
    public function forphone(Request $request)
    {
        $p = $request->input('p');
        // echo $p;
        //获取users数据表   phone 一列数据
        $phone = DB::table("users")->pluck('phone');
        // var_dump($phone);
        $arr=array();
        //获取的对象集合转换为数组
        foreach($phone as $key=>$v){
            $arr[$key]=$v;
        }

        //对比
        if(in_array($p,$arr)){
            echo 1;//手机号存在
        }else{
            echo 0;//手机号还没有注册
        }
    }

    //短信接口
    public function duanphone(Request $request)
    {
        $pp=$request->pp;
        // echo $pp;
        //调用短信接口
        sendphone($pp);
    }

    //获取表单的密码修改数据库密码
    public function doforget(Request $request)
    {
        //哈希加密
        $request['pass'] = password_hash($request['pass'],PASSWORD_DEFAULT);
        // var_dump($request['pass']);

        //获取手机号查数据库数据
        $ure = $request->phone;
        $phone = DB::table("users")->where('phone',$ure)->get();
        // var_dump($phone);
        $id = $phone[0]->id;
        //修改密码数据库
        $tt = DB::table("users")->where('id',$id)->update(['pass' => $request['pass']]);
        if($tt){
            return redirect('/home/login')->with('error','找回密码成功,请登录');
        }else{
            return redirect('/home/forget')->with('error','找回密码失败');
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
