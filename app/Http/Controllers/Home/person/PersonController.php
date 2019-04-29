<?php

namespace App\Http\Controllers\Home\person;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Model\Admin\Usersinfo;

class PersonController extends Controller
{
    //
    public function index(){
        // 管理中心
        $res = DB::table('users')->where('uname',session('qname'))->first();
        $photo = DB::table('users_info')->where('uid',$res->id)->first();
        return view('home.person.person',['photo'=>$photo,'res'=>$res]);
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
                $path = "upload/home/".$date."/";
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
                        $rs = Usersinfo::where('id',$_POST['id'])->first();
                        // var_dump($rs->pic);
                        if($rs->pic){
                            // 如果存在就删除
                            unlink($rs->pic);
                        }
                        // 把路径存入数据库
                        $up = Usersinfo::where('id',$_POST['id'])->update(['pic'=>$file_path]);
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

    // 处理个人修改
    public function update(Request $request, $id){
        //处理修改
        $data = $request->except(['_token','uid']);
        if(!preg_match("/^[\x{4e00}-\x{9fa5}A-Za-z0-9_]{3,20}$/u",$data['name'])) {
            echo '3';die;
        }
        if(!preg_match('/^[a-z0-9._%-]+@([a-z0-9-]+\.)+[a-z]{2,4}$|^1[3|4|5|7|8]\d{9}$/',$data['email'])) {
            echo '3';die;
        }
        if(!preg_match('/^1(3|4|5|7|8)\d{9}$/',$data['phone'])) {
            echo '3';die;
        }
        // var_dump($data);die;
        // 链表查询数据做判断
        $verify = Usersinfo::where('id',$id)->get();
        // dd($data['name']);
        // 判断如果没有改数据返回3：保存成功
        if($data['name'] == $verify[0]->name && $data['email'] == $verify[0]->email && $data['phone'] == $verify[0]->phone && $data['sex'] == $verify[0]->sex){
            echo '0';die;
        }

        if($data['name'] != $verify[0]->name){
            $rs = Usersinfo::where('id', $id)->update(['name' => $data['name']]);
            if(!$rs){
                echo '2';die;
            }
        }
        if($data['email'] != $verify[0]->email){
            $rs = Usersinfo::where('id', $id)->update(['email' => $data['email']]);
            if(!$rs){
                echo '2';die;
            }
        }
        if($data['phone'] != $verify[0]->phone){
            $rs = Usersinfo::where('id', $id)->update(['phone' => $data['phone']]);
            if(!$rs){
                echo '2';die;
            }
        }
        if($data['sex'] != $verify[0]->sex){
            $rs = Usersinfo::where('id', $id)->update(['sex' => $data['sex']]);
            if(!$rs){
                echo '2';die;
            }
        }
        echo '1';
    }
}
