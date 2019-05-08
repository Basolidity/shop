<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\User;
use App\Model\Admin\Usersinfo;
use DB;

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

    //用户名
    public function doregist(Request $request)
    {
       $u = $request->input('u');
       // echo $u; 
       //获取users数据表    phone 一列数据
        $uname = DB::table("users")->pluck('uname');
        // var_dump($phone);
        $arr = array();
        //获取的对象集合转换为数组
        foreach($uname as $key=>$v){
            $arr[$key]=$v;
        }
        //对比
        if(in_array($u,$arr)){
            echo 1;//用户名已存在
        }else{
            echo 0;//用户名可用
        }

    }

    //手机号
    public function checkphone(Request $request)
    {
        $p = $request->input('p');
        // echo $p;
        //获取users数据表    phone 一列数据
        $phone=DB::table("users")->pluck('phone');
        // var_dump($phone);
        $arr=array();
        //获取的对象集合转换为数组
        foreach($phone as $key=>$v){
            $arr[$key]=$v;
        }

        //对比
        if(in_array($p,$arr)){
            echo 1;//手机号已经注册
        }else{
            echo 0;//手机号可以注册
        }

    }

    //短信接口
    public function codephone(Request $request)
    {   
        $pp=$request->pp;
        // echo $pp;
        //调用短信接口
        sendphone($pp);
    }

    //校验码
    public function checkcode(Request $request)
    {
        //获取输入的校验码
        $code=$request->input('code');
        if(isset($_COOKIE['fcode']) && !empty($code)){
            //获取手机号接收到验证码
            $fcode=$request->cookie('fcode');
            if($fcode==$code){
                echo 1;//校验码一致
            }else{
                echo 2;//校验码不一致
            }
        }elseif(empty($code)){
            echo 3;//输入的校验码为空
        }else{
            echo 4;//校验码过期
        }
    }

    //获取表单值添加数据库
    public function formregist(Request $request)
    {
        //去掉没用的字段
        $form = $request->except(['_token','repass','code','gtr']);

        //哈希加密
        $form['pass'] = password_hash($form['pass'],PASSWORD_DEFAULT);

        //添加时间
        $form['time'] = date('Y-m-d H:i:s', time());

        // var_dump($form);
        //添加到数据库
        $rs = DB::table('users')->insert($form);
        $info = User::where('uname',$form['uname'])->get();
        // 将用户id写入详情uid
        $rs1 = Usersinfo::create(['uid'=>$info[0]->id]);
        if($rs && $rs1){
            return redirect('/home/login')->with('error','注册成功,请登录');
        }else{
            return redirect('/home/regist')->with('error','注册失败');
        }
    }
}
