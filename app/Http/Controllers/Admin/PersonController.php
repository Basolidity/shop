<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\adminuser\User;
use App\Model\Admin\Usersinfo;
use Session;
use DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // 查询
        $rs = User::with('role')->where('aname',Session::get('uname'))->first();
        // dd($rs);
        //加载个人页面
        return view('admin.adminuser.personage',['rs'=>$rs]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
       
        //处理修改
        $data = $request->except(['_token','_method']);
        // var_dump($data);die;
        // 链表查询数据做判断
        $verify = User::where('id',$id)->get();
        // 判断如果没有改数据返回3：保存成功
        if($data['aname'] == $verify[0]->aname && $data['nick'] == $verify[0]->nick && $data['phone'] == $verify[0]->phone){
            echo '0';die;
        }

        if($data['aname'] != $verify[0]->aname){
            $rs = User::where('id', $id)->update(['aname' => $data['aname']]);
            if(!$rs){
                echo '2';die;
            }
        }
        if($data['nick'] != $verify[0]->nick){
            $rs = User::where('id', $id)->update(['nick' => $data['nick']]);
            if(!$rs){
                echo '2';die;
            }
        }
        if($data['phone'] != $verify[0]->phone){
            $rs = User::where('id', $id)->update(['phone' => $data['phone']]);
            if(!$rs){
                echo '2';die;
            }
        }
        echo '1';

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // 处理文件上传
    public function upload(){
        if ($_POST) {
            //上传图片具体操作
            $file_name = $_FILES['file']['name'];
            //$file_type = $_FILES["file"]["type"];
            $file_tmp = $_FILES["file"]["tmp_name"];
            $file_error = $_FILES["file"]["error"];
            $file_size = $_FILES["file"]["size"];

            if ($file_error > 0) { // 出错
                $message = $file_error;
            } elseif($file_size > 1048576) { // 文件太大了
                $message = "上传文件不能大于1MB";
            }else{
                $date = date('Ymd');
                $file_name_arr = explode('.', $file_name);
                $new_file_name = date('YmdHis')+rand(1111,9999) . '.' . $file_name_arr[1];
                $path = "upload/".$date."/";
                $file_path = $path . $new_file_name;

                if (file_exists($file_path)) {
                    $message = "此文件已经存在啦";
                } else {
                //TODO 判断当前的目录是否存在，若不存在就新建一个!
                if (!is_dir($path)){mkdir($path,0777);}
                    $upload_result = move_uploaded_file($file_tmp, $file_path); 
                    //此函数只支持 HTTP POST 上传的文件
                    if ($upload_result) {
                        // 查询表里是否存在路径
                        $rs = User::where('id',$_POST['id'])->first();
                        // var_dump($rs->pic);
                        if($rs->pic){
                            // 如果存在就删除
                            unlink($rs->pic);
                        }
                        // 把路径存入数据库
                        $up = User::where('id',$_POST['id'])->update(['pic'=>$file_path]);
                        if(!$up){
                            $status = 2;
                            $message = "文件上传失败，请稍后再尝试";
                            function showMsg($status,$message = '',$data = array()){
                            $result = array(
                                'status' => $status,
                                'message' =>$message,
                                'data' =>$data
                            );
                            exit(json_encode($result));
                        }
                            return showMsg($status, $message);
                        }
                        $status = 1;
                        $message = $file_path;
                    } else {
                        $message = "文件上传失败，请稍后再尝试";
                    }
                }
            }
        } else {
            $message = "参数错误";
        }
        function showMsg($status,$message = '',$data = array()){
            $result = array(
                'status' => $status,
                'message' =>$message,
                'data' =>$data
            );
            exit(json_encode($result));
        }
            return showMsg($status, $message);
        }
    }
