<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Hash;
class UserController extends Controller
{
    /**
     * 用户列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //关联用户详情表查询出详情表的字段
        $rs = DB::table('users')->join('users_info','users.id','=','users_info.uid')->select('users.*','users_info.time')->get();
        // dump($rs);
        // 用户列表页
        return view('admin.user.user_info',['rs'=>$rs]);
    }

    /**
     * 用户添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //加载页面
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取添加表单传过来的数据
        $data = $request->except(['_token','repass']);
        // 密码进行哈希加密
        $data['pass'] = password_hash($data['pass'],PASSWORD_DEFAULT);
        // var_dump($data);
        // 将数据写入数据库
        $rs = DB::table('users')->insert($data);
        // 查询出当前数据的id
        $user = DB::table('users')->where('uname',$data['uname'])->get();
        // 添加时间
        $userinfo['time'] = date('Y-m-d H:i:s', time());
        // 查询出来的id关联uid
        $userinfo['uid'] = $user[0]->id;
        // 写入详情表
        $rs1 = DB::table('users_info')->insert($userinfo);
        if($rs1){
            echo '1';
        }else{
            echo '0';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 查询填充当前用户数据
        // echo $id;
        $rs = DB::table('users')->where('id',$id)->get();
        $data = DB::table('users_info')->where('uid',$rs[0]->id)->get();
        // var_dump($rs[0]->id);

        //加载修改页面
        return view('admin.user.edit',['rs'=>$rs[0],'data'=>$data[0]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //处理修改
        $data = $request->except(['_token','_method']);
        // echo $request;
        $verify = DB::table('users')
        ->join('users_info','users.id','=','users_info.uid')
        ->where('users.id',$id)
        ->select('users.uname','users_info.name','users_info.phone')
        ->get();
        if($data['uname'] == $verify[0]->uname){
            echo '3';die;
        }
        // 更改users表用户名
        $rs = DB::table('users')->where('id', $id)->update(['uname' => $data['uname']]);;
        // 更改详情表昵称和手机
        $rs1 = DB::table('users_info')->where('uid', $id)->update(['name' => $data['name'],'phone' => $data['phone']]);;


        if($rs || $rs1){
            echo '1';
        }else{
            echo '0';
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除用户
        $res = DB::table('users')->where('id', '=', $id)->delete();
        if ($res) {
          $data = [
            'status' => 0,
          ];
        } else {
          $data = [
            'status' => 1,
          ];
        }
        return $data;
    }

    // 用户状态方法
    public function status(){
        // 获取传过来的id
        $id = $_GET['id'];
        $data['status'] = $_GET['s'];
        DB::table('users')
          ->where('id', $id)
          ->update($data);
    }
    // 修改密码
    public function pass($id){
        // 查询出当前用户名
        $rs = DB::table('users')->where('id',$id)->get();
        // var_dump($rs);
        return view('admin.user.pass',['rs'=>$rs[0]]);
    }
    // 处理密码修改
    public function dopass(Request $request, $id){
        // 获取填写的密码
        $data = $request->except(['repass','_token']);
        // var_dump($data);
        // 查询数据库密码
        $rs = DB::table('users')->where('id',$id)->get();
        // hash解密判断旧密码是否一致
        if(!Hash::check($data['pass'], $rs[0]->pass)){
            // 返回值  0：旧密码不正确
            echo '0';die;
        }
        // hash加密新密码
        $data['pass'] = password_hash($data['newpass'],PASSWORD_DEFAULT);
        // 修改数据库密码
        $pass = DB::table('users')->where('id', $id)->update(['pass' => $data['newpass']]);;
        // 返回值，1：成功   0：失败
        if($pass){
            echo '1';
        }else{
            echo '3';
        }
    }
}
