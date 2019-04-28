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
    	$good = GoodsModel::find($id);
    	$type =$good->goodstype;
    	$pic =$good->goodspic;
    	$model = [];
    	foreach($type as $val){
    		if($val->display == 0 && $val->num>0){
    			//dump($val);
    			$model[] = $val;
    		}
    	}
    	
    	$gid = $request->input('gid',$model[0]->id);
    	return view('home.goods.index',['good'=>$good,'type'=>$model,'pic'=>$pic,'id'=>$id,'gid'=>$gid]);
    }
}
