<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Admin\User;

use App\Model\Home\GoodsModel;
class IndexController extends Controller
{
    //前台首页
    public function index()
    {   
        // 加载前台公共页面
        $good = new GoodsModel();
     	$res = $good->getgodds(13);
     	dump($res);
     	$goodschilden = [];
     	foreach ($res as $key => $value) {
     		# code...
     		$goodschilden[] = $good->firstgoods($value->id);
     	}
     	dump($goodschilden);
        
        return view('home.index.index',['res'=>$res,'tup'=>$goodschilden]);
        
    }

    //购物车
    public function cart()
    {
        //return view('');
    }
}
