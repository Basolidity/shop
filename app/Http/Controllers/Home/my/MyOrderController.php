<?php

namespace App\Http\Controllers\Home\my;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Home\CatModel;
use App\Model\Home\orderModel;
class MyOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cat = new CatModel;
         $uid = $cat->findUid(session('qname'))->id;
         $order = new orderModel;
         $orders = $order->Order($uid);
         //dump($orders);
         return view('home.order.myorder',['orders'=>$orders]);
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

    public function Orderinfo(Request $request,$oid)
    {   

        $oid = base64_decode($oid);
        $order = new orderModel;
        $order_info = $order->getOrderInfo($oid);
         $cat = new CatModel;
        // dump($order_info);
         foreach ($order_info as $k => $v) {
            $goods[] = $cat->getGoods($v->gid);
            $goodsmodel[] = $cat->getGoodsModel($v->gmid);
         }
        
     
        return view('home.order.myorderinfo',['order_info'=>$order_info,'goods'=>$goods,'goodsmodel'=>$goodsmodel]);
    }

    //商品评价
    public function evaluate($oinfoid)
    {   
         $order = new orderModel;
        $order_info = $order->getOrderInfoId($oinfoid);
         $cat = new CatModel;
       // dump($order_info);
         $goods = $cat->getGoods($order_info->gid);
        $goodsmodel = $cat->getGoodsModel($order_info->gmid);
       //    dump($goods);
       /// dump($goodsmodel);
        return view('home.evaluate.index',['order_info'=>$order_info,'goods'=>$goods,'goodsmodel'=>$goodsmodel]);
    }

    //添加评价
    public function addevaluate(Request $request)
    {
        $data = $request->except('_token','id');
        $data['addtime'] = time();
        $id = $request->id;
          $order = new orderModel;
          //修改order_info是否评论
        $evaluate = $order->updateevaluate($id);  
        $res = $order->addcomment($data);
        if($res && $evaluate){
            return ['msg'=>'评论成功,2秒后跳到个人中心','status'=>'success'];
        }else{
            return ['msg'=>'评论失败','status'=>'fail'];
        }
    }
}
