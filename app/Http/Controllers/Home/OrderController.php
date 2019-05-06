<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\CatModel;
use App\Model\Home\orderModel;
use DB;
class OrderController extends Controller
{
    //
    public function index(){
    	$cat = new CatModel;
        $carts =[];
        if(session('qname')){
            //根据用户名获取用户id
            $uid = $cat->findUid(session('qname'));
            $uid = $uid->id;
            $cart = $cat->getCart($uid);
            // dump($uid);
           
            foreach($cart as $k =>$v){
               
                $carts[$k] = $cat->getGoods($v['gid']);
                $goods_model = $cat->getGoodsModel($v['gmid']);
                $carts[$k]->price = $goods_model->price;
                $carts[$k]->type = $goods_model->type;
                $carts[$k]->kc = $goods_model->num;
                $carts[$k]->num = $v['num'];
                $carts[$k]->id = $v['id'];
            }

            // dump($carts);
        }
        // 获取地址
        $site = DB::table('site')->where('uid',$uid)->where('depath',1)->first();
        $xz = DB::table('site')->where('uid',$uid)->where('depath',2)->first();
        // dump($site);
        return view('home.order.index',['carts'=>$carts,'site'=>$site,'xz'=>$xz]);
    }


    public function settlement(Request $request)
    {	
    	//获取订单的价格
    	$goods_model=$request->input('total');
    	$order_msg=$request->input('msg');
    	$cat = new CatModel;
    	$order = new orderModel;
    	 //根据用户名获取用户id
        $uid = $cat->findUid(session('qname'))->id;
        
        //查询账户有多少余额
        $User_money = $order->getUserBalance($uid)->balance;
        if($User_money < $goods_model){
        	return ['msg'=>'您的余额不足请充值','status'=>"fail"];
        }else{
			$data['uid'] = $uid;
        	$data['total'] = $goods_model;
        	$data['msg'] = $order_msg;
        	$data['sid'] = '3';
        	$data['addtime'] = time();
        	$data['number'] = date('Ymd').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        	DB::beginTransaction();
        	//从个人的余额减去买东西的钱
        	
        	 $order->updateUserBalance($uid,$User_money -= $goods_model);
        	//把购物信息存入order表并且返回插入的id
        	$orderid = $order->addOrder($data);
        	//获取所有的商品信息
        	$cart = $cat->getCart($uid);
        	//把获取的购物车信息插入到订单详情页
        	$good_modelupdate=true;
        	$data = [];
        	foreach ($cart as $key => $value) {
        		unset($value['id']);
        		$value['oid'] = $orderid;
        		$data[] = $value;
        		//修改model的数量要求gid，gmid相同
        		$good_model = $order->updateGoodsModel($value['gid'],$value['gmid'],$value['num']);
        		if(!$good_model){
        			$good_modelupdate = false;
        		}
        	}

        	$order_info = $order->addOrderinfo($data);

        	//dd($order_info);
        	if($order_info){
        	//如果插入orderinfo成功则删除cart里面uid的信息
	        	 $res = $cat->destroyCartUid($uid);	
	        	 //判断删除cart里面的信息成功并且修改goods_model表的数据也成功
	        	 if($res && $good_modelupdate){
	        	 	DB::commit();
	        	 	return ['msg'=>'操作成功','status'=>"success",'oid'=>$orderid];
	        	 }else{
	        	 	DB::rollBack();
	        	 	return ['msg'=>'操作失败,请刷新页面重新结算','status'=>"error"];
	        	 }
        	}else{
        		DB::rollBack();
        		return ['msg'=>'操作失败,请刷新页面重新结算','status'=>"error"];
        	}
        }
    }

    //订单后面的页面
    public function settlements(Request $request,$oid)
    {
    	$order = new orderModel;
    	//根据id查询order里面的信息
    	$res = $order -> getOrder($oid);
        // dd($res);
        $site = DB::table('site')->where('uid',$res['uid'])->where('depath',1)->first();
        $xz = DB::table('site')->where('uid',$res['uid'])->where('depath',2)->first();
        
    	return view('home.order.buycar',['res'=>$res,'site'=>$site,'xz'=>$xz]);
    }

    // 地址页面
    public function edit()
    {
        $rs = DB::table('site')->where('uid',session('home_id'))->orderBy('depath','desc')->get();
        // dd($rs);
        return view('home.order.site_edit',['rs'=>$rs]);
    }
    // 选择地址
    public function depath(Request $request, $id)
    {

        $data = DB::table('site')->where('depath',2)->update(['depath'=>0]);
        $res = DB::table('site')->where('id',$id)->update(['depath'=>2]);
        if($res){
            return ['status'=>'success'];
        }else{
            return ['status'=>'fail'];
        }
    }
}
