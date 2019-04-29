<?php

namespace App\Http\Controllers\Home\site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\home\Site;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //查询数据库所有地址
        $rs = Site::where('uid',session('home_id'))->orderBy('depath','desc')->get();
        $num = count($rs);
        return view('home.site.index',['rs'=>$rs,'num'=>$num]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('home.site.create');

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
        $res = Site::where('uid',session('home_id'))->orderBy('depath','desc')->get();
        // dd(count($res));
        if(count($res) >= 10){
            echo '2';die;
        }
        $data = $request->except(['_token','repass','provinceId','cityId','districtId']);
        $rs = Site::create($data);

        if(!$rs){
            echo '0';die;
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
        //

        $rs = Site::where('id',$id)->first();
        return view('home.site.edit',['rs'=>$rs]);
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
        $data = $request->except(['_token','_method']);
        // echo $request;
        // 链表查询数据做判断
        $verify = Site::where('id',$id)->get();
        // 判断如果没有改数据返回3：保存成功
        if($data['lname'] == $verify[0]->lname && $data['phone'] == $verify[0]->phone && $data['area'] == $verify[0]->area && $data['path'] == $verify[0]->path && $data['postal'] == $verify[0]->postal){
            echo '3';die;
        }
        // 更改admin_user表昵称
        if($data['lname'] != $verify[0]->lname){
            $rs = Site::where('id',$id)->update(['lname'=>$data['lname']]);
            if($rs != 1){
                echo '2';die;
            }
        }
        if($data['phone'] != $verify[0]->phone){
            $rs = Site::where('id',$id)->update(['phone'=>$data['phone']]);
            if($rs != 1){
                echo '2';die;
            }
        }
        if($data['area'] != $verify[0]->area){
            $rs = Site::where('id',$id)->update(['area'=>$data['area']]);
            if($rs != 1){
                echo '2';die;
            }
        }
        if($data['path'] != $verify[0]->path){
            $rs = Site::where('id',$id)->update(['path'=>$data['path']]);
            if($rs != 1){
                echo '2';die;
            }
        }
        if($data['postal'] != $verify[0]->postal){
            $rs = Site::where('id',$id)->update(['postal'=>$data['postal']]);
            if($rs != 1){
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
        $res = Site::where('id',$id)->delete();
        if($res){
            return ['msg'=>'删除成功','status'=>'success'];
        }else{
            return ['msg'=>'删除失败','status'=>'fail'];
        }
    }
    // 设置默认地址
    public function depath(Request $request, $id){
        $data = Site::where('depath',1)->update(['depath'=>0]);
        $res = Site::where('id',$id)->update(['depath'=>1]);
        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'fail'];
        }
    }
}
