<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Admin\orderModel;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $order = new orderModel;
        //获取所有订单信息
        $orders = $order->getOrder();
        dump($orders);
        return view('admin.order.index',['orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
         $order = new orderModel;
          $res = $order->UpdataOrder($id);
          //dump($res);
          if($res){
            return ['msg'=>'发货成功','status'=>'success'];
          }else{
            return ['msg'=>'发货失败','status'=>'fail'];
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
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

    public function info($id)
    {
         $order = new orderModel;
         $order = $order->firstorder($id);
        // dump($order);
         //获取用户信息
         $users = $order->getuser($order->uid);
         //dump($users);
         //获取信息详情
         $order_info = $order->getorderInfo($order->id);
         foreach ($order_info as $k => $v) {
            //查询下面的所有产品
            $goods = $order-> getgoods($v->gid);
            $goods_model = $order->getgoodsModel($v->gmid);
            $order_info[$k]->pic = $goods->pic;
            $order_info[$k]->gname = $goods->gname;
            $order_info[$k]->price = $goods_model->price;
            $order_info[$k]->type = $goods_model->type;
         }
        // dump($order_info);
        return view('admin.order.index_info',['order'=>$order,'users'=>$users,'order_info'=>$order_info]);
    }
}
