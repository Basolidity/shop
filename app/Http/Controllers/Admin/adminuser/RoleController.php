<?php

namespace App\Http\Controllers\Admin\adminuser;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\adminuser\User;
use App\Model\Admin\adminuser\Role;
use App\Model\Admin\adminuser\Permission;
use DB;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     * 用户列表页
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $i=1;  
        $txt = $request->input('uname');
        // var_dump($txt);
        $perPage = $request->input('per_num',10); //每页页码
        $query = Role::query()->orderBy('id', 'asc')->where(function($query) use($request){
            //检测关键字
            $uname = $request->search;
            // dump($start);
            //如果用户名不为空
            if(!empty($uname)) {
                $query->where('rname','like','%'.$uname.'%');
            }
        });
        $result = $query->paginate($perPage);
        foreach($result as $k => $v){
            $v->per;
            $role[] = $v;
        }
        $paginator = $result->render();
        $result =  collect($result)->toArray();
        $req = $request['search'];
        $users = $result['data'];
        // dd($users);
        $total = $result['total'];//总页码
        $current_page = $result['current_page'];//当前页
        return view('admin.role.user_info',compact('users','paginator' ,'total','current_page','perPage','i','txt','req'));
    }
    

    /**
     * Show the form for creating a new resource.
     * 用户添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $rs = Role::get();
        $data = Permission::get();
        //加载页面
        return view('admin.role.create',['rs'=>$rs,'data'=>$data]);
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
        $ver = Role::where('rname',$data['rname'])->get();
        if(!empty($ver[0])){
            echo '2';die;
        }

        // var_dump($data);
        // 将数据写入数据库
        $rs = Role::create(['rname'=>$data['rname']]);
        if(!$rs){
            echo '0';
        }
        $arr = array_unique($data['per']);
        foreach($arr as $v){
            $res = DB::table('role_per')->insert(['role_id'=>$rs->id,'per_id'=>$v]);
            if(!$res){
                echo '0';
            }
        }
        echo '1';
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
        // 查询填充当前角色数据
        // var_dump($rs[0]->id);
        $rol = Role::where('id',$id)->get();
        $rs = Permission::get();
        //加载修改页面
        return view('admin.role.edit',['rol'=>$rol[0],'rs'=>$rs]);
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
        // 查询输入的数据是否存在
        $ver = Role::where('rname',$data['rname'])->first();
        if(!$ver){
            $rs = Role::where('id',$id)->update(['rname'=>$data['rname']]);
            if(!$rs){
                echo '0';die;
            }
        }

        $res = DB::table('role_per')->where('role_id',$id)->first();
        if($res){
            $r = DB::table('role_per')->where('role_id',$id)->delete();
            if(!$r){
                echo '0';die;
            }
        }
        $arr = array_unique($data['per']);

        foreach($arr as $v){
            $rs = DB::table('role_per')->insert(['role_id'=>$id,'per_id'=>$v]);
            if(!$rs){
                echo '0';die;
            }
        }

        echo '1';
        

    }

    /**
     * 删除用户
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //删除用户
        $res1 = DB::table('role_per')->where('role_id', $id)->delete();
        // 返回影响行数，等于零返回data返回1
        if($res1 == 0){
            $data = [
            'status' => 1,
          ];die;
        }
        $res = DB::table('role')->where('id', $id)->delete();
        if($res == 0){
            $data = [
            'status' => 1,
          ];die;
        }

        $data = [ 'status' => 0];
        return $data;
    }

    // 用户状态方法
    public function status(Request $request,$id){
        $data = $request->only('status');
        $sta = User::where('id',$id)->update($data);
        // var_dump($sta);
        if($sta){
            return ['msg'=>'修改成功','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }
    }
    // 修改密码
    public function pass($id){
        // 查询出当前用户名
        $rs = User::where('id',$id)->get();
        // var_dump($rs);
        return view('admin.adminuser.pass',['rs'=>$rs[0]]);
    }
    // 处理密码修改
    public function dopass(Request $request, $id){
        // 获取填写的密码
        $data = $request->except(['repass','_token']);
        // var_dump($data);
        // 查询数据库密码
        $rs = User::where('id',$id)->get();
        // hash解密判断旧密码是否一致
        if(!Hash::check($data['pass'], $rs[0]->pass)){
            // 返回值  0：旧密码不正确
            echo '0';die;
        }
        // hash加密新密码
        $data['pass'] = password_hash($data['newpass'],PASSWORD_DEFAULT);
        // 修改数据库密码
        $pass = User::where('id', $id)->update(['pass' => $data['newpass']]);

        // 返回值，1：成功   0：失败
        if($pass){
            echo '1';
        }else{
            echo '2';
        }
    }


    // 批量删除
    public function batch(){
        // 遍历ajax传过来的数组
        foreach ($_GET['arr'] as $k => $v) {
            $res = DB::table('users')->where('id', '=', $v)->delete();
            $res1 = DB::table('users_info')->where('uid', '=', $v)->delete();
        }
            if ($res && $res1) {
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
}
