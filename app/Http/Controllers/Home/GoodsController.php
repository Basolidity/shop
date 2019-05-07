<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\GoodsModel;


use App\Model\Home\GoodspicModel;
use App\Model\Home\GoodsTypeModel;
class GoodsController extends Controller
{
    //
    public function index(Request $request,$id)
    {
    	//$model = GoodsModel::with('goodstype')->find($id);
        $goods = new GoodsModel();
    	$good = GoodsModel::find($id);
    	$type =$good->goodstype;
    	$pic =$good->goodspic;
        //查找这个商品的所有评价
       
        $comment = $goods->getcomment($id);
        
        foreach ($comment as $k => $v) {
           // dd($v->uid);
           $comment[$k]->name = $goods->getUserName($v->uid)->uname;
           $comment[$k]->pic = $goods->getUserInfoPic($v->uid)->pic;
        }
       
    	$model = [];
    	foreach($type as $val){
    		if($val->display == 0 && $val->num>0){
    			$model[] = $val;
    		}
    	}
    	
    	$gid = $request->input('gid',$model[0]->id);
    	
    	return view('home.goods.index',['good'=>$good,'type'=>$model,'pic'=>$pic,'id'=>$id,'gid'=>$gid,'comment'=>$comment]);
    }
    //查询这个系列的所有商品
     public function list(Request $request,$id){
     	$good = new GoodsModel();
        dump($id);
     	$res = $good->getgodds($id);
     	dump($res);
     	$goodschilden = [];
     	foreach ($res as $key => $value) {
     		# code...
     		$goodschilden[] = $good->firstgoods($value->id);
     	}
     	dump($goodschilden);
     	return view('home.goods.list',['res'=>$res,'tup'=>$goodschilden]);
     	
     }
}
