<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\CatModel;


class CatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    //添加数据库
    public function add(Request $request,$gid,$gmid)
    {
        //uid 
        $cat = new CatModel;
        //根据用户名获取用户id
        $uid = $cat->findUid(session('qname'));
        $uid = $uid->id;
        //获取该用户下面是否有这个类型的商品
        $nums = $cat->findNum($uid,$gid,$gmid);
        $num = $nums['num']? $nums['num']+1 : 1;
        if($num > 1){
            //说明表中原来就存在所以应该修改数据
            $res = $cat->updateNum($uid,$gid,$gmid,$num);
            if($res){
                return back()->with('success','添加购物车成功');
            }else{
                return back()->with('success','添加购物车失败');
            }            
        }else{
            //说明表中原来不存在所以应该添加数据
            $res = $cat->addCart($uid,$gid,$gmid,$num);
            if($res){
                return back()->with('success','添加购物车成功');
            }else{
                return back()->with('success','添加购物车失败');
            }
        }
    }
    
     public function addcart(Request $request)
     {
        
        $addnum = $request->num;
        $gid = $request->gid;
        $gmid = $request->gmid;
         $cat = new CatModel;
        //根据用户名获取用户id
        $uid = $cat->findUid(session('qname'));
        $uid = $uid->id;
        //获取该用户下面是否有这个类型的商品
        $nums = $cat->findNum($uid,$gid,$gmid);
       
        $num = $nums['num']? $nums['num']+$addnum : $addnum;
        
        if($nums['num']){
            //说明表中原来就存在所以应该修改数据
            $res = $cat->updateNum($uid,$gid,$gmid,$num);
            if($res){
                return ['msg'=>'添加购物车成功','status'=>'success'];
            }else{
                return ['msg'=>'添加购物车失败','status'=>'fail'];
            }            
        }else{
            //说明表中原来不存在所以应该添加数据
            $res = $cat->addCart($uid,$gid,$gmid,$num);
            if($res){
                return ['msg'=>'添加购物车成功','status'=>'success'];
            }else{
                return ['msg'=>'添加购物车失败','status'=>'fail'];
            }
        }
     }

}
