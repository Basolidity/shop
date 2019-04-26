<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TypeModel;
use App\Model\Admin\GoodsModel;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
         $goods = new GoodsModel;
        $res = $goods->getGoods();
        //dd($res);
        return view('admin.goods.index',['res'=>$res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $type = new TypeModel;
        $res = $type->getType();
        //dd($res);
        return view('admin.goods.create',['res'=>$res]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token','file');
        $data['addtime'] = time();
        $goods = new GoodsModel;
        $res = $goods->addGoods($data);
        if($res){
            return redirect('admin.goods.index');
        }else{
            return back()->with('success','添加失败');
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
        $type = new TypeModel;
        $res = $type->getType();
        $goods = new GoodsModel;
        $re = $goods->findGoods($id);
        
        return view('admin.goods.edit',['res'=>$res,'re'=>$re]);
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
        //dd($request->input());
        $data = $request->except('_token','_method','file');
         $goods = new GoodsModel;
        $res = $goods->updateGoods($id,$data);
        dd($res);
        if($res){
            return back()->with('success','1');
        }else{
            return back()->with('error','0');
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
    }

    //修改状态
    public function gstatus(Request $request,$id)
    {   
        $data = $request->only('status');
         $goods = new GoodsModel;
        $res = $goods->updateGoods($id,$data);
        if($res){
            return ['msg'=>'修改成功','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }
    }

    //弹出图片上传页面
    public function gupdate(Request $request,$id)
    {
        //dd($id);
         $goods = new GoodsModel;
        if($request->isMethod('post')){
             if($request->hasFile('file')){

            $file = $request->file('file');
                //新的名字
                $name = rand(1111,9999).time();
                //后缀
                $suffix = $file->getClientOriginalExtension();
                //移动
                 $file->move('./upload/admin/goodsimg/',$name.'.'.$suffix);
                 $data['pic'] = '/upload/admin/goodsimg/'.$name.'.'.$suffix;
                $data['gid'] = $id;
               
                $res = $goods->addpic($data);
              
               if($res){
                    return ['code'=>'0','res'=>$res,'tup'=>$data];
               }else{
                    return ['code'=>'1'];
               }
        }
             return ['msg'=>'不是通过按钮上传','code'=>'1'];
        }
         $res = $goods->finepic($id);
         //dd($res);
        return view('admin.goods.update',['id'=>$id,'res'=> $res,]);
    }

    public function delpic(Request $request,$id)
    {   

        $goods = new GoodsModel;
        $tupxx = $goods->findpic($id);
        //dd($tupxx->pic);
        $res = $goods->delpic($id);
        if($res){
            unlink('.'.$tupxx->pic);
            return ['msg'=>'删除成功','status'=>'success'];
        }else{
            return ['msg'=>'删除失败','status'=>'fail'];
        }
    }

    //添加产品型号
    public function gmodel(Request $request,$id)
    {
       if($request->isMethod('post')){
            $data = $request->except('_token','_method');
            $data['gid'] = $id;
             $goods = new GoodsModel;
            $res = $goods->addgModel($data);
            if($res){
                return ['msg'=>'添加成功','status'=>'success'];
            }else{
                return ['msg'=>'添加失败','status'=>'fail'];
            }
        }
        return view('admin.goods.gmodel',['id'=>$id]);
    }

    //查看这个产品下面的所有分类
    public function gmodel_list($id)
    {
        
        $goods = new GoodsModel;
        $data =$goods->findGoodsName($id);
        //根据gid查询所有的类型
        $res = $goods->findgModel($id);
       //dump($data['gname']);
        return view('admin.goods.gmodelindex',['gname'=>$data['gname'],'res'=>$res]);
    }

    //修改这个类型的数据
    public function gmodel_edit($id){
         $goods = new GoodsModel;
        $res =$goods->findgModelEdit($id);
        //dd($res);
        return view('admin.goods.gmodeledit',['res'=>$res]);
    }

    //修改的数据
    public function gmodel_update(Request $request,$id)
    {
        $data = $request->except('_token');
        $goods = new GoodsModel;
        $res =$goods->updategModel($id,$data);
        if($res){
            return ['msg'=>'修改成功','status'=>'success'];
        }else{
            return ['msg'=>'修改失败','status'=>'fail'];
        }
    }

    //删除类型数据
    public function gmodel_display(Request $request,$id)
    {
        $data = $request->only('display');
        $goods = new GoodsModel;
        $res =$goods->updategModel($id,$data);
        if($res){
            return ['msg'=>'删除成功','status'=>'success'];
        }else{
            return ['msg'=>'删除失败','status'=>'fail'];
        }
    }
}
