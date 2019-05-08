<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Home\GoodsModel;


use App\Model\Home\GoodspicModel;
use App\Model\Home\GoodsTypeModel;
use App\Model\Home\CatModel;
class GoodsController extends Controller
{
    //
    public function index(Request $request,$id)
    {
       
    	
        $goods = new GoodsModel();
    	$good = GoodsModel::find($id);
    	$type =$good->goodstype;
    	$pic =$good->goodspic;
        //查找这个商品的所有评价
       
        $comment = $goods->getcomment($id);
        
        foreach ($comment as $k => $v) {
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
    	$cat = new CatModel;
        $carts = $cat->carts();
    	return view('home.goods.index',['good'=>$good,'type'=>$model,'pic'=>$pic,'id'=>$id,'gid'=>$gid,'comment'=>$comment,'carts'=>$carts]);
    }
    //查询这个系列的所有商品
     public function list(Request $request,$id){
     	$good = new GoodsModel();
     	$res = $good->getgodds($id);
     	$goodschilden = [];
     	foreach ($res as $key => $value) {
     		$goodschilden[] = $good->firstgoods($value->id);
     	}
         $cat = new CatModel;
        $carts = $cat->carts();
     	return view('home.goods.list',['res'=>$res,'tup'=>$goodschilden,'carts'=>$carts]);
     	
     }
}
