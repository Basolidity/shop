<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TypeModel;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
         $type = new TypeModel;
        $res = $type->getType();
       //dd($res);
        return view('admin.type.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('admin.type.create');
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
        $data = $request->except('_token');
        $data['path'] = '0,';
        $data['status'] = '1';
        //dd($data);
        $type = new TypeModel;
        $res = $type->AddType($data);
        //dd($res);
        return back();

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
    {   //dd($id);
        $type = new TypeModel;
        $res = $type->findType($id);
        return view('admin.type.create',['res'=>$res]);
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
        $data = $request->except('_token');
        //dd($data);
        $type = new TypeModel;
        $res = $type->updateType($id,$data);
        if($res){
            return ['msg'=>'修改成功','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
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
        //
        //dd($id);
        $type = new TypeModel;
        $res = $type->destroyType($id);
        if($res){
            return ['msg'=>'修改成功','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }
    }

    public function childtype(Request $request,$id)
    {   
         $type = new TypeModel;
          $res = $type->findType($id);
        if($request->isMethod('post')){
            $data = $request->except('_token');
            $data['path'] = $res['path'].$id.',';
            $data['pid'] = $id;
            //dd($data);
            $re = $type->AddType($data);
            if($res){
                return ['msg'=>'添加成功','status'=>'success'];
            }else{
                return ['msg'=>'添加失败','status'=>'fail'];
            }
        }
        return view('admin.type.childtype',['res'=>$res]);
        //return view('admin.type.index');
    }

    //首页点击按钮修改状态
    public function status(Request $request,$id){
        $data = $request->only('status');
        //dd($id);
        $type = new TypeModel;
        $res = $type->updateType($id,$data);
        if($res){
            return ['msg'=>'修改成功','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }
    }
}
